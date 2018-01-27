@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Generate Tiket</div>
                <div class="panel-body">
                  <form class="" action="{{url('panel/clear')}}" method="post">
                    <input type="hidden" name="_method" value="delete">
                    {{csrf_field()}}
                    <p>Apakah anda ingin menghapus semua data tiket ?</p>
                    <a class="btn btn-primary" type="button" href="{{url('panel')}}">Kembali</a>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
