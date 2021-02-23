<?php namespace App\Helper;

use App;

use App\Location;
use App\Store;
use App\Store_Stock;

use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class Store_Helper {
    public function __construct()
    {
        //
    }

    public function get_store_id()
    {
        return Store::where('users_id', request()->user()->id)->first()->id;
    }

    // Just to show the names
    public function get_store_stock_names()
    {
        $store_id = new Store_Helper();
        $store_id = $store_id->get_store_id();

        $stock = Store_Stock::where('store_id', $store_id)
        ->where('available', TRUE)
        ->select('id', 'fragrance_brand_name', 'fragrance_name')
        ->orderBy('fragrance_brand_name')
        ->orderBy('fragrance_name')
        ->get();

        return $stock;
    }

    // For fragrance ids and stuff
    public function get_store_stock_fragrances()
    {
        $store_id = new Store_Helper();
        $store_id = $store_id->get_store_id();

        $stock = Store_Stock::where('store_id', $store_id)
        ->join('fragrance', 'fragrance.id', 'store_stock.fragrance_id')
        ->where('available', TRUE)
        ->select('fragrance.id as id', 'fragrance_brand_name as brand', 'fragrance_name as fragrance')
        ->get();

        return $stock;
    }

    public function get_store_stock_with_accords()
    {
        $store_id = new Store_Helper();
        $store_id = $store_id->get_store_id();

        // $accords = DB::table('fragrance_accord')
        // ->where('store_stock.store_id', $store_id)
        // ->join('store_stock', 'fragrance_id', 'fragrance.id')
        // ->where('fragrance_accord.fragrance_id', 'fragrance.id')
        // ->join('accord', 'accord.id', '=', 'fragrance_accord.accord_id')
        // ->select('accord.name')
        // ->pluck('name')
        // ->toArray();

        $accords = DB::table('store')
        ->join('store_stock', 'store_stock.store_id', 'store.id')
        ->where('store_stock.store_id', $store_id)
        ->join('fragrance', 'fragrance.id', 'store_stock.fragrance_id')
        ->join('fragrance_accord', 'fragrance_accord.fragrance_id', 'fragrance.id')
        ->join('accord', 'accord.id', 'fragrance_accord.accord_id')
        ->select('fragrance.id', 'accord.name')
        // ->where('fragrance_accord.fragrance_id', 'fragrance_id')
        ->get();

        // $accords = $accords->groupBy('fragrance.id');

        // $accords->groupBy('id');
        // ->where('fragrance_accord.fragrance_id', 'fragrance_id')
        // ->join('accord', 'accord.id', '=', 'fragrance_accord.accord_id')
        // ->select('accord.name')
        // ->pluck('name')
        // ->toArray();
    

        return $accords;

        // $accords = DB::table('fragrance_accord')
        //     ->where('fragrance_accord.fragrance_id', $id)
        //     ->join('accord', 'accord.id', '=', 'fragrance_accord.accord_id')
        //     ->select('accord.name')
        //     ->pluck('name')
        //     ->toArray();
    
        // $stock = Store_Stock::where('store_id', $store_id)
        $stock = Store_Stock::where('store_id', $store_id)
        ->where('available', TRUE)
        // ->select('id', 'fragrance_brand_name', 'fragrance_name')
        ->orderBy('fragrance_brand_name')
        ->get();

        return $stock;
    }
}