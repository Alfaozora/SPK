@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="wow fadeInLeft">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">About</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">About Us</h2>
            </div>
        </div>
    </div>
    <!--/.main-->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <p>Nama: Hafiz Aria Alfaizi</p>
        <br>
        <p>NIM : 1918019</p>
    </div>
</div>