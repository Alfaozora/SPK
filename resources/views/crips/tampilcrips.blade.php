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
                <li class="active">Nilai Kriteria</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Nilai Kriteria</h2>
            </div>
        </div>
    </div>
    <!--/.main-->
</div>
<div class="wow fadeIn">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="needs-validation" method="post" action="{{ route('crips.store') }} " validate>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label>Kriteria Pertama</label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label>Pernilaian</label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label>Kriteria Kedua</label>
                                    </div>
                                </div>
                            </div>
                            @foreach ($kriterias as $k)
                            @for ($i=1; $i<=$k; $i++) @endfor @endforeach </form>
                    </div>
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

<!--/ .Sweet Alert Hapus -->
@endsection