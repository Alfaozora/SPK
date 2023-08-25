@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('alternatif.index') }}">Alternatif</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Upload Data Alternatif</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Upload Data Alternatif</h2>
        </div>
    </div>
</div>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="panel-default">
        <div class="panel-heading">Upload File</div>
        <div class="panel-body">
            <div class="form-group">
                <form action="{{ route('uploadFile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="json_file" accept=".json">
                    <br>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-upload"></i> Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection