<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SPK BANSOS</title>
    <link rel="icon" href="{{asset ('gambar/logo.ico')}}">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset ('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset ('css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset ('css/styles.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    @include('layouts.navbar')
    @include('layouts.sidebar')
    @yield('container')
    <script src="{{asset ('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset ('js/bootstrap.min.js')}}"></script>
    <script src="{{asset ('js/chart.min.js')}}"></script>
    <script src="{{asset ('js/chart-data.js')}}"></script>
    <script src="{{asset ('js/easypiechart.js')}}"></script>
    <script src="{{asset ('js/easypiechart-data.js')}}"></script>
    <script src="{{asset ('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset ('js/custom.js')}}"></script>
</body>

</html>