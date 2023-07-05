@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="container-fluid col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb wow fadeInLeft">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="wow fadeInLeft active">Hasil</li>
        </ol>
    </div>
    <div class="jumbotorn jumbotorn-fluid wow fadeInUp">
        <div class="container">
            <h2 class="display-4">Hasil Dari Proses Perhitungan</h2>
            <p>Masukan Jumlah Warga Yang Diprioritaskan</p>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <form class="form-inline" id="filterForm">
                <div class="form-group">
                    <input type="number" name="jumlahOrang" id="jumlahOrang" class="form-control mb-2" placeholder="Jumlah Warga">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mb-2" id="filterButton"><i class="fa fa-filter"></i> Filter</button>
                </div>
                <div class="form-group">
                    <a class="btn btn-danger mb-2" id="btnCetak" href="{{route('hasil.cetak')}}"><i class="fa fa-file-pdf-o"></i> Cetak PDF</a>
                </div>
                <div class="form-group">
                    <a class="btn btn-success mb-2" id="btnCetak" href="{{route('hasil.excel')}}"><i class="fa fa-file-excel-o"></i> Cetak Excel</a>
                </div>
            </form>
        </div>
        <div class="table-responsive" id="tableContainer">
            <table class="table table-bordered table-striped table-hover">
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
@endsection
<!-- Membuat ajax untuk memfilter data dan menampilkan tabel -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js">
    $(document).ready(function() {
        // Tangkap submit form
        $('#filterButton').on('submit', function(e) {
            e.preventDefault(); // Mencegah form submit secara default

            // Ambil nilai jumlah orang dari input
            var jumlahOrang = $('#jumlahOrang').val();

            // Lakukan request ajax untuk memfilter dan menampilkan tabel
            $.ajax({
                type: "GET",
                url: "{{ route('hasil') }}",
                data: {
                    jumlahOrang: jumlahOrang
                },
                success: function(response) {
                    // Tampilkan tabel
                    $('#tableContainer').html(response);
                    $('#tableContainer').show();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>