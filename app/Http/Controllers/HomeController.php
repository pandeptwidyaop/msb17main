<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use App\Vote;
use Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tiket::all();
        return view('home',compact('data'));
    }

    public function setUp(){
      return view('set');
    }

    public function generate(Request $req){
      $panjang = ($req->panjang)-strlen($req->prefix);
      $letter = $req->letter;
      for ($i=0; $i < $req->jumlah ; $i++) {
        $kode = '';
        for ($j=0; $j < $panjang ; $j++) {
          $kode .= $letter[rand(0, strlen($req->letter) - 1)];
        }
        $tiket[] = ['kode_tiket' => $req->prefix.$kode];
      }
      Tiket::insert($tiket);
      return redirect('panel');
    }

    public function clear(){
      return view('del');
    }

    public function delete(){
      Vote::truncate();
      Tiket::truncate();
      return redirect('/panel');;
    }

    public function download(){
      $data = Tiket::select('id as Nomor', 'kode_tiket as Kode')->orderBy('Nomor','ASC')->get()->toArray();
      return Excel::create('tiket_malam_puncak', function($excel) use ($data){
        $excel->sheet('tiket', function($sheet) use ($data) {
          $sheet->fromArray($data);
        });
      })->download('xlsx');
    }

}
