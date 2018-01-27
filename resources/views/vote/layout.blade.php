<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MISS STIKOM Bali">
    <meta name="author" content="HIMAPRODI SI">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('miss.png')}}">
    <title>Voting MISS STIKOM Bali 2017</title>

    <link href="{{asset('vote/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vote/css/stylish-portfolio.css')}}" rel="stylesheet">
    <link href="{{asset('vote/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Josefin+Sans|Lobster" rel="stylesheet">
</head>

<body>
  @yield('body')
</body>

</html>
