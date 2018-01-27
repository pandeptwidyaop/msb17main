<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $r){
      return view('main');
    }

    public function download(){
      $pathToFile = public_path('download/download.zip');
      $name = 'form-pendaftaran-miss-stikom-bali-2017.zip';
      return response()->download($pathToFile, $name);
    }
}
