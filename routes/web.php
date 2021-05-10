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

Route::get('/', function () {
    return view('forms.welcome');
});

Route::get('/search_engine', 'Search_Queries_Controller@index')->name('search');
Route::get('/search_results', 'Search_Queries_Controller@store');
Route::get('/search_autocomplete', 'Search_Queries_Controller@autocomplete');


Route::get('/feedback', 'Feedback_Form_Controller@index');
Route::post('/feedback', 'Feedback_Form_Controller@store');

Route::get('/report', 'Feedback_Comment_Controller@index');
Route::post('/report', 'Feedback_Comment_Controller@store');

// Service Registration
Route::get('/services_register', "Services_Controller@index");
Route::post('/services_register', "Services_Controller@store");

Route::get('/about_us', function () {
    return view('forms.about_us');
});

Route::get('/catalog', function () {
    return view('forms.catalog');
});

Route::get('/faq', function () {
    return view('forms.faq');
});

Route::get('/credits', function () {
    return view('forms.credits');
});

Route::get('/terms_and_conditions', function () {
    return view('forms.terms_and_conditions');
});

Route::get('/privacy_policy', function () {
    return view('forms.privacy_policy');
});


// Proposals
Route::get('/brand_ambassador_proposal', function () {
    return view('brand_ambassador.proposal');
});

Route::get('/store_proposal', function () {
    return view('store.proposal');
});

Route::get('/webstore_proposal', function () {
    return view('webstore.proposal');
});


// Brands
Route::get('/brands', 'Fragrance_Brand_Controller@all_brands');
Route::get('/brand/{id}', 'Fragrance_Brand_Controller@show');

// Fragrances
Route::get('/fragrances_array/{id}', 'Fragrance_Controller@all_fragrances_array');
Route::get('/fragrances/{brand_id}', 'Fragrance_Controller@all_fragrances');
Route::get('/fragrance/{fragrance_id}', 'Fragrance_Controller@show');
Route::post('/affecting_factors_data', 'Affecting_Factors_Data_Controller@store');

Route::post('/cities_of_country', 'Controller@cities_of_country');

Route::get('/request_brand_view', 'Request_Brand_Controller@show');
Route::get('/request_feature_view', 'Feature_Request_Controller@show');


// Register Store
Route::get('/store_register', "Store_Request_Controller@index");
Route::post('/store_register', "Store_Request_Controller@store");

Route::get('/webstore_register', "Webstore_Request_Controller@index");
Route::post('/webstore_register', "Webstore_Request_Controller@store");


// Webstore Call
Route::get('/webstore_call/{api_key}/{user_ip_address}/{brand}/{fragrance}/{fragrance_type}/{theme}', "Webstore_Controller@webstore_call");


Route::get('/webstore_profile/{store_id?}', "Webstore_Controller@add_profile");
// Route::post('/webstore_profile', "Webstore_Controller@store_profile");
Route::get('/webstore_profile/some', "Webstore_Controller@store_profile");
// Route::post('/webstore_profile', "Controller@meow");

Route::get('/webstore_fragrance/{brand}/{fragrance}', "Webstore_Controller@show_fragrance");


// Serve CSS Script
Route::get('/webstore_client_css.css', "Webstore_Controller@webstore_client_css");
Route::get('/webstore_client_js.js', "Webstore_Controller@webstore_client_js");


