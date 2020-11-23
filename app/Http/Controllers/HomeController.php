<?php

namespace App\Http\Controllers;

use App\Perceiver;
use App\Fragrance_Brand;
use App\Fragrance_Profile;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Helper\Helper;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_profile = Fragrance_Profile::where('users_id', request()->user()->id)->first();


        if (empty($user_profile)){
            return redirect('profile');
        }

        $user_fragrances = DB::table('perceiver')
            ->join('fragrance', 'fragrance.id', '=', 'perceiver.fragrance_id')
            ->where('profile_id', $user_profile->id)
            ->select('fragrance.id', 'fragrance.name', 'perceiver.like')
            ->get();


        $fav_brand = DB::table('perceiver')
            ->join('fragrance', 'fragrance.id', '=', 'perceiver.fragrance_id')
            ->where('profile_id', $user_profile->id)
            ->groupBy('fragrance.brand_id')
            ->orderBy('occurrences', 'DESC')
            ->join('fragrance_brand', 'fragrance_brand.id', '=', 'fragrance.brand_id')
            ->select('fragrance_brand.id', 'fragrance_brand.name', DB::raw('COUNT(fragrance.brand_id) AS occurrences'))
            ->first();

        $profiles = DB::table('fragrance_profile')
            ->where('users_id', request()->user()->id)
            ->where('fragrance_profile.id', '!=', $user_profile->id)
            ->leftJoin('perceiver', 'perceiver.profile_id', '=', 'fragrance_profile.id')
            ->leftJoin('fragrance', 'fragrance.id', '=', 'perceiver.fragrance_id')
            ->select('fragrance_profile.id as profile_id', 'fragrance_profile.name as p_name', 'fragrance.name as f_name', 'perceiver.like')
            ->orderBy('profile_id')
            ->get();
        $profiles = $profiles->groupBy('profile_id');

        // Helper::var_dump_readable($profiles);return;

        return view('home',[
            'fav_brand'             => $fav_brand,
            'user_fragrances'       => $user_fragrances,
            'user_profile'          => $user_profile,
            'profiles'              => $profiles
        ]);

    }
}
