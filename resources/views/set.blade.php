@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Generate Tiket</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-5">
                      <form class="" action="{{url('panel/generate')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                          <label for="panjang">Panjang Tiket</label>
                          <input type="number" name="panjang" value="" id="panjang" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="prefix">Prefix Tiket</label>
                          <input type="text" name="prefix" value="" id="prefix" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="random">Letter Tiket</label>
                          <input type="text" name="letter" value="abcdefABCDEF0123456789" id="random" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="jumlah">Jumlah Tiket</label>
                          <input type="number" name="jumlah" value="" id="jumlah" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Generate</button>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
