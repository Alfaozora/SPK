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
                                    <td>
                                        {{$matriksNormalisasi[$kriteria1][$kriteria2]}}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                <tr>
                                    <th class="text-center">
                                        Jumlah
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
            </div>
            <div class="col-sm-12">
                <p class="back-link">Desa Gedongboyountung 2023</a></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>