// Authorized Routes
// Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function() {


    // new_user|user|genie_user
    Route::middleware(['role:new_user|user|genie_user|admin', 'verified'])->group(function () {
        
        // Home 
        Route::get('/home', 'HomeController@index')->name('home');

        // Profile Entry
        Route::get('/profile', 'Fragrance_Profile_Controller@index');
        Route::post('/profile', 'Fragrance_Profile_Controller@store');
    
    });


    // user|genie_user
    Route::middleware(['role:user|genie_user|admin', 'verified'])->group(function () {
        
        // Genie Input
        // Route::get('/genie_input/{profile_id}', 'Perceiver_Controller@index');
        // Route::post('/genie_input/{profile_id}', 'Perceiver_Controller@store');

        
        // Genie Output
        // Route::get('/genie_output', 'Perceiver_Controller@output');
        // Route::post('/genie_output', 'Perceiver_Controller@output');

        
        // Request Brand
        Route::get('/request_brand', 'Request_Brand_Controller@index');
        Route::post('/request_brand', 'Request_Brand_Controller@store');
        Route::post('/vote_brand', 'Request_Brand_Controller@vote');
        

        // Request Feature
        Route::get('/request_feature_user', 'Feature_Request_By_User_Controller@index');
        Route::post('/request_feature_user', 'Feature_Request_By_User_Controller@store');
        Route::post('/vote_feature', 'Feature_Request_Controller@store');


        // Research Entry
        Route::get('/fragrance_review_entry', 'User_Fragrance_Review_Controller@index');
        Route::post('/fragrance_review_entry', 'User_Fragrance_Review_Controller@store');
    });


    // user|genie_user|candidate_brand_ambassador|admin
    Route::middleware(['role:user|genie_user|candidate_brand_ambassador|admin', 'verified'])->group(function () {
        
        Route::get('/brand_ambassador_register', 'Brand_Ambassador_Request_Controller@index');
        Route::post('/brand_ambassador_register', 'Brand_Ambassador_Request_Controller@store');

    });


    // candidate_brand_ambassador|new_brand_ambassador|admin
    Route::middleware(['role:candidate_brand_ambassador|new_brand_ambassador|admin', 'verified'])->group(function () {

        Route::get('/brand_ambassador_application_status', 'Brand_Ambassador_Request_Controller@application_status');

    });


    // new_brand_ambassador|admin
    Route::middleware(['role:new_brand_ambassador|admin'])->group(function () {

        Route::get('/brand_entry', 'Fragrance_Brand_Controller@index_ba');
        Route::post('/brand_entry/{brand_name}', 'Fragrance_Brand_Controller@store_ba');

    });


    // Services
    Route::middleware(['role:service_user|admin'])->group(function () {
        Route::get('/services_home', "Services_Controller@home");
    });


    // Application Status
    Route::middleware(['role:new_store_owner|new_webstore_owner|admin'])->group(function () {

        Route::get('/store_application_status', "Store_Request_Controller@show");
        Route::get('/webstore_application_status', "Webstore_Request_Controller@show");

    });



    // Store
    Route::middleware(['role:store_owner|admin'])->group(function () {

        // Home
        Route::get('/store_home', "Store_Controller@home");
        
        // Call 
        Route::get('/store_call', "Store_Controller@call");

        // Profile
        Route::get('/store_profile/{store_type}/{store_id?}', "Store_Controller@add_profile");
        Route::post('/store_profile', "Store_Controller@store_profile");

        // Show Fragrance
        Route::get('/store_fragrance/', "Store_Controller@empty_stock");
        Route::get('/store_fragrance/{fragrance_id}', "Store_Controller@show_fragrance");
        // Route::get('/fragrance/{store_type}/{fragrance_id}', "Store_Controller@show_fragrance");
        
        // Show Stock
        Route::get('/store_stock', "Store_Controller@show_stock");
        
        // Add / Remove Stock
        Route::get('/store_add_to_stock', "Store_Controller@add_to_stock_view");
        Route::post('/store_add_to_stock', "Store_Controller@add_to_stock");
        Route::get('/store_remove_from_stock/{stock_id}', "Store_Controller@remove_from_stock");

        // Get Suitability of Stock
        Route::get('/store_stock_suitability', "Store_Controller@stock_suitability");
    });



    // Webstore
    Route::middleware(['role:webstore_owner|admin'])->group(function () {
        
        // Home
        Route::get('/webstore_home', "Webstore_Controller@home");
        

        // Stock Related
        // Show Stock
        Route::get('/webstore_stock', "Webstore_Controller@show_stock");
        
        // Add / Remove Stock
        Route::get('/webstore_add_to_stock', "Webstore_Controller@add_to_stock_view");
        Route::post('/webstore_add_to_stock', "Webstore_Controller@add_to_stock");
        Route::get('/webstore_remove_from_stock/{stock_id}', "Webstore_Controller@remove_from_stock");

        // Get Suitability of Stock
        Route::get('/webstore_stock_suitability', "Webstore_Controller@stock_suitability");
    });


    // brand_ambassador
    Route::middleware(['role:brand_ambassador|admin', 'verified'])->group(function () {

        Route::get('/ambassador_home', 'Brand_Ambassador_Controller@index');

        // Only Admins are allowed to enter Accords and Ingredients for the time being. 
        // Route::get('/accord_entry', 'Accord_Controller@index_ba');
        // Route::post('/accord_entry', 'Accord_Controller@store_ba');

        // Route::get('/note_entry', 'Ingredient_Controller@index_ba');
        // Route::post('/note_entry', 'Ingredient_Controller@store_ba');

        Route::get('/fragrance_entry', 'Fragrance_Controller@index_ba');
        Route::post('/fragrance_entry', 'Fragrance_Controller@store_ba');
        
        Route::get('/advertise', 'Brand_Ambassador_Controller@advertise');
        
    });




    // Moderator
    Route::middleware(['role:moderator|admin'])->group(function () {

        // All Moderator Links
        Route::get('moderator_links', function () {
            return view('moderator.links');
        });


        // Unavailable Brands & Fragrances
        Route::get('/unavailable_brands_fragrances_panel', "Unavailable_Brands_Fragrances_Controller@index");

        
        // Add Brand
        Route::get('/add_brand_mod/{brand_name}', 'Unavailable_Brands_Fragrances_Controller@add_brand_view');
        Route::post('/add_brand_mod', 'Unavailable_Brands_Fragrances_Controller@store_brand');

        // Add Fragrance
        Route::get('/add_fragrance_mod/{fragrance_name}', 'Unavailable_Brands_Fragrances_Controller@add_fragrance_view');
        Route::post('/add_fragrance_mod', 'Unavailable_Brands_Fragrances_Controller@store_fragrance');
        

        // Accords & Notes
        Route::get('/accord_entry', 'Accord_Controller@index');
        Route::post('/accord_entry', 'Accord_Controller@store');

        Route::get('/note_entry', 'Ingredient_Controller@index');
        Route::post('/note_entry', 'Ingredient_Controller@store');
    });


    // Admin
    Route::middleware(['role:admin'])->group(function () {

        // Webstore
        // Webstore API
        Route::get('/webstore_call_dev/{api_key}/{user_ip_address}/{brand}/{fragrance}/{fragrance_type}/{theme}',  "Webstore_Controller@webstore_call_dev");
        
        // Webstore Client
        Route::get('/webstore_client', "Webstore_Controller@webstore_client");
        Route::get('/webstore_client_dev', "Webstore_Controller@webstore_client_dev");

        // Route::get('/new_model', "Webstore_Controller@new_model");
        // Route::get('/api_call', "Controller@api_call");
        // End of Webstore

        
        // Ad
        Route::get('/ad_api', "Controller@ad_index");
        Route::get('/ad/{page_name}', function () {
            return view('vue_layout');
        });
        // End of Ad


        // Research
        // Route::get('/research_proposal', function () {
        //     return view('research.proposal');
        // });
        // Route::get('/fragrance_review_home', 'Research_Controller@index');
        
        Route::get('user_fragrance_review_download', 'Admin_Controller@user_fragrance_review_show');
        Route::get('user_fragrance_review/download', 'Admin_Controller@user_fragrance_review_export');
        // End of Research
    
        
        // Stores  Panel
        Route::get('/store_panel', 'Admin_Controller@store_panel');
        Route::get('/store/{store_type}/{id}/{action}', 'Admin_Controller@store_panel_response');

        // Stores Requests Panel
        Route::get('/stores_requests_panel', 'Admin_Controller@stores_requests');
        Route::get('/stores_requests_response/{id}/{action}', 'Admin_Controller@stores_requests_response');
        // End of Store


        // Email
        Route::get('/email_panel', 'Email_Master_Controller@panel');
        Route::post('/email_send', 'Email_Master_Controller@send');

        Route::get('/email_template_show', 'Email_Master_Controller@template_show');
        Route::post('/email_template_show', 'Email_Master_Controller@template_show');
        // End of Email


        // Brand Ambassdador
        Route::get('/request_brand_panel', 'Admin_Controller@request_brand_status');
        Route::get('/request_brand_panel/{brand_name}/{new_status}', 'Admin_Controller@request_brand_status_change');
        // End of Brand Ambassdador


        Route::get('/request_feature_panel', 'Admin_Controller@request_feature_status');
        Route::get('/request_feature_panel/{feature_id}/{new_status}', 'Admin_Controller@request_feature_status_change');

        Route::get('/request_feature_user_review', 'Admin_Controller@request_feature_user_review');
        Route::get('/request_feature_user_review/{id}/{action}', 'Admin_Controller@request_feature_user_action');
        Route::post('/request_feature_user_add', 'Admin_Controller@request_feature_user_store');


        // Accords & Notes
        // Route::get('accord_entry', 'Accord_Controller@index');
        // Route::post('accord_entry', 'Accord_Controller@store');

        // Route::get('note_entry', 'Ingredient_Controller@index');
        // Route::post('note_entry', 'Ingredient_Controller@store');
        // End of Accords & Notes

        Route::get('/brand_entry_admin', 'Fragrance_Brand_Controller@index');
        Route::post('/brand_entry_admin', 'Fragrance_Brand_Controller@store');
        
        Route::get('/fragrance_entry_admin', 'Fragrance_Controller@index');
        Route::post('/fragrance_entry_admin', 'Fragrance_Controller@store');
        
        Route::get('/try', 'Controller@try');
        Route::post('/try', 'Controller@try_output');
        Route::get('/try_api', 'Controller@try_api');


        Route::get('/brand_ambassador_requests', 'Admin_Controller@brand_ambassador_request');
        Route::get('/brand_ambassador_requests/{status}/{ambassador_id}', 'Admin_Controller@brand_ambassador_request_response');

        Route::get('/admin_links', function () {
            return view('admin.links');
        });
        

        // Individual Tests
        Route::get('/footer', function () {
            return view('layouts.footer');
        });
        
        Route::get('/header', function () {
            return view('layouts.header');
        });

        Route::get('/services_accordion', function () {
            return view('features.services_accordion');
        });

        Route::get('/services_accordion_major', function () {
            return view('features.services_accordion_major');
        });

        Route::get('/scroll_down_button', function () {
            return view('features.scroll_down_button');
        }); 
        
        Route::get('/scroll', function () {
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
        // End of Individual Tests
    });

});