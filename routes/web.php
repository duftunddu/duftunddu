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

//  Temporary
Route::get('/brand', 'Controller@brand');
Route::post('/brand', 'Controller@brand');

Route::get('/brand_entry_try', 'Country_Controller@index');
Route::post('/brand_entry_try', 'Country_Controller@store');

// Authentic

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/accord_entry', function(){
 return view('Accord_Controller@index');
})->middleware('auth');

Route::get('/accord_entry', 'Accord_Controller@index');
Route::post('/accord_entry', 'Accord_Controller@store');

Route::get('/note_entry', 'Ingredient_Controller@index');
Route::post('/note_entry', 'Ingredient_Controller@store');

Route::get('/brand_entry', 'Fragrance_Brand_Controller@index');
Route::post('/brand_entry', 'Fragrance_Brand_Controller@store');

Route::get('/brand_output', 'Fragrance_Brand_Controller@index2');
Route::get('/brand_output/{id}', 'Fragrance_Brand_Controller@show');

// Route::get('/brand_output_try', 'Fragrance_Brand_Controller@index2');

Route::get('/fragrance_entry', 'Fragrance_Controller@index');
Route::post('/fragrance_entry', 'Fragrance_Controller@store');

Route::get('/genie_input', 'Perceiver_Controller@index');
Route::post('/genie_input', 'Perceiver_Controller@store');

Route::get('/genie_output', 'Perceiver_Controller@output');
Route::post('/genie_output', 'Perceiver_Controller@output');

Route::get('/search_engine', 'Search_Queries_Controller@index');
Route::post('/search_engine', 'Search_Queries_Controller@store');

Route::get('/about_us', 'Controller@about_us');

Route::get('/catalog', 'Controller@catalog');

Route::get('/try', 'Controller@try');
Route::post('/try', 'Controller@try_output');


Route::get('/range_slider', 'Controller@range_slider');
