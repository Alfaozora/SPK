@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('kriteria.index') }}">Kriteria</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Tambah Kriteria</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Tambah Kriteria</h2>
        </div>
    </div>
</div>
<!--/.main-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        {{-- Menampilkan erorr validasi--}}
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form class="needs-validation" method="post" action="{{ route('kriteria.store') }} " validate>
            @csrf
            <h5 class="card-header">Kriteria</h5>
            <div class="form-row" style="text-align: center">
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="kode">Kode</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="kode" value="{{ old('kode') }}" id="kode" class="form-control input-lg dynamic" data-dependent="kode" data-dynamic="kode">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <span class="text-danger">*</span>
                    <input type="text" value="{{ old('nama_kriteria') }}" name="nama_kriteria" id="nama_kriteria" class="form-control input-lg dynamic" data-dependent="nama_kriteria" data-dynamic="nama_kriteria">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="atribut">Atribut</label>
                    <span class="text-danger">*</span>
                    <select name="atribut" value="{{ old('atribut') }}" id="atribut" class="form-control input-lg" data-dependent="atribut">
                        <option selected="selected"></option>
                        <option>Benefit</option>
                        <option>Cost</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="bobot">Bobot</label>
                    <span class="text-danger">*</span>
                    <input name="bobot" value="{{ old('bobot') }}" id="bobot" class="form-control input-lg dynamic" data-dependent="bobot" data-dynamic="bobot">
                </div>
                <br>
                <br>
                <br>
            </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4 mb-3">
            </br>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
        </div>
    </div>
    </form>
</div>
<div class="col-sm-12">
    <br>
    <p class="back-link">Desa Gedongboyountung 2023</p>
</div>
@endsection