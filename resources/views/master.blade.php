@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="container-fluid col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb wow fadeInLeft">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="wow fadeInLeft active">Dashboard</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="container-fluid chat wow fadeInUp">
        <div class="row">
        </div>
        <!--/.row-->
        <!--/.row-->
    </div>
    <!--/.main-->
    @endsection