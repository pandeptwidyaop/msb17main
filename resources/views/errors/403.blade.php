@extends('vote.layout')
@section('body')
  <header id="top" class="header">
      <div class="text-vertical-center">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
              <img src="{{asset('miss.png')}}" alt="miss" class="img-responsive" width="100%">
            </div>
          </div>
          <h1>MISS STIKOM Bali 2017</h1>
          <h2>404 YOUR PAGE IS NOT FOUND</h2>
      </div>
  </header>
  <form class="hidden" action="{{url('voting')}}" method="post" id="formTicket">
    {{ csrf_field() }}
    <input type="hidden" name="ticket" value="" id="code">
  </form>
  <script src="{{url('vote/js/jquery.js')}}"></script>
  <script src="{{url('vote/js/bootstrap.min.js')}}"></script>
@endsection
