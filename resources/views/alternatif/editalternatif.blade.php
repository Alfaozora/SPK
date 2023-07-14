@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('alternatif.index') }}"> Alternatif</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Alternatif</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Edit alternatif</h2>
        </div>
    </div>
</div>
<!--/.main-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
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
    <form method="POST" action="{{ route('alternatif.update', $alternatifs->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <h5 class="card-header">Alternatif</h5>
            <div class="form-row text-center">
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>Kode</label>
                    <input type="text" name="kode" class="form-control" placeholder="" value="{{ old('kode', $alternatifs->kode) }}">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>NKK</label>
                    <input type="text" name="nkk" class="form-control" placeholder="" value="{{ old('nkk', $alternatifs->nkk) }}">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" placeholder="" value="{{ old('nik', $alternatifs->nik) }}">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>Nama Penduduk</label>
                    <input type="text" name="nama" class="form-control" placeholder="" value="{{ old('nama', $alternatifs->nama) }}">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <br>
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="" value="{{ old('alamat', $alternatifs->alamat) }}">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <br>
                    <label>Nomor Hp</label>
                    <input type="text" name="nomor" class="form-control" placeholder="" value="{{ old('nomor', $alternatifs->nomor) }}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 mb-3">
                </br>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection