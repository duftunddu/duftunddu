<?php

namespace App\Http\Controllers;

use App\User;
use App\Request_Brand;
use App\Fragrance_Brand;
use App\Brand_Ambassador_Request;
use App\Brand_Ambassador_Profile;
use App\Feature_Request_By_User;
use App\Feature_Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Helper\Helper;

class Admin_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // Feature Requests By User
    public function request_feature_user_review()
    {
        $requests = Feature_Request_By_User::all();
        
        // var_dump($ambassadors);
        // return;

        return view('admin.request_feature_by_user_view',[
            'requests'        => $requests,
        ]);
    }

    public function request_feature_user_action($id, $action)
    {
        if(!Feature_Request_By_User::exists($id)){
            return redirect('request_feature_user_review');
        }

        if( strcmp($action, "approve") == 0 ){
            // Approve
            $feature = Feature_Request_By_User::find($id);

            return view('admin.request_feature_by_user_add',[
                'feature'        => $feature,
            ]);
        }
        else{
            // Delete
            Feature_Request_By_User::destroy($id);

            return redirect()->back()->with('error',"ID: {$id} has been deleted.");
        }
    }

    public function request_feature_user_store(Request $request)
    {   
        $validatedData = $request->validate([ 
            'users_id'          => 'required',
            'name'              => 'required|max:40',
            'description'       => 'required|max:256',
            'implementation'    => 'max:500',
        ]);
        
        Feature_Request::create([
            'users_id'          => $request->input('users_id'),
            'name'              => $request->input('name'),
            'description'       => $request->input('description'),
            'status'            => "Queued",
            'votes'             => 1,
        ]);

        Feature_Request_By_User::destroy($request->input('feature_id'));

        return redirect('request_feature_user_review')->with('success',"{$request->name} approved.");
    }

    // Feature Requests
    public function request_feature_status()
    {
        $date = Carbon::today()->subDays(7);
        $features = Feature_Request::where('status', '!=', "Processed (Added)")
        ->where('feature_request.updated_at', '>', $date)
        ->join('users', 'users.id', 'feature_request.users_id')
        ->select('users.name as user', 'feature_request.*')
        ->orderBy('votes', 'desc')
        ->get();

        return view('admin.request_feature_view',[
            'features'        =>    $features,
        ]);
    }

    public function request_feature_status_change($feature_id, $new_status)
    {
        $feature = Feature_Request::find($feature_id);
        $feature->status = $new_status;
        $feature->save();

        return redirect()->back();
    }

    // Brand Ambassador
    public function brand_ambassador_request()
    {
        $ambassadors = Brand_Ambassador_Request::all()
            ->where('status', '!=' , 'brand_ambassador');

        return view('admin.brand_ambassador_request',[
            'ambassadors'        => $ambassadors,
        ]);
    }

    public function brand_ambassador_request_response($new_status, $ambassador_id)
    {
        // Regarding new_status:
        // new_brand_request            = candidate_brand_ambassador, is pending
        // new_brand_details_request    = new_brand_ambassador, allows users to add details of brand
        // existing_brand_request       = new_brand_ambassador, brand has been added, review it and decide
        // rejected                     = candidate_brand_ambassador / new_brand_ambassador, is rejected
        // brand_ambassador             = brand_ambassador, allows them to add fragrances, move to profile

        // new_brand_request can change to new_brand_details_request, rejected, brand_ambassador
        // If they have selected their brand, new_brand_request changes to existing_brand_request, if new brand then new_brand_details_request
        // new_brand_details_request can change to existing_brand_request, rejected, brand_ambassador
        // existing_brand_request can change to rejected, brand_ambassador
        // rejected can change to brand_ambassador

        if (strcmp($new_status, "new_brand_details_request") == 0 ){
            // from new_brand_request to new_brand_details_request. new_brand_request to existing_brand_request is handled in Brand_Ambassador_Request_Controller
            // New Candidate: Candidate Profile has been filled, is Candidate_Brand Ambassador
            // Approve Profile to convert to New_Brand_Ambassador

            $ambassador = Brand_Ambassador_Request::find($ambassador_id);
            DB::transaction(function () use ($new_status, $ambassador) {
                $ambassador->status = $new_status;
                $ambassador->save();
            });

            $user = User::find($ambassador->users_id);
            if($user->hasRole('candidate_brand_ambassador')){
                $user->removeRole('candidate_brand_ambassador');
                $user->assignRole('new_brand_ambassador');
            }

        }
        elseif( strcmp($new_status, "rejected") == 0 ){
            // Rejected
            DB::transaction(function () use ($new_status, $ambassador_id) {
                $ambassador = Brand_Ambassador_Request::find($ambassador_id);
                $ambassador->status = $new_status;
                $ambassador->save();
            });
        }
        elseif(strcmp($new_status, "brand_ambassador") == 0 ){
            // Converting newly added brand to full fledged Brand
            // And the user to full fledged Brand_Ambassador

            // Checking existence of brand. The code ensures the integrity but it's
            // 2AM and I am paranoid
            $ambassador = Brand_Ambassador_Request::find($ambassador_id);

            // $brand = Fragrance_Brand::firstWhere('name', $ambassador->brand_name);
            $brand = Fragrance_Brand::find($ambassador->brand_id);

            // var_dump($brand);return;

            if(empty($brand)){
                return redirect()->back()->with('error', 'Brand not found.');
            }

            $brand_id = $brand->id;

            // Filling the profile column, which will be used 
            DB::transaction(function () use ($ambassador, $brand_id) {
                $new                = new Brand_Ambassador_Profile();
                $new->users_id      = $ambassador->users_id;
                $new->brand_id      = $brand_id;
                $new->linkedin      = $ambassador->linkedin;
                $new->email_work    = $ambassador->email_work;
                $new->website       = $ambassador->website;
                $new->status        = 'new_brand_request';
                
                $new->save();

                $ambassador->status = 'brand_ambassador';
                $ambassador->save();
            });

            // assigning the appropriate role
            $user = User::find($ambassador->users_id);

            if($user->hasRole('candidate_brand_ambassador')){
                $user->removeRole('candidate_brand_ambassador');
            }
            if($user->hasRole('new_brand_ambassador')){
                $user->removeRole('new_brand_ambassador');
            }

            $user->assignRole('brand_ambassador');
            
            // Soft deleting from the model
            $ambassador->delete();
        }

        return redirect()->back()->with('success','Approval Successful.');
    }

    // Brand Requests
    public function request_brand_status()
    {
        $date = Carbon::today()->subDays(7);
        $brands = Request_Brand::where('status', '!=', "Processed (Added)")
        ->where('request_brand.updated_at', '>', $date)
        ->join('users', 'users.id', 'request_brand.users_id')
        ->select('users.name as user', 'request_brand.*')
        ->orderBy('votes', 'desc')
        ->get();

        return view('admin.request_brand_view',[
            'brands'        =>    $brands,
        ]);
    }

    public function request_brand_status_change(Request $request, $brand_name, $new_status)
    {
        $brand_request = Request_Brand::firstWhere('name', $brand_name);
        $brand_request->status = $new_status;
        $brand_request->save();

        return redirect()->back();
    }

}