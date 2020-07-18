<?php

namespace App\Http\Controllers;


use App\Accord;
use App\Fragrance;
use App\Fragrance_Brand;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function try () {
    $accords = accord::all();
    return view('forms.try',[
      'countries' => $accords
    ]);
  }

  public function try_output (Request $request) {
    $accords = $request->accord_ids;
    var_dump($accords);
    return;
    return view('forms.try_output');
  }

}
