@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div id="tableContainer">
    <div class="wow fadeInLeft">
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">
                            <em class="fa fa-home"></em>
                        </a></li>
                    <li class="breadcrumb-item"><a href="{{ route('alternatif.index') }}"> Alternatif</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Riwayat Alternatif</li>
                </ol>
            </div>
            <!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Riwayat Alternatif</h2>
                </div>
            </div>
        </div>
        <!--/.main-->
    </div>
    <div class="wow fadeIn">
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <form class="form-inline">
                                <!-- <div class="form-group">
                                    <input id="cari" name="cari" type="text" class="form-control" placeholder="Cari Nama, NIK, NKK">
                                </div> -->
                                <select id="tahunDropdown" name="tahunDropdown" class="form-control" onchange="caritahun()">
                                    <option value="">Pilih Tahun</option>
                                    @foreach ($tahunList as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="text-center" style="vertical-align:middle;">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Tahun</th>
                                        <th rowspan="2">NKK</th>
                                        <th rowspan="2">NIK</th>
                                        <th rowspan="2">Nama Penduduk</th>
                                        <th rowspan="2">Alamat</th>
                                        <th rowspan="2">Nomor Hp</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" style="vertical-align:middle;">
                                    @foreach ($riwayat_alternatifs as $a)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $a->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->created_at->year }}</td>
                                        <td>{{$a->nkk}}</td>
                                        <td>{{ $a->nik }}</td>
                                        <td>{{ $a->nama }}</td>
                                        <td>{{ $a->alamat }}</td>
                                        <td>{{ $a->nomor }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <p class="back-link">Desa Gedongboyountung 2023</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
</script>
<script>
    $(document).ready(function() {
        // Tangkap submit form
        $('#tahunDropdown').change(function(e) {
            e.preventDefault(); // Mencegah form submit secara default

            // Ambil nilai jumlah orang dari input
            var tahun = $('#tahunDropdown').val();

            // Lakukan request ajax untuk memfilter dan menampilkan tabel
            $.ajax({
                type: "GET",
                url: "{{ route('riwayat.tampil') }}",
                data: {
                    tahun: tahun
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