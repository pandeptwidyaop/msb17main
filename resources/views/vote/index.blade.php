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
          <h4>Voting MISS Favorite MISS STIKOM Bali 2017</h4>
          <p>Masukan kode unik pada tiket anda untuk melakukan voting.</p>
          <br>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-1">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="ex : MSB17DAE54XXXXXXXXXX" id="inputTicket" required>
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button" id="buttonTicket" onclick="verify();">Go Voting</button>
                </span>
              </div>
            </div>
            <br>
            <br>
            <br>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-1">
              <div class="alert alert-warning alert-dismissible hidden" role="alert" id="alertMsg">


                </div>
            </div>
          </div>
      </div>
  </header>
  <form class="hidden" action="{{url('voting')}}" method="post" id="formTicket">
    {{ csrf_field() }}
    <input type="hidden" name="ticket" value="" id="code">
  </form>
  <script src="{{url('vote/js/jquery.js')}}"></script>
  <script src="{{url('vote/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript">
    $(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    });
    function verify(){
      var code = $('#inputTicket').val();
      var alert = $('#inputTicket');
      var msg = $('#alertMsg')
      if (code == '') {
        alert.addClass('input-danger');
      }else {
        alert.removeClass('input-danger');
        msg.addClass('hidden');
        $.ajax({
          url: '{{url('/voting')}}/'+code+'/check',
          type: 'GET',
          dataType: 'json',
          success : function(result){
            if (result.status) {
              $('#code').val(code);
              msg.text('');
              msg.removeClass('alert-warning');
              msg.addClass('alert-success');
              msg.append('<strong>Perhatian !</strong> '+result.msg);
              msg.removeClass('hidden');
              $('#formTicket').submit();
            }else {
              alert.addClass('input-danger');
              msg.text('');
              msg.append('<strong>Perhatian !</strong> '+result.msg);
              msg.removeClass('hidden');
            }
          }
        });
      }
    }
  </script>
@endsection
