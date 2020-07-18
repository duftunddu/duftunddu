<?php

/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
*/

Route::get('search_engine', 'Search_Queries_Controller@index');
Route::post('search_engine', 'Search_Queries_Controller@store');

Route::get('/', function () {
    return view('forms.welcome');
});
   
Route::get('m', function () {
    return view('forms.welcome_m');
});

Route::get('about_us', function () {
    return view('forms.about_us');
});

Route::get('catalog', function () {
    return view('forms.catalog');
});

Route::get('faq', function () {
    return view('forms.faq');
});

Route::get('whitepaper', function () {
    return view('forms.whitepaper');
});

Route::get('/brands', 'Fragrance_Brand_Controller@output');
Route::get('/brands/{id}', 'Fragrance_Brand_Controller@show');


// Authorized Routes
Auth::routes();

// new_user|user|genie_user|premium_user
Route::middleware(['role:new_user|user|genie_user|premium_user|super_admin'])->group(function () {
    Route::get('/profile', 'Fragrance_Profile_Controller@index');
    Route::post('/profile', 'Fragrance_Profile_Controller@store');
   
});

// user|genie_user|premium_user
Route::middleware(['role:user|genie_user|premium_user|super_admin'])->group(function () {
    Route::get('home', 'HomeController@index')
    ->name('home');
    
    Route::get('/genie_input', 'Perceiver_Controller@index');
    Route::post('/genie_input', 'Perceiver_Controller@store');

    Route::get('/genie_output', 'Perceiver_Controller@output');
    Route::post('/genie_output', 'Perceiver_Controller@output');

});

// brand_ambassador|premium_brand_ambassador|user|genie_user|premium_user
Route::middleware(['role:brand_ambassador|premium_brand_ambassador|user|genie_user|premium_user|super_admin'])->group(function () {

    Route::get('/accord_entry', 'Accord_Controller@index');
    Route::post('/accord_entry', 'Accord_Controller@store');

    Route::get('/note_entry', 'Ingredient_Controller@index');
    Route::post('/note_entry', 'Ingredient_Controller@store');

    Route::get('/fragrance_entry', 'Fragrance_Controller@index');
    Route::post('/fragrance_entry', 'Fragrance_Controller@store');

});

// brand_ambassador|premium_brand_ambassador
Route::middleware(['role:brand_ambassador|premium_brand_ambassador|super_admin'])->group(function () {

    Route::get('/brand_entry', 'Fragrance_Brand_Controller@index');
    Route::post('/brand_entry', 'Fragrance_Brand_Controller@store');
    
});

// super_admin
Route::middleware(['role:super_admin'])->group(function () {

    Route::get('/try', 'Controller@try');
    Route::post('/try', 'Controller@try_output');

    Route::get('footer', function () {
        return view('layouts.footer');
    });
    
    Route::get('admin_links', function () {
        return view('forms.admin_links');
    });
    
    Route::get('scroll', function () {
        return view('layouts.scroll');
    }); 
    
    Route::get('range_slider', function () {
        return view('forms.range_slider');
    });
    
    Route::get('/feature_slider', function () {
        return view('forms.feature_slider');
    });

});

// sample
// Route::middleware(['role:brand_ambassador|user|super_admin'])->group(function () {
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
