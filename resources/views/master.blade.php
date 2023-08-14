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
            <p class="lead">Sistem Pendukung Keputusan Penerimaan Bantuan Langsung Tunai Dana Desa</p>
        </div>
    </div>
    <!--/.row-->
    <br>
    <!-- ./col -->
    <div class="col-lg-6 col-12">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <div class="large"><strong>{{$alternatifs}}</strong></div>
                <div class="text"><strong>Jumlah Penduduk Yang Terdaftar</strong></div>
            </div>
            <div class="icon">
                <i class="fa fa-address-book" aria-hidden="true"></i>
            </div>
            <a href="{{route('alternatif.index')}}" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            <!-- <a href="" class="small-box-footer">Report <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <div class="col-lg-12">
        <div class="alert alert-info" role="alert">
            <strong>
                <font size="4" face="Poppins">SPK BLT-DD</font>
            </strong>
            <font face="Poppins">
                <p>SPK BLT-DD adalah layanan khusus untuk menyimpan, mendukung keputusan, mengelola data calon penerima bantuan langsung tunai dana desa dari pemerintah.
                    Layanan ini memudahkan Anda dalam pengambilan keputusan siapa saja yang layak menerima bantuan. Selain itu, Anda juga dimudahkan untuk dapat mengatur sendiri nilai bobot intensitas yang dipakai</p>
            </font>
        </div>
    </div>
</div>
</div>
</div>
@endsection