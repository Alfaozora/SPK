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
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Perhitungan Fuzzy AHP</h2>
            </div>
        </div>
    </div>
</div>
<div class="wow fadeIn">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-md-12">
                <!-- Matriks Normalisasi Perbandingan Berpasangan -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="form-group">
                            <p>Matriks Perbandingan Berpasangan</p>
                        </div>
                    </div>
                    <div class="table-responsive" id="tableContainer">
                        <table class="table table-bordered table-striped table-hover" id="table2">
                            <thead class="text-center" style="vertical-align:middle;">
                                <tr>
                                    <th>
                                        Kriteria
                                    </th>
                                    @foreach($kriterias as $kriteria2)
                                    <th class="text-center" style="vertical-align:middle;">{{$kriteria2}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="text-center" style="vertical-align:middle;">
                                @foreach($kriterias as $kriteria1)
                                <tr>
                                    <td class="text-center" style="vertical-align:middle;">{{$kriteria1}}</td>
                                    @foreach($kriterias as $kriteria2)
                                    @if($kriteria1 == $kriteria2)
                                    <td class="bg-info">
                                        {{$matriksNormalisasi[$kriteria1][$kriteria2]}}
                                    </td>
                                    @else
                                    <td>
                                        {{$matriksNormalisasi[$kriteria1][$kriteria2]}}
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                @endforeach
                                <tr>
                                    <th class="text-center">
                                        Total
                                    </th>
                                    @foreach($kriterias as $kriteria2 )
                                    <th class="text-center">
                                        {{$jumlahKolom[$kriteria2]}}
                                    </th>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Matriks Nilai Kriteria -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="form-group">
                            <p>Matriks Nilai Kriteria</p>
                        </div>
                    </div>
                    <div class="table-responsive" id="tableContainer">
                        <table class="table table-bordered table-striped table-hover" id="table2">
                            <thead class="text-center" style="vertical-align:middle;">
                                <tr>
                                    <th>
                                        Kriteria
                                    </th>
                                    @foreach($kriterias as $kriteria2)
                                    <th class="text-center" style="vertical-align:middle;">{{$kriteria2}}</th>
                                    @endforeach
                                    <th>
                                        Jumlah
                                    </th>
                                    <th>
                                        Prioritas Vektor
                                    </th>
                                    <th>
                                        Eigen Value
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center" style="vertical-align:middle;">
                                @foreach($kriterias as $kriteria1)
                                <tr>
                                    <td class="text-center" style="vertical-align:middle;">{{$kriteria1}}</td>
                                    @foreach($kriterias as $kriteria2)
                                    <td>
                                        {{$matriksNilaiKriteria[$kriteria1][$kriteria2]}}
                                    </td>
                                    @endforeach
                                    <td>
                                        {{$jumlahBaris[$kriteria1]}}
                                    </td>
                                    <td>
                                        {{$bobotPrioritas[$kriteria1]}}
                                    </td>
                                    <td>
                                        {{$eigenValue[$kriteria1]}}
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th class="text-center">
                                        Total
                                    </th>
                                    <th colspan="8"></th>
                                    <th class="text-center">{{ $totalEigenValue[$kriteria1]}}</th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        Consistancy Index
                                    </th>
                                    <th colspan="8"></th>
                                    <th class="text-center">{{ $ci[$kriteria1]}}</th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        Random Index
                                    </th>
                                    <th colspan="8"></th>
                                    <th class="text-center">{{$nilaiRI}}</th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        Consistancy Ratio
                                    </th>
                                    <th colspan="8"></th>
                                    <th class="text-center">
                                        {{$cr[$kriteria1]}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Kotak Biru Infone Masse -->
                <div class="alert alert-info" role="alert">
                    @if($cr[$kriteria1] < 0.1) <p>Nilai Consistancy Ratio (CR) yang diperoleh adalah <strong>{{$cr[$kriteria1]}}</strong> . Nilai CR yang diperoleh <strong> ≤ 0,1 </strong> maka dapat disimpulkan bahwa matriks perbandingan berpasangan yang telah dibuat <strong> Sudah Dapat Diterima.</strong>
                        </p>
                        @else
                        <p>Nilai Consistancy Ratio (CR) yang diperoleh adalah <strong>{{$cr[$kriteria1]}}</strong>. Nilai CR yang diperoleh <strong> > 0,1 </strong> maka dapat disimpulkan bahwa matriks perbandingan berpasangan yang telah dibuat <strong> Tidak Dapat Diterima.</strong></p>
                        @endif
                </div>
                <!-- Nilai  TFN -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="form-group">
                            <p>Konversi Nilai Perbandingan Antar Kriteria Ke Matriks Berpasangan Fuzzy</p>
                        </div>
                    </div>
                    <div class="table-responsive" id="tableContainer">
                        <table class="table table-bordered table-striped table-hover" id="table2">
                            <thead class="text-center" style="vertical-align:middle;">
                                <tr>
                                    <th rowspan="2">
                                        Kriteria
                                    </th>
                                    @foreach($kriterias as $kriteria2)
                                    <th class="text-center" style="vertical-align:middle;" colspan="3">{{$kriteria2}}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach($kriterias as $kriteria2)
                                    <th class="bg-primary"><i>l</i></th>
                                    <th class="bg-primary"><i>m</i></th>
                                    <th class="bg-primary"><i>u</i></th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="text-center" style="vertical-align:middle;">
                                @foreach($kriterias as $kriteria1)
                                <tr>
                                    <td class="text-center" style="vertical-align:middle;">{{$kriteria1}}</td>
                                    @foreach($kriterias as $kriteria2)
                                    @if($kriteria1 == $kriteria2)
                                    <td class="bg-warning">
                                        @if(isset($matriksTFN[$kriteria1][$kriteria2]))
                                        {{ $matriksTFN[$kriteria1][$kriteria2]['l'] ?? '' }}
                                        @endif
                                    </td>
                                    <td class="bg-warning">
                                        @if(isset($matriksTFN[$kriteria1][$kriteria2]))
                                        {{ $matriksTFN[$kriteria1][$kriteria2]['m'] ?? '' }}
                                        @endif
                                    </td>
                                    <td class="bg-warning">
                                        @if(isset($matriksTFN[$kriteria1][$kriteria2]))
                                        {{ $matriksTFN[$kriteria1][$kriteria2]['u'] ?? '' }}
                                        @endif
                                    </td>
                                    @else
                                    <td>
                                        @if(isset($matriksTFN[$kriteria1][$kriteria2]))
                                        {{ $matriksTFN[$kriteria1][$kriteria2]['l'] ?? '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($matriksTFN[$kriteria1][$kriteria2]))
                                        {{ $matriksTFN[$kriteria1][$kriteria2]['m'] ?? '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($matriksTFN[$kriteria1][$kriteria2]))
                                        {{ $matriksTFN[$kriteria1][$kriteria2]['u'] ?? '' }}
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Fuzzy Tringular Number -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="form-group">
                            <p>Fuzzy Tringular Number</p>
                        </div>
                    </div>
                    <div class="table-responsive" id="tableContainer">
                        <table class="table table-bordered table-striped table-hover" id="table2">
                            <thead class="text-center" style="vertical-align:middle;">
                                <tr>
                                    <th rowspan="2">
                                        Kriteria
                                    </th>
                                </tr>
                                <tr>
                                    <th class="bg-primary"><i>l</i></th>
                                    <th class="bg-primary"><i>m</i></th>
                                    <th class="bg-primary"><i>u</i></th>
                                </tr>
                            </thead>
                            <tbody class="text-center" style="vertical-align:middle;">
                                @foreach($jumlahLMU as $kriteria1 => $jumlah)
                                <tr>
                                    <td class="text-center" style="vertical-align:middle;">{{$kriteria1}}</td>
                                    <td>{{$jumlah['l']}}</td>
                                    <td>{{$jumlah['m']}}</td>
                                    <td>{{$jumlah['u']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th class="text-center" style="vertical-align:middle;">Total</th>
                                    <th class="text-center">{{$totalLMU['l']}}</th>
                                    <th class="text-center">{{$totalLMU['m']}}</th>
                                    <th class="text-center">{{$totalLMU['u']}}</th>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>