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
                        <div class="large"><strong>2</strong></div>
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
                        <div class="large"><strong></strong></div>
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
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up">

                    </em>
                </span>
                <form class="form-inline" id="filterForm">
                    <div class="form-group">
                        <input type="text" name="jumlahOrang" id="jumlahOrang" class="form-control mb-2" placeholder="Jumlah Orang">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-filter"></i> Filter</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabelPemeringkatan">
                    <thead class="text-center" style="vertical-align:middle;">
                        <tr>
                            <th colspan="6">Daftar Warga Yang Mendapatkan Bantuan</th>
                        </tr>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">NKK</th>
                            <th rowspan="2">NIK</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Alamat</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="vertical-align:middle;">
                        @foreach($pemeringkatans as $pemeringkatan => $data)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $data->alternatif_id }}</td>
                            <td>{{ $data->nkk }}</td>
                            <td>{{ $data->nik }}</td>
                            <td>{{ $data->nama }}</td>
                            <td class="text-left">{{ $data->alamat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 my-12">
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    $(document).ready(function() {
        //Tangkap subit form
        $('#filterForm').on('submit', function(e) {
            e.preventDefault(); //Mencegah form submit secara default
            //Ambil nilai jumlah orang dari input 
            var jumlahOrang = $('#jumlahOrang').val();
            //Lakukan request ajax
            $.ajax({
                type: "GET",
                url: "{{ route('home') }}",
                data: {
                    jumlahOrang: jumlahOrang
                },
                success: function(response) {
                    $('#tabelPemeringkatan').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>