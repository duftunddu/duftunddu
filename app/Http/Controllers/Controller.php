<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
 use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

 // public function brand_entry($request)
 // {
 //     var_dump($request);
 //     return view('brand_entry');
 // }

 // public function brand($request)
 // {
 //     var_dump($request);
 //     return view('brand');
 // }

 public function brand(Request $request)
 {
  echo ($request->BrandName);
  return view('brand');
 }

 public function brand_entry_try()
 {
  return view('forms.brand_entry_try');
 }

 public function about_us()
 {
  return view('forms.about_us');
 }

 function try () {
  return view('forms.try');
 }

 public function range_slider()
 {
  return view('forms.range_slider');
 }

 public function catalog()
 {
  return view('forms.catalog');
 }

}
