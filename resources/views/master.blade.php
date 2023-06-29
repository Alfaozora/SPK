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
            <div class="col-lg-6 col-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <div class="large"><strong><!--{{$penduduks}}-->2</strong></div>
                        <div class="text"><strong> Penduduk Mendapatkan Bantuan</strong></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-handshake-o" aria-hidden="true"></i>
                    </div>
                    <a href="" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    <!-- <a href="" class="small-box-footer">Report <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <div class="large"><strong>{{number_format($alternatifs)}}</strong></div>
                        <div class="text"><strong>Jumlah Penduduk Yang Terdaftar</strong></div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                    </div>
                    <a href="{{route('alternatif.index')}}" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    <!-- <a href="" class="small-box-footer">Report <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
        </div>
        </br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <form class="form-inline">
                    <div class="form-group">
                        <h4>Daftar Warga Mendapatkan Bantuan</h4>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="text-center" style="vertical-align:middle;">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">NKK</th>
                            <th rowspan="2">Nama</th>

                        </tr>
                    </thead>
                    <tbody class="text-center" style="vertical-align:middle;">
                        @foreach($pemeringkatans as $pemeringkatan)
                        @php
                        $alternatifs = App\Models\Alternatif::where('kode', $pemeringkatan->kode)->first();
                        $nkk = $alternatifs ? $alternatifs->nkk : 'N/A';
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $pemeringkatan->alternatif_id }}</td>
                            <td>{{$nkk}}</td>
                            <td>{{ $pemeringkatan->nama }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 my-12">

            </div>
        </div>
        <!--/.row-->
        <!--/.row-->
    </div>
    <!--/.main-->
    @endsection