@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('nilaiIntensitas.index') }}">Nilai Intensitas</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Nilai Intensitas</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Edit Nilai Intensitas</h2>
        </div>
    </div>
</div>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="panel panel-default">
        <div class="panel panel-body">
            <form class="needs-validation" method="POST" action="{{ route('nilaiIntensitas.update', $nilaiintensitas->id_nilai) }} " validate>
                @csrf
                @method('PUT')
                <div class="form-group col-md-6 mb-4">
                    <label for="nilai">Nilai</label>
                    <input id="nilai" value="{{ old('nilai', $nilaiintensitas->jum_nilai) }}" class="form-control" type="text" name="jum_nilai" required="">
                </div>
                <div class="form-group col-md-6 mb-4">
                    <label for="keterangan">Keterangan</label>
                    <input id="keterangan" value="{{ old('keterangan', $nilaiintensitas->keterangan) }}" class="form-control" type="text" name="keterangan" required="">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 mb-3">
                        </br>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12 mb-12">
    <br>
    <p class="back-link">Desa Gedongboyountung 2023</p>
</div>

@endsection