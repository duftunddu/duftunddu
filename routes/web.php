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

Route::get('search_engine', 'Search_Queries_Controller@index')->name('search');
Route::get('search_results', 'Search_Queries_Controller@store');
// Route::post('search_results', 'Search_Queries_Controller@store');

Route::get('feedback', 'Feedback_Controller@index');
Route::post('feedback', 'Feedback_Controller@store');

// Route::get('/', 'Controller@landing_page');

Route::get('/', function () {
    return view('forms.welcome');
});
   
// Route::get('m', function () {
//     return view('forms.welcome_m');
// });

Route::get('about_us', function () {
    return view('forms.about_us');
});

Route::get('catalog', function () {
    return view('forms.catalog');
});

Route::get('faq', function () {
    return view('forms.faq');
});

Route::get('terms_and_conditions', function () {
    return view('forms.terms_and_conditions');
});

Route::get('privacy_policy', function () {
    return view('forms.privacy_policy');
});


Route::get('brand_ambassador_proposal', function () {
    return view('brand_ambassador.proposal');
});

Route::get('feature_slider_brand_ambassador', function () {
    return view('forms.feature_slider_brand_ambassador');
});

Route::get('brands', 'Fragrance_Brand_Controller@all_brands');
Route::get('brand/{id}', 'Fragrance_Brand_Controller@show');

Route::get('fragrances_array/{id}', 'Fragrance_Controller@all_fragrances_array');
Route::get('fragrances/{id}', 'Fragrance_Controller@all_fragrances');
Route::get('fragrance/{id}', 'Fragrance_Controller@show');
Route::post('affecting_factors_data', 'Affecting_Factors_Data_Controller@store');

Route::post('cities_of_country', 'Controller@cities_of_country');

Route::get('request_brand_view', 'Request_Brand_Controller@show');
Route::get('request_feature_view', 'Feature_Request_Controller@show');


// Authorized Routes
Auth::routes();

// new_user|user|genie_user|premium_user
Route::middleware(['role:new_user|user|genie_user|premium_user|admin'])->group(function () {
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profile', 'Fragrance_Profile_Controller@index');
    Route::post('/profile', 'Fragrance_Profile_Controller@store');
   
});

// user|genie_user|premium_user
Route::middleware(['role:user|genie_user|premium_user|admin'])->group(function () {
    Route::get('home', 'HomeController@index')
    ->name('home');
    
    Route::get('/genie_input/{profile_id}', 'Perceiver_Controller@index');
    Route::post('/genie_input/{profile_id}', 'Perceiver_Controller@store');

    Route::get('genie_output', 'Perceiver_Controller@output');
    Route::post('genie_output', 'Perceiver_Controller@output');

    Route::get('request_brand', 'Request_Brand_Controller@index');
    Route::post('request_brand', 'Request_Brand_Controller@store');
    Route::post('vote_brand', 'Request_Brand_Controller@vote');
    
    Route::get('request_feature_user', 'Feature_Request_By_User_Controller@index');
    Route::post('request_feature_user', 'Feature_Request_By_User_Controller@store');
    Route::post('vote_feature', 'Feature_Request_Controller@store');
});

// user|genie_user|premium_user|candidate_brand_ambassador|admin
Route::middleware(['role:user|genie_user|premium_user|candidate_brand_ambassador|admin'])->group(function () {

    Route::get('brand_ambassador_register', 'Brand_Ambassador_Request_Controller@index');
    Route::post('brand_ambassador_register', 'Brand_Ambassador_Request_Controller@store');

});

// candidate_brand_ambassador|new_brand_ambassador|admin
Route::middleware(['role:candidate_brand_ambassador|new_brand_ambassador|admin'])->group(function () {

    Route::get('application_status', 'Brand_Ambassador_Request_Controller@application_status');

});

