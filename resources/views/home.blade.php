@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Selamat datang {{Auth::user()->name}}</div>

                <div class="panel-body">
                  <div class="">
                    <a href="{{url('panel/clear')}}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Clear</a>
                    <a href="{{url('panel/generate')}}" class="btn btn-success"><i class="fa fa-refresh"></i> Generate</a>
                    <a href="{{url('panel/download')}}" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                  </div>
                  <hr>
                  <table class="table table-responsive table-bordered table-striped" width='100%'>
                    <tr>
                      <th>Nomor Tiket</th>
                      <th>Kode Tiket</th>
                      <th width="10%">Voting</th>
                    </tr>
                    @foreach ($data as $r)
                      <tr>
                        <td>{{$r->id}}</td>
                        <td>{{$r->kode_tiket}}</td>
                        @if (count($r->vote['id']) == 0)
                          <td style="color:red">BELUM</td>
                        @else
                          <td style="color:green">SUDAH</td>
                        @endif
                      </tr>
                    @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
