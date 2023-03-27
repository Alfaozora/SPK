@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('kriteria.index') }}"> Kriteria</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Kriteria</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Edit Kriteria</h2>
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
    <form method="POST" action="{{ route('kriteria.update', $kriteria->id_kriteria) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <h5 class="card-header">Kriteria</h5>
            <div class="form-row">
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>Kode</label>
                    <input type="text" name="id_kriteria" class="form-control" placeholder="" value="{{ old('id_kriteria', $kriteria->id_kriteria) }}">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" class="form-control" placeholder="" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>Atribut</label>
                    <select name="atribut" class="form-control">
                        <option value="{{ old('atribut', $kriteria->atribut) }}" selected>
                            {{ old('atribut', $kriteria->atribut) }}
                        </option>
                        <option>------------------------------------------------------</option>
                        <option value="Benefit">Benefit</option>
                        <option value="Cost">Cost</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label>Bobot</label>
                    <input type="text" name="bobot" class="form-control" placeholder="" value="{{ old('bobot', $kriteria->bobot) }}">
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