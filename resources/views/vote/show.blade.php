@extends('vote.layout')
@section('body')
  <!-- Header -->
  <header id="" class="header">
      <div class="text-vertical-center">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-3">
              <img src="{{asset('miss.png')}}" alt="miss" class="img-responsive" width="100%">
            </div>
          </div>
          <h1>MISS STIKOM Bali 2017</h1>
          <h4>Voting MISS Favorite MISS STIKOM Bali 2017</h4>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-1">
              <div class="alert alert-warning">
                Silakan pilih kandidat favorit anda, satu kode tiket hanya berlaku untuk sekali vote.
              </div>
            </div>
          </div>
          <br>
          <div class="container">
            <div class="row">
              @foreach ($candidate as $row)
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="{{asset('images/'.$row->picture)}}" alt="{{$row->name}}">
                    <div class="caption">
                      <span class="text-center">{{$row->number}}</span>
                      <h3>{{($row->name)}}</h3>
                      <p class="text-center"><button class="btn btn-warning btn-lg" role="button" onclick="voteCandidate({{$row->id}},'{{$row->name}}')">Vote</button></p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
      </div>
  </header>

  <form class="hidden" action="{{url('voting/vote')}}" method="post" id="formVote">
    {{ csrf_field() }}
    <input type="hidden" name="ticket" value="{{$ticket}}" id="code">
    <input type="hidden" name="candidate_id" value="" id="candidate_id">
  </form>
  <script src="{{asset('vote/js/jquery.js')}}"></script>
  <script src="{{asset('vote/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('vote/js/bootbox.min.js')}}" charset="utf-8"></script>
  <script type="text/javascript">

    function voteCandidate(id,name){
      bootbox.confirm({
          size: "small",
          message: "Apakah anda ingin vote "+name+" ?",
          buttons: {
              confirm: {
                  label: 'Ya',
                  className: 'btn btn-primary'
              },
              cancel: {
                  label: 'Tidak',
                  className: 'btn btn-default'
              }
          },
          callback: function (result) {
              if (result) {
                $('#formVote #candidate_id').val(id);
                $('#formVote').submit();
              }
          }
      }).find('.modal-content').css(
        'margin-top', function(){
          var w = $( window ).height();
          var b = $(".modal-dialog").height();
          var h = (w-b)/2;
          return h+"px";
        }
      );
    }
  </script>
@endsection
