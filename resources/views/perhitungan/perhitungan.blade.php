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
                <li class="active">Perhitungan</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Perhitungan Fuzzy AHP</h2>
            </div>
        </div>
    </div>
    <!--/.main-->
</div>
<div class="wow fadeIn">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('perhitungan.store') }}">
                    @csrf
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="form-group">
                                <p>Inisialisasi Matriks Perbandingan Berpasangan</p>
                            </div>
                        </div>
                        <div class="table-responsive" id="tableContainer">
                            <table class="table table-bordered table-striped table-hover" id="table1">
                                <thead class="text-center" style="vertical-align:middle;">
                                    <tr>
                                        <th>
                                            Kriteria
                                        </th>
                                        @foreach($kriterias as $kriteria)
                                        <th class="text-center" style="vertical-align:middle;">{{$kriteria->nama_kriteria}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="text-center" style="vertical-align:middle;">
                                    @php
                                    $no = 0;
                                    @endphp
                                    @foreach($kriterias as $kriteria)
                                    <tr>
                                        <td class="text-left" style="vertical-align:middle;">{{$kriteria->nama_kriteria}}</td>
                                        @foreach($kriterias as $kriteria2)
                                        <td class="text-center" style="vertical-align:middle;">
                                            @if($kriteria->kode_kriteria == $kriteria2->kode_kriteria)
                                            <input type="hidden" name="nilai[{{$kriteria->kode_kriteria}}][{{$kriteria2->kode_kriteria}}]" value="1">
                                            1
                                            @else
                                            @if($kriteria->kode_kriteria > $kriteria2->kode_kriteria)
                                            <input type="hidden" name="nilai[{{$kriteria->kode_kriteria}}][{{$kriteria2->kode_kriteria}}]" value="0">
                                            0
                                            @else
                                            <select class="form-control form-control-sm" name="nilai[{{$kriteria->kode_kriteria}}][{{$kriteria2->kode_kriteria}}]">
                                                @foreach ($nilaiintensitas as $n)
                                                <option value="{{$n->jum_nilai}}">{{$n->jum_nilai}}-{{$n->keterangan}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="form-group">
                                <p>Input Bobot Nilai Kriteria Untuk Masing Masing Alternatif</p>
                            </div>
                        </div>
                        <div class="table-responsive" id="tableContainer">
                            <table class="table table-bordered table-striped table-hover" id="table1">
                                <thead class="text-center" style="vertical-align:middle;">
                                    <tr>
                                        <th>
                                            Alternatif
                                        </th>
                                        @foreach($kriterias as $kriteria)
                                        <th class="text-center" style="vertical-align:middle;">{{$kriteria->nama_kriteria}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="text-center" style="vertical-align:middle;">
                                    @php
                                    $no = 0;
                                    @endphp
                                    @foreach($alternatifs as $alternatif)
                                    <tr>
                                        <td class="text-left" style="vertical-align:middle;">
                                            <input type="hidden" name="alternatif[{{$alternatif->nama}}]" value="{{$alternatif->kode}}">
                                            {{$alternatif->nama}}
                                        </td>
                                        @foreach($kriterias as $kriteria)
                                        <td class="text-center" style="vertical-align:middle;">
                                            <select class="form-control form-control-sm" name="bobot[{{$alternatif->kode}}][{{$kriteria->kode_kriteria}}]">
                                                @foreach ($sub_kriterias as $sub)
                                                @if($sub->kode_kriteria == $kriteria->kode_kriteria)
                                                <option value="{{$sub->bobot}}">{{$sub->nama_sub}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" id="showTable2">
                        Normalisasi
                    </button>
                </form>
                </br>
                </br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="table2" style="display: none;">

                    </table>
                </div>
            </div>
            <div class="col-sm-12">
                <p class="back-link">Desa Gedongboyountung 2023</a></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- <script>
    document.getElementById("showTable2").addEventListener("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // Menambahkan konten tabel kedua ke dalam tabel kedua
                document.getElementById("table2").innerHTML = this.responseText;
                // Menampilkan tabel kedua
                document.getElementById("table2").style.display = "block";
            }
        };
        xhr.open("GET", "/loadTable2", true);
        xhr.send();
    });
</script> -->
@endsection