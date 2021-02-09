<?php

namespace App\Http\Controllers;

use App\User;
use App\Request_Brand;
use App\Fragrance_Brand;
use App\Brand_Ambassador_Request;
use App\Brand_Ambassador_Profile;
use App\Feature_Request_By_User;
use App\Feature_Request;
use App\User_Fragrance_Review;

use App\Exports\User_Fragrance_Reviews_Data;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Excel;
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


    // Research
    public function user_fragrance_review_show()
    {
        return view('admin.user_fragrance_review_download',[
            'reviews' => User_Fragrance_Review::all()
        ]);
    }
    // End of Research


    // Exports
    public function user_fragrance_review_export()
    {
        return Excel::download(new User_Fragrance_Reviews_Data, 'user_fragrance_review.csv');
        // return Excel::download(new DisneyplusExport, 'disney.xlsx');
        // return Excel::create('Filename', function($excel) {

        // })->download('csv');
        
        // return view('admin.user_fragrance_review_export',[
        //     'reviews' => User_Fragrance_Review::all()
        // ]);
    }
    // End of Exports


    // Stores
    // Stores Requests
    public function stores_requests()
    {
        $store_requests = Store::whereNull('request_status')
        ->get();
        
        $webstore_requests = Webstore::whereNull('request_status')
        ->get();
        
        // var_dump($ambassadors);
        // return;

        return view('admin.stores_requests',[
            'store_requests'        => $store_requests,
            'webstore_requests'     => $webstore_requests,
        ]);
    }

    public function stores_requests_response($store_type, $id, $action)
    {
        // Store or Webstore
        if ( strcmp($store_type, "store") == 0 ) {

            // Exists or Not
            if(!Store::exists($id)){
                return redirect()->back()->with('error', 'ID does not exist');
            }

            // Find and Update
            $store = Store::find($id)
            ->update(['request_status' => $action]);

            // Assign Appropriate Roles
            if ( strcmp($action, "approved") == 0 ) {
                // Assign store_owner and remove new_store_owner
                if($user->hasRole('new_store_owner')){
                    $user->removeRole('new_store_owner');
                }
                if(!$user->hasRole('store_owner')){
                    $user->assignRole('store_owner');
                }

                if(!$user->hasRole('service_user')){
                    $user->assignRole('service_user');
                }
                
                return redirect()->back()->with('success',"The {$store->name} request was approved");
            }
            return redirect()->back()->with('error',"The {$store->name} request was rejected");
        }
        else if ( strcmp($store_type, "webstore") == 0 ) {

            // Exists or Not
            if(!Webstore::exists($id)){
                return redirect()->back()->with('error', 'ID does not exist');
            }

            // Find and Update
            $store = Webstore::find($id)
            ->update(['request_status' => $action]);

            // Assign Appropriate Roles
            if ( strcmp($action, "approved") == 0 ) {
                // Assign store_owner and remove new_store_owner
                if($user->hasRole('new_webstore_owner')){
                    $user->removeRole('new_webstore_owner');
                }
                if(!$user->hasRole('webstore_owner')){
                    $user->assignRole('webstore_owner');
                }

                if(!$user->hasRole('service_user')){
                    $user->assignRole('service_user');
                }
                
                return redirect()->back()->with('success',"The {$store->name} request was approved");
            }
            return redirect()->back()->with('error',"The {$store->name} request was rejected");
        }

        return redirect()->back()->with('error',"Something went wrong beyond the defined exceptions, look into this.");
    }
    // End of Stores Requests


    // Stores Panel
    public function store_panel()
    {
        $store_requests = Store::where('request_status', 'approved')
        ->get();
        
        $webstore_requests = Webstore::where('request_status', 'approved')
        ->get();
        
        // var_dump($ambassadors);
        // return;

        return view('admin.stores_requests',[
            'store_requests'        => $store_requests,
            'webstore_requests'     => $webstore_requests,
        ]);
    }

    public function store_panel_response($store_type, $id, $action)
    {
        // Store or Webstore
        if ( strcmp($store_type, "store") == 0 ) {

            // Exists or Not
            if(!Store::exists($id)){
                return redirect()->back()->with('error', 'ID does not exist');
            }

            // Find and Update
            $store = Store::find($id)
            ->update(['request_status' => $action]);

            // Assign Appropriate Roles
            if ( strcmp($action, "Approved") == 0 ) {
                // Assign store_owner and remove new_store_owner
                if($user->hasRole('new_store_owner')){
                    $user->removeRole('new_store_owner');
                }
                if(!$user->hasRole('store_owner')){
                    $user->assignRole('store_owner');
                }

                if(!$user->hasRole('service_user')){
                    $user->assignRole('service_user');
                }
                
                return redirect()->back()->with('success',"The {$store->name} request was approved");
            }
            return redirect()->back()->with('error',"The {$store->name} request was rejected");
        }
        else if ( strcmp($store_type, "webstore") == 0 ) {

            // Exists or Not
            if(!Webstore::exists($id)){
                return redirect()->back()->with('error', 'ID does not exist');
            }

            // Find and Update
            $store = Webstore::find($id)
            ->update(['request_status' => $action]);

            // Assign Appropriate Roles
            if ( strcmp($action, "Approved") == 0 ) {
                // Assign store_owner and remove new_store_owner
                if($user->hasRole('new_webstore_owner')){
                    $user->removeRole('new_webstore_owner');
                }
                if(!$user->hasRole('webstore_owner')){
                    $user->assignRole('webstore_owner');
                }

                if(!$user->hasRole('service_user')){
                    $user->assignRole('service_user');
                }
                
                return redirect()->back()->with('success',"The {$store->name} request was approved");
            }
            return redirect()->back()->with('error',"The {$store->name} request was rejected");
        }

        return redirect()->back()->with('error',"Something went wrong beyond the defined exceptions, look into this.");
    }
    // End of Stores Panel
    // End of Stores


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
            'ack_ba_check'      => 'required',
            'implementation'    => 'max:500',
        ]);

        Feature_Request::create([
            'users_id'              => $request->input('users_id'),
            'name'                  => $request->input('name'),
            'description'           => $request->input('description'),
            'status'                => "Queued",
            'votes'                 => 1,
            'for_brand_ambassador'  => !is_null($request->input('for_brand_ambassador')),
        ]);

        Feature_Request_By_User::destroy($request->input('feature_id'));

        return redirect('request_feature_user_review')->with('success',"{$request->name} approved.");
    }
    // End of Feature Requests By User


    // Feature Requests
    public function request_feature_status()
    {
        $date = Carbon::today()->subMonths(1);

        $features = Feature_Request::join('users', 'users.id', 'feature_request.users_id')
            ->select('users.name as user', 'feature_request.*')
            ->orderBy('votes', 'desc')
            ->get();

        $old_features = Feature_Request::where('feature_request.updated_at', '<', $date)
            ->where('status', '=', "Added")
            ->get();

        $features = $features->diff($old_features);

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
    // End of Feature Requests


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

            if(is_null($brand)){
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
                $new->status        = 'on';
                
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
    // End of Brand Ambassador


    // Brand Requests
    public function request_brand_status()
    {
        $date = Carbon::today()->subMonths(1);

        $brands = Request_Brand::join('users', 'users.id', 'request_brand.users_id')
            ->select('users.name as user', 'request_brand.*')
            ->orderBy('votes', 'desc')
            ->get();

        $old_brands = Request_Brand::where('request_brand.updated_at', '<', $date)
            ->where('status', '=', "Added")
            ->get();

        $brands = $brands->diff($old_brands);

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
    // End of Brand Requests
}