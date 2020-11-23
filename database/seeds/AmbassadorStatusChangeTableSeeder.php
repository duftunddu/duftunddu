<?php

use App\Brand_Ambassador_Request;
use App\Brand_Ambassador_Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AmbassadorStatusChangeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Brand Ambassador Requests
        Brand_Ambassador_Request::withTrashed()->where('status', '0')->update(['status' => "new_brand_request"]);
        Brand_Ambassador_Request::withTrashed()->where('status', '1')->update(['status' => "new_brand_details_request"]);
        Brand_Ambassador_Request::withTrashed()->where('status', '2')->update(['status' => "existing_brand_request"]);
        Brand_Ambassador_Request::withTrashed()->where('status', '3')->update(['status' => "rejected"]);
        Brand_Ambassador_Request::withTrashed()->where('status', '4')->update(['status' => "brand_ambassador"]);
    }
}
