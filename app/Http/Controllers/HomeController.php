<?php

namespace App\Http\Controllers;

use App\Perceiver;
use App\Fragrance_Profile;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user      = request()->user()->id;

        $profiles = DB::table('fragrance_profile')
            ->where('users_id', $user)
            ->get();

        if ($profiles->isEmpty()){
            return redirect('profile');
        }

        $user_profile = $profiles[0];

        $check_perceiver = DB::table('perceiver')
            ->where('profile_id', $profiles->first()->id)
            ->get();

        $fav_brand = NULL;
        $user_fragrances = NULL;
        
        if($check_perceiver->isNotEmpty()){
            // User Profile
            $data_fav_brand = DB::table('perceiver')
                ->join('fragrance', 'fragrance.id', '=', 'perceiver.fragrance_id')
                ->where('profile_id', $profiles->first()->id)
                ->select('fragrance.brand_id', DB::raw('COUNT(fragrance.brand_id) AS occurrences'))
                ->groupBy('fragrance.brand_id')
                ->orderBy('occurrences', 'DESC')
                ->get();
            
            $fav_brand = DB::table('fragrance_brand')->where('id', $data_fav_brand->first()->brand_id)->first();

            $user_fragrances = DB::table('perceiver')
                    ->join('fragrance', 'fragrance.id', '=', 'perceiver.fragrance_id')
                    ->where('profile_id', $profiles->first()->id)
                    ->select('fragrance.name', 'perceiver.like')
                    ->get();
        }
        unset($profiles[0]);

        if($profiles->isEmpty()){
            // Setting everything to NULL because PHP functions are used in blade
            $profiles = NULL;
            $empty_profiles = NULL;
            $profile_fragrances = NULL;
            // var_dump(empty($empty_profiles));
            // return;
        }

        else{
            // Other profiles        
            $empty_profiles[] = NULL;
            $index = 0;
            $profile_fragrances = NULL;
            if($profiles->isNotEmpty()){
                
                // Profiles with Fragrances
                foreach ($profiles as $profile){
                    $profile_fragrance = DB::table('perceiver')
                        ->join('fragrance', 'fragrance.id', '=', 'perceiver.fragrance_id')
                        ->join('fragrance_profile', 'fragrance_profile.id', '=', 'perceiver.profile_id')
                        ->where('profile_id', $profile->id)
                        ->select('profile_id', 'fragrance_profile.detail', 'fragrance.name', 'perceiver.like')
                        ->get();
                        
                    $profile_fragrances = $profile_fragrances->merge($profile_fragrance);
                }
                $profile_fragrances = $profile_fragrances->groupBy('profile_id');

                // Profiles with no Fragrances
                foreach ($profiles as $profile){
                    $check = 0;
                    foreach ($profile_fragrance as $not_empty){
                        if($profile->id == $not_empty->profile_id){
                            $check = 1;
                        }
                    }

                    if($check == 0){
                        // $empty_profile = DB::table('perceiver')
                        // ->join('fragrance_profile', 'fragrance_profile.id', '=', 'perceiver.profile_id')
                        // ->where('profile_id', $profile->id)
                        // ->select('profile_id', 'fragrance_profile.detail')
                        // ->get();
                    
                        $empty_profiles[$index]= $profile;    
                        $index = $index+1;             
                    }
                }

                // foreach ($profiles as $p){
                // var_dump($p->id);
                // return;
                // }

            }
        }

        // if(!empty($profiles) || !empty($empty_profiles) ){
        //     $fav_brand = NULL;
        //     var_dump(empty($profiles));
        //     var_dump(empty($empty_profiles));
        //     return;
        // }
        
        if($empty_profiles->isEmpty()){
            $empty_profiles = NULL;
        }
        
        if($profile_fragrances->isEmpty()){
            $profile_fragrances = NULL;
        }

        return view('home',[
            'fav_brand'             => $fav_brand,
            'user_fragrances'       => $user_fragrances,
            'user_profile'          => $user_profile,
            'empty_profiles'        => $empty_profiles,
            'profiles'              => $profile_fragrances
        ]);

    }

    // public function show(Fragrance_Brand $fragrance_Brand)
    // {
    //  //   $brand = Fragrance_Brand::find($fragrance_Brand);
    //  return view('forms.brand_show',['brand'=> $fragrance_Brand]);
    // }
   
}