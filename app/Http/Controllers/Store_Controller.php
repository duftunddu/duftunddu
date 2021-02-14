<?php

namespace App\Http\Controllers;

use App\Fragrance;
use App\Fragrance_Brand;

use App\Store;
use App\Store_Stock;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Store_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        return view('forms.store_register');
    }

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

    public function show_stock() {

        $stock = Store_Stock::where('store_id', Store::find(request()->user()->id)->id)
        ->where('available', TRUE)
        ->get();

        // $json = json_encode($stock);

        // $var = (object) [
        //     [
        //         "Name" => "Alfreds Futterkiste",
        //         "City" => "Berlin",
        //         "Country"=> "Germany"
        //     ],[
        //         "Name" => "Alfreds Futterkiste",
        //         "City" => "Berlin",
        //         "Country"=> "Germany"
        //     ]
        // ];

        // $myObj->name = "John";
        // $myObj->age = 30;
        // $myObj->city = "New York";

        // $var = json_encode($var);

        // var_dump($var);
        // var_dump($json); return;
        
        // dd(Store::find(request()->user()->id));

        return view('store.stock',[
            // 'fragrances'    =>  $fragrances,
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
      
        // Fetch ids if they exist
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
        
        // If the fragrance existed previously in stock, then available = TRUE
        if($brand_id){
            // If its existence includes brand_id, so only the fragrance is changed.

            if($fragrance_id){
                // If its existence also includes fragrance_id
                $stock = Store_Stock::where('store_id', $store_id)
                ->where('fragrance_brand_id', $brand_id)
                ->where('fragrance_id', $fragrance_id)
                ->first();
            }
            else{
                // If only brand exists
                $stock = Store_Stock::where('store_id', $store_id)
                ->where('fragrance_brand_id', $brand_id)
                ->where('fragrance_name', $request->input('fragrance'))
                ->first();
            }
        }
        else{
            // If its existence doesn't includes brand_id, so only the fragrance is changed.

            if($fragrance_id){
                // If its existence also includes fragrance_id
                $stock = Store_Stock::where('store_id', $store_id)
                ->where('fragrance_brand_name', $request->input('brand'))
                ->where('fragrance_id', $fragrance_id)
                ->first();
            }
            else{
                // If only brand exists
                $stock = Store_Stock::where('store_id', $store_id)
                ->where('fragrance_brand_name', $request->input('brand'))
                ->where('fragrance_name', $request->input('fragrance'))
                ->first();
            }
        }

        // These are attempts at a cleaner version of code but it doesn't work when, if variables are null
            // If the fragrance existed previously in stock, then available = TRUE
            // $stock = Store_Stock::where('store_id', $store_id)
            // ->where(function ($query) {
            //     $query->where('fragrance_brand_id', $brand_id)
            //         ->orWhere('fragrance_brand_name', $request->input('brand'));
            // })
            // ->where(function ($query) {
            //     $query->where('fragrance_id', $fragrance_id)
            //         ->orWhere('fragrance_name', $request->input('fragrance'));
            // })
            // ->get();
        // collapse

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
            DB::transaction(function () use ($request, $brand_id, $fragrance_id, $store_id) {

                    $new                =   new Store_Stock();
                    
                    // Column doesn't exist. Will be added when more than one store owners is implemented.
                    // $new->users_id          = request()->user()->id;

                    $new->store_id      =   $store_id;
                    $new->available     =   TRUE;

                    if($brand_id){
                        $new->fragrance_brand_id        =   $brand_id;   
                    }
                    else{
                        $new->fragrance_brand_name      =   $request->input('brand');
                    }
                    
                    if($fragrance_id){
                        $new->fragrance_id              =   $fragrance_id;   
                    }
                    else{
                        $new->fragrance_name            =   $request->input('fragrance');
                    }
                    $new->save();
            });
        }
        return redirect()->back()->with('success', "{$request->input('fragrance')} has been added to your stock.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validatedData = $request->validate([ 
            'accord_familiy_id' => 'required',
            'name'              => 'required|unique:accord',
        ]);

        // DB::transaction(function () use ($request) {

        //         $new                = new Accord();
        //         $new->name          = $request->input('accord_familiy_id');
        //         $new->name          = $request->input('name');
        //         $new->created_by    = request()->user()->id;
        //         $new->save();
        // });

        // return redirect('/accord_entry')->with('success', 'Accord added successfully.');
    }
}
