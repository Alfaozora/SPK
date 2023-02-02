@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('crips.index') }}"> Nilai Kriteria</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Nilai Kriteria</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Edit Nilai Kriteria</h2>
        </div>
    </div>
</div>
<!--/.main-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    {{-- Menampilkan Erorr Validasi--}}
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('crips.update', $crips->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <h5 class="card-header">Nilai Kriteria</h5>
            <div class="form-row">
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="nama">Nama Kriteria</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $crips->nama) }}" readonly>
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $crips->keterangan) }}">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>Nilai</label>
                    <input type="text" name="nilai" class="form-control" value="{{ old('nilai', $crips->nilai) }}">
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