// new_brand_ambassador|admin
Route::middleware(['role:new_brand_ambassador|admin'])->group(function () {

    Route::get('brand_entry', 'Fragrance_Brand_Controller@index_ba');
    Route::post('brand_entry/{brand_name}', 'Fragrance_Brand_Controller@store_ba');

});

// brand_ambassador|premium_brand_ambassador
Route::middleware(['role:brand_ambassador|premium_brand_ambassador|admin'])->group(function () {

    Route::get('ambassador_home', 'Brand_Ambassador_Controller@index');

    // Only Admins are allowed to enter Accords and Ingredients for the time being. 
    // Route::get('accord_entry', 'Accord_Controller@index_ba');
    // Route::post('accord_entry', 'Accord_Controller@store_ba');

    // Route::get('note_entry', 'Ingredient_Controller@index_ba');
    // Route::post('note_entry', 'Ingredient_Controller@store_ba');

    Route::get('fragrance_entry', 'Fragrance_Controller@index_ba');
    Route::post('fragrance_entry', 'Fragrance_Controller@store_ba');
    
    Route::get('advertise', 'Brand_Ambassador_Controller@advertise');
    
});

// admin
Route::middleware(['role:admin'])->group(function () {

    Route::get('/request_brand_panel', 'Admin_Controller@request_brand_status');
    Route::get('/request_brand_panel/{brand_name}/{new_status}', 'Admin_Controller@request_brand_status_change');

    Route::get('/request_feature_panel', 'Admin_Controller@request_feature_status');
    Route::get('/request_feature_panel/{feature_id}/{new_status}', 'Admin_Controller@request_feature_status_change');

    Route::get('/request_feature_user_review', 'Admin_Controller@request_feature_user_review');
    Route::get('/request_feature_user_review/{id}/{action}', 'Admin_Controller@request_feature_user_action');
    Route::post('/request_feature_user_add', 'Admin_Controller@request_feature_user_store');

    Route::get('accord_entry', 'Accord_Controller@index');
    Route::post('accord_entry', 'Accord_Controller@store');

    Route::get('note_entry', 'Ingredient_Controller@index');
    Route::post('note_entry', 'Ingredient_Controller@store');

    Route::get('/brand_entry_admin', 'Fragrance_Brand_Controller@index');
    Route::post('/brand_entry_admin', 'Fragrance_Brand_Controller@store');
    
    Route::get('/fragrance_entry_admin', 'Fragrance_Controller@index');
    Route::post('/fragrance_entry_admin', 'Fragrance_Controller@store');
    
    Route::get('/try', 'Controller@try');
    Route::post('/try', 'Controller@try_output');

    Route::get('/brand_ambassador_requests', 'Admin_Controller@brand_ambassador_request');
    Route::get('/brand_ambassador_requests/{status}/{ambassador_id}', 'Admin_Controller@brand_ambassador_request_response');

    Route::get('footer', function () {
        return view('layouts.footer');
    });
    
    Route::get('admin_links', function () {
        return view('admin.all_links');
    });
    
    Route::get('scroll', function () {
        return view('layouts.scroll');
    }); 
    
    Route::get('range_slider', function () {
        return view('forms.range_slider');
    });
    
    Route::get('feature_slider', function () {
        return view('forms.feature_slider');
    });

    Route::get('slider_major', function () {
        return view('forms.slider_major');
    });

    Route::get('slider_major_2', function () {
        return view('forms.slider_major_2');
    });
    
    Route::get('button_hold_to_confirm', function () {
        return view('forms.button_hold_to_confirm');
    });

    Route::get('header', function () {
        return view('layouts.header');
    });
    
    Route::get('button_get_wishes', function () {
        return view('forms.button_get_wishes');
    });

    Route::get('button_custom_fancy', function () {
        return view('forms.button_custom_fancy');
    });

    Route::get('button_plus', function () {
        return view('forms.button_plus');
    });

    Route::get('button_learn_more', function () {
        return view('forms.button_learn_more');
    });
});

// sample
// Route::middleware(['role:user|admin'])->group(function () {
// });