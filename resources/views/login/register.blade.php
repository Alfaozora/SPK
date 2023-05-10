@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('register.index') }}">Menu User</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Register
            </li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Register</h2>
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
        <form class="needs-validation" method="post" action="{{ route('register.store') }} " validate>
            @csrf
            <h5 class="card-header">Nilai Kriteria</h5>
            <div class="form-row" style="text-align: center">
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="name">Username</label>
                    <span class="text-danger">*</span>
                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control input-lg">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="id_kriteria">Email</label>
                    <span class="text-danger">*</span>
                    <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control input-lg">
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="nama">Password</label>
                    <span class="text-danger">*</span>
                    <input type="password" value="{{ old('password') }}" name="password" id="email" class="form-control" required data-eye>
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                    <label for="role">Role</label>
                    <span class="text-danger">*</span>
                    <select name="role" id="id_kriteria" class="form-control input-lg">
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $r)
                        <option value="{{ $r->id}}">{{ $r->id }}-{{ $r->role }} </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <br>
                <br>
            </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4 mb-3">
            </br>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Daftar</button>
        </div>
    </div>
    </form>
</div>
<div class="col-lg-12">
    <br>
    <p class="back-link">Desa Gedongboyountung 2023</p>
</div>
<script src="{{asset ('js/custom.js')}}"></script>
<script src="{{asset ('js/my-login.js')}}"></script>
@endsection