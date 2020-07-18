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

        $check_perceiver = collect();

        // $check_perceiver = DB::table('perceiver')
        // ->where('profile_id', $profiles->first()->id)
        // ->get();

        if(empty($check_perceiver)){
        // User Profile
        $data_fav_brand = DB::table('perceiver')
            ->join('fragrance', 'fragrance.id', '=', 'perceiver.fragrance_id')
            ->where('profile_id', $profiles->first()->id)
            ->select('fragrance.brand_id', DB::raw('COUNT(fragrance.brand_id) AS occurrences'))
            ->groupBy('fragrance.brand_id')
            ->orderBy('occurrences', 'DESC')
            ->get();
        
        $fav_brand = DB::table('fragrance_brand')->where('id', $data_fav_brand->first()->brand_id)->get();

        $user_fragrances = DB::table('perceiver')
                ->join('fragrance', 'fragrance.id', '=', 'perceiver.fragrance_id')
                ->where('profile_id', $profiles->first()->id)
                ->select('fragrance.name', 'perceiver.like')
                ->get();

        unset($profiles[0]);

        // Other profiles
        $profile_fragrances = collect();

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

        return view('home',[
            'brand'                 => $fav_brand[0],
            'user_fragrances'       => $user_fragrances,
            'profiles'              => $profile_fragrances
        ]);
        
    }

    $fav_brand = collect();
    $user_fragrances = collect();
    $profile_fragrances = collect();
        return view('home',[
            'brand'                 => $fav_brand,
            'user_fragrances'       => $user_fragrances,
            'profiles'              => $profile_fragrances
        ]);

    }

    // public function show(Fragrance_Brand $fragrance_Brand)
    // {
    //  //   $brand = Fragrance_Brand::find($fragrance_Brand);
    //  return view('forms.brand_show',['brand'=> $fragrance_Brand]);
    // }
   
}