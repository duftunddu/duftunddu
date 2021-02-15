<?php

namespace App\Http\Controllers;

use App\Fragrance;
use App\Fragrance_Brand;

use App\Store;
use App\Store_Stock;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Store_Controller extends Controller
{

    public function __construct() {
        // 
    }


    // Register
    public function index(){
        return view('forms.store_register');
    }


    // Home
    public function home(){
        if(!request()->user()->hasRole('store_owner')) {
            return redirect('/services_register');
        }
        
        // $no_of_f = Store::write the rest
        $no_of_f = 5;

        // $store_id = Store::where('users_id',request()->user()->id)->first()->id;
        $store_id = 2;

        return view('store.home',[
            'no_of_f'   =>  $no_of_f,
        ]);
    }


    // Stock Suitability
    public function stock_suitability(){
        // 
    }


    // Stock
    public function show_stock() {

        $stock = Store_Stock::where('store_id', Store::find(request()->user()->id)->id)
        ->where('available', TRUE)
        ->select('id', 'fragrance_brand_name', 'fragrance_name')
        ->orderBy('fragrance_brand_name')
        ->get();

        return view('store.stock',[
            'stock'         =>  $stock,
        ]);
    }

    public function add_to_stock_view() {
        $brands      = Fragrance_Brand::pluck('name');
        $fragrances  = Fragrance::pluck('name');
      
        return view('store.add_to_stock',[
            'brands'         => $brands,
            'fragrances'     => $fragrances,
        ]);
    }

    public function add_to_stock(Request $request)
    {
        $validatedData = $request->validate([ 
            'brand'             =>  'required',
            'fragrance'         =>  'required',
        ]);
      
        // Fetch brand and fragrnace ids if they exist
        $brand_id = NULL; $fragrance_id = NULL;
        $brand_id = Fragrance_Brand::where('name', $request->input('brand'))
            ->orWhere('normal_name', $request->input('brand'))
            ->pluck('id')
            ->first();

        if($brand_id){
            $fragrance_id = Fragrance::where('name', $request->input('fragrance'))
            ->orWhere('normal_name', $request->input('fragrance'))
            ->where('brand_id', $brand_id)
            ->pluck('id')
            ->first();
        }
        else{
            $fragrance_id = Fragrance::where('name', $request->input('fragrance'))
            ->orWhere('normal_name', $request->input('fragrance'))
            ->pluck('id')
            ->first();
        }
        
        $store_id = Store::find(request()->user()->id)->id;
        
        $stock = Store_Stock::where('store_id', $store_id)
            ->where('fragrance_brand_name', $request->input('brand'))
            ->where('fragrance_name', $request->input('fragrance'))
            ->first();

        // If it existed, make it available and return. Otherwise, save it.
        if($stock){
        
            // If it is already available, LET THEM KNOW
            if($stock->available){
                return redirect()->back()->with('info', "{$request->input('fragrance')} is already in your stock.");
            }

            $stock->available = TRUE;
            $stock->save();
        }
        else{
            // If it didn't exist in stock before, then save it.
            // Storing

            $normal_b_name = Helper::remove_accents($request->input('brand'));
            $normal_f_name = Helper::remove_accents($request->input('fragrance'));


            DB::transaction(function () use ($request, $brand_id, $fragrance_id, 
            $store_id, $normal_b_name, $normal_f_name) {

                $new                            =   new Store_Stock();
                
                $new->store_id                  =   $store_id;
                $new->fragrance_brand_name      =   $normal_b_name;
                $new->fragrance_name            =   $normal_f_name;

                if($brand_id){
                    $new->fragrance_brand_id    =   $brand_id;   
                }
                if($fragrance_id){
                    $new->fragrance_id          =   $fragrance_id;   
                }

                $new->available                 =   TRUE;
                $new->save();
            });
        }
        return redirect()->back()->with('success', "{$request->input('fragrance')} by {$request->input('brand')} is added to your stock.");
    }

    public function remove_from_stock($stock_id)
    {
        $store_id = Store::find(request()->user()->id)->id;
        $stock = Store_Stock::find($stock_id);
        
        // If stock_id doesn't exist or this is not the owner of the stock 
        if(!$stock or $stock->store_id != $store_id){
            return redirect()->back()->with('error', "Request is invalid.");
        }
        
        $stock->available = FALSE;
        $stock->save();

        return redirect()->back()->with('success', "{$stock->fragrance_name} is removed from your stock.");
    }
}
