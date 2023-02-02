@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('crips.index') }}">Nilai Kriteria</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Tambah Nilai Kriteria</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Tambah Nilai Kriteria</h2>
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
        <form class="needs-validation" method="post" action="{{ route('crips.store') }} " validate>
            @csrf
            <h5 class="card-header">Nilai Kriteria</h5>
            <div class="form-row" style="text-align: center">
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="nama">Nama Kriteria</label>
                    <span class="text-danger">*</span>
                    <select name="nama" class="form-control input-lg" data-dependent="nama">
                        <option disabled selected>--Pilih Kriteria--</option>
                        @foreach ($kriteria as $k)
                        <option value="{{ $k->nama_kriteria }}">{{ $k->nama_kriteria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="keterangan">Keterangan</label>
                    <span class="text-danger">*</span>
                    <input type="text" value="{{ old('keterangan') }}" name="keterangan" id="keterangan" class="form-control input-lg dynamic" data-dependent="keterangan" data-dynamic="keterangan">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="nilai">Nilai</label>
                    <span class="text-danger">*</span>
                    <input type="text" value="{{ old('nilai') }}" name="nilai" id="nilai" class="form-control input-lg dynamic" data-dependent="nilai" data-dynamic="nilai">
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