<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ticket;
use App\TicketAccess;
use App\Candidate;
use App\Vote;
use Session;

class VoteController extends Controller
{
  public function index(){
    return view('vote.index');
  }

  public function check($ticket){
    $status = [
      'status' => false,
      'msg' => 'Pastikan kode yang anda masukan benar dan belum pernah digunakan.'
    ];
    $ticket = strtoupper($ticket);
    $data = Ticket::where('unique_number',$ticket)->get();
    $access = TicketAccess::where('unique_number',$ticket)->get();
    if (count($data) == 1 && count($data[0]->Vote) == 0) {
      if (count($access) == 1) {
        $status = [
          'status' => true,
          'msg' => 'Tunggu sebentar, anda akan di alihkan.'
        ];
      }else {
        $status = [
          'status' => false,
          'msg' => 'Pastikan anda telah melakukan pembelian tiket dan mengkonfirmasikan ke panitia.'
        ];
      }
    }
    return response()->json($status);
  }

  public function show(Request $request){
    $ticket = $request->ticket;
    $data = Ticket::where('unique_number',$ticket)->get();
    if (count($data) == 1 && count($data[0]->Vote) > 0) {
      return redirect(url('/voting'));
    }
    $candidate =  DB::table('section_ones')
      ->select('candidates.number','candidates.name','candidates.id','candidates.picture',
        DB::raw('sum(((((((interviews.kemampuan_logika_berpikir * 0.25) + (interviews.kemampuan_menjawab_pertanyaan * 0.25) + (interviews.komunikatif * 0.25) + (interviews.percaya_diri * 0.25)) * 0.5) + (section_ones.kemampuan_menjawab_pertanyaan * 0.5)) * 0.3) + (((section_ones.fashion_show * 0.2 ) + (section_ones.catwalk * 0.2) + (section_ones.body_language * 0.2) + (section_ones.ekspresi * 0.2) + (section_ones.kecantikan * 0.2)) * 0.35) + (((section_ones.public_speaking * 0.4) + (section_ones.sikap * 0.3) + (section_ones.percaya_diri * 0.3)) * 0.35))) as total')
      )
      ->join('interviews','interviews.id','section_ones.interview_id')
      ->join('candidates','candidates.id','interviews.candidate_id')
      ->groupBy('candidates.number','candidates.name','candidates.id','candidates.picture')
      ->orderBy('total','desc')
      ->limit(16)
      ->get();
      return view('vote.show',compact('ticket','candidate'));
  }


  public function vote(Request $request){
    $ticket = Ticket::select('id')->where('unique_number',$request->ticket)->first();
    $access = TicketAccess::where('unique_number',$request->ticket)->count();
    if (Vote::where('ticket_id',$ticket['id'])->count() == 0 && $access == 1 ) {
      $vote = new Vote;
      $vote->candidate_id = $request->candidate_id;
      $vote->ticket_id = $ticket['id'];
      if ($vote->save()) {
        Session::flash('alert','Terimakasih sudah melakukan voting.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Gagal melakukan voting silakan ulangin.');
        Session::flash('alert-class','alert-danger');
      }
    }else {
      Session::flash('alert','Gagal melakukan voting, kode sudah digunakan atau tidak terdaftar pada vote list.');
      Session::flash('alert-class','alert-danger');
    }
    return view('vote.finish');
  }


}
