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
    <div class="jumbotorn jumbotorn-fluid wow fadeInUp">
        <div class="container">
            <h1 class="display-4">Selamat Datang</h1>
            <p class="lead">Sistem Pendukung Keputusan Penerimaan Bantuan Sosial</p>
        </div>
    </div>
    <!--/.row-->
    <br>
    <div class="container-fluid chat wow fadeInUp">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <div class="large"><strong>Rp.@idr</strong></div>
                        <div class="text"><strong> Pemasukan</strong></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-arrow-up"></i>
                    </div>
                    <a href="" class="small-box-footer">More Info Report <i class="fa fa-arrow-circle-right"></i></a>
                    <a href="" class="small-box-footer">Report <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <div class="large"><strong>Rp.@idr</strong></div>
                        <div class="text"><strong>Pengeluaran</strong></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-arrow-down"></i>
                    </div>
                    <a href="" class="small-box-footer">More Info Report <i class="fa fa-arrow-circle-right"></i></a>
                    <a href="" class="small-box-footer">Report <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <div class="large"><strong></strong><small> Kg</small></div>
                        <div class="text"><strong>Kain</strong></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <a href="" class="small-box-footer">Order <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <div class="large"><strong></strong><small> Yard</small></div>
                        <div class="text"><strong>Benang</strong></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <a href="" class="small-box-footer">Order <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!--/.row-->
        <!--/.row-->
    </div>
    <!--/.main-->
    @endsection