<?php

namespace App\Http\Controllers;

use App\Fragrance_Brand;
use App\Brand_Ambassador_Request;
use App\Brand_Ambassador_Profile;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function brand_ambassador_request()
    {
        $ambassadors = Brand_Ambassador_Request::all()
        ->where('status', '<' , '4');
        
        // var_dump($ambassadors);
        // return;

        return view('admin.brand_ambassdor_request',[
            'ambassadors'        => $ambassadors,
            ]);
    }

    public function brand_ambassador_request_response($new_status, $ambassador_id)
    {
        // Regarding new_status:
        // 0 candidate_brand_ambassador, is pending
        // 1 new_brand_ambassador, allows users to add
        // 2 new_brand_ambassador, brand has been added, review it and decide
        // 3 candidate_brand_ambassador / new_brand_ambassador, is rejected
        // 4 brand_ambassador, allows them to add fragrances, move to profile

        // 0 can change to 1, 3, 4
        // If they have selected their brand, 0 changes to 2, if new brand then 1
        // 1 can change to 2, 3, 4
        // 2 can change to 3, 4
        // 3 can change to 4

        if ($new_status == 1){
            // from 0 to 1. 0 to 2 is handled in Brand_Ambassador_Request_Controller
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
        elseif($new_status == 3){
            // Rejected
            DB::transaction(function () use ($new_status, $ambassador_id) {
                $ambassador = Brand_Ambassador_Request::find($ambassador_id);
                $ambassador->status = $new_status;
                $ambassador->save();
            });
        }
        elseif($new_status == 4){
            // Converting newly added brand to full fledged Brand
            // And the user to full fledged Brand_Ambassador

            // Checking existence of brand. The code ensures the integrity but it's
            // 2AM and I am paranoid
            $ambassador = Brand_Ambassador_Request::find($ambassador_id);
            $brand = Fragrance_Brand::where('name', $ambassador->brand_name)->first();

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
                $new->status        = '0';
                
                $new->save();

                $ambassador->status = '4';
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

}