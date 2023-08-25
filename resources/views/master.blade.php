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
    <!-- <div class="jumbotorn jumbotorn-fluid wow fadeInUp">
        <div class="container">
            <h1 class="display-4">Selamat Datang</h1>
            <p class="lead">Sistem Pendukung Keputusan Penerimaan Bantuan Langsung Tunai Dana Desa</p>
        </div>
    </div> -->
    <!-- <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Selamat Datang</h1>
            <p>Sistem Pendukung Keputusan Penerimaan Bantuan Langsung Tunai Dana Desa</p>
        </div>
    </div> -->
    <br>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="{{asset ('gambar/BG.png')}}" alt="background">
            <div class="carousel-caption">
                <h3 class="home">Selamat Datang</h3>
                <p class="home">Sistem Pendukung Keputusan Penerimaan Bantuan Langsung Tunai Dana Desa</p>
            </div>
        </div>
    </div>
    <!--/.row-->
    <br>
    <!-- ./col -->
    <div class="col-lg-6 col-6">
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
    <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <div class="large"><strong>{{$kriterias}}</strong></div>
                <div class="text"><strong>Jumlah Kriteria</strong></div>
            </div>
            <div class="icon">
                <i class="fa fa-pie-chart" aria-hidden="true"></i>
            </div>
            <a href="{{route('kriteria.index')}}" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            <!-- <a href="" class="small-box-footer">Report <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <div class="col-lg-12">
        <div class="alert alert-info" role="alert">
            <strong>
                <font size="4" face="Poppins">SPK BLT-DD</font>
            </strong>
            <font face="Poppins">
                <p style="text-align: justify;">SPK BLT-DD adalah layanan khusus untuk menyimpan, mendukung keputusan, mengelola data calon penerima bantuan langsung tunai dana desa dari pemerintah.
                    Layanan ini memudahkan Anda dalam pengambilan keputusan siapa saja yang layak menerima bantuan. Selain itu, Anda juga dimudahkan untuk dapat mengatur sendiri nilai bobot intensitas yang dipakai</p>
            </font>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default articles">
            <div class="panel-heading">
                Pengumuman
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body articles-container" style="display: block;">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-2 col-md-2 date">
                            <div class="large">20</div>
                            <div class="text-muted">Aug</div>
                        </div>
                        <div class="col-xs-10 col-md-10">
                            <h4>
                                <a href="https://drive.google.com/file/d/18PNlmMQ1rq08FESDoGDpD_9CK0648diC/view?usp=sharing" target="_blank">Pedoman Penggunaan Aplikasi</a>
                            </h4>
                            <p>Berikut merupakan buku pedoman penggunaan aplikasi SPK BLT-DD yang dapat didwonload.</p>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="article border-bottom"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default articles">
            <div class="panel-heading">
                Banyak Penduduk
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body articles-container" style="display: block;">
                <div class="col-xs-12">
                    <div class="row">
                        <!-- <div class="col-xs-2 col-md-2 date">
                            <div class="large">20</div>
                            <div class="text-muted">Aug</div>
                        </div> -->
                        <div class="col-xs-12 col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Dusun</th>
                                        <th scope="col">Jiwa</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <th>1</th>
                                        <td>Gedong</td>
                                        <td>233</td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>Klari</td>
                                        <td>535</td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>Dampet</td>
                                        <td>265</td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <td>Mlanggeng</td>
                                        <td>315</td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <td>Boyosari</td>
                                        <td>321</td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <td>Nataan</td>
                                        <td>724</td>
                                    </tr>
                                    <tr>
                                        <th>7</th>
                                        <td>Ngujung Jobo</td>
                                        <td>375</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="article border-bottom"></div>
            </div>
        </div>
    </div>
</div>
@endsection