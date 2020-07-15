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

// Route::get('/', function () {
//  return view('welcome');
// });

Route::get('/', function () {
 return view('forms.welcome');
});

Route::get('/m', function () {
    return view('forms.welcome_m');
});
   
Auth::routes();

Route::middleware(['role:new_user|user'])->group(function () {
    Route::get('home', 'HomeController@index')
    ->name('home');

    // Route::get('user/profile', function () {
    //     // Uses first & second Middleware
    // });
});


Route::get('/accord_entry', 'Accord_Controller@index')->middleware('role:user');
Route::post('/accord_entry', 'Accord_Controller@store')->middleware('role:user');

Route::get('/note_entry', 'Ingredient_Controller@index')->middleware('role:user');
Route::post('/note_entry', 'Ingredient_Controller@store')->middleware('role:user');

Route::get('/brand_entry', 'Fragrance_Brand_Controller@index')->middleware('role:brand_ambassador');
Route::post('/brand_entry', 'Fragrance_Brand_Controller@store')->middleware('role:brand_ambassador');

Route::get('/brands', 'Fragrance_Brand_Controller@output');
Route::get('/brands/{id}', 'Fragrance_Brand_Controller@show');

Route::get('/fragrance_entry', 'Fragrance_Controller@index')->middleware('role:user');
Route::post('/fragrance_entry', 'Fragrance_Controller@store')->middleware('role:user');

Route::get('/genie_input', 'Perceiver_Controller@index')->middleware('role:user');
Route::post('/genie_input', 'Perceiver_Controller@store')->middleware('role:user');

Route::get('/genie_output', 'Perceiver_Controller@output')->middleware('role:user');
Route::post('/genie_output', 'Perceiver_Controller@output')->middleware('role:user');

Route::get('/search_engine', 'Search_Queries_Controller@index')->middleware('role:user');
Route::post('/search_engine', 'Search_Queries_Controller@store')->middleware('role:user');

Route::get('/profile', 'Fragrance_Profile_Controller@index')->middleware('role:user');
Route::post('/profile', 'Fragrance_Profile_Controller@store')->middleware('role:user');

Route::get('/about_us', 'Controller@about_us');

Route::get('/catalog', 'Controller@catalog');

Route::get('footer', 'Controller@footer')->middleware('role:super_admin');

Route::get('admin_links','Controller@admin_links')->middleware('role:super_admin');

Route::get('scroll','Controller@scroll')->middleware('role:super_admin');

Route::get('/try', 'Controller@try')->middleware('role:super_admin');
Route::post('/try', 'Controller@try_output')->middleware('role:super_admin');

Route::get('/range_slider', 'Controller@range_slider')->middleware('role:super_admin');
