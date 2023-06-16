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
                            @php $no=1; foreach($r as $key => $value): @endphp
                            @php for ($i=1; $i <= $value; $i++): @endphp @php $rows=$kriteriaObj->bacaSatu($key);
                                while ($row = $rows->fetch_assoc()): @endphp
                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            @php $rows = $kriteriaObj->bacaSatu($key);
                                            while($row = $rows->fetch_assoc()): @endphp
                                            <input type="text" class="form-control" value="{{ $row['nama_kriteria'] }}" readonly />
                                            <input type="hidden" name="{{ $key }}{{ $no }}" value="{{ $row['kode_kriteria'] }}" />
                                            @php endwhile; @endphp
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="nl{{ $no }}">
                                                <option value="">-- Pilih Nilai --</option>
                                                @php $rows = $nilaiObj->readAll();
                                                while($row = $rows->fetch_assoc()): @endphp
                                                <option value="{{ $row['jum_nilai'] }}">{{ $row['jum_nilai'] }} - {{ $row['keterangan'] }}</option>
                                                @php endwhile; @endphp
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            @php $pcs = explode("C", $key); $nid = "C".($pcs[1] + $i); @endphp
                                            @php $rows = $kriteriaObj->bacaSatu($nid);
                                            while($row = $rows->fetch_assoc()): @endphp
                                            <input type="text" class="form-control" value="{{ $row['nama_kriteria'] }}" readonly />
                                            <input type="hidden" name="{{ $nid }}{{ $no }}" value="{{ $row['kode_kriteria'] }}" />
                                            @php endwhile; @endphp
                                        </div>
                                    </div>
                                </div>
                                @php endwhile; $no++; @endphp
                                @php endfor; @endphp
                                @endforeach;
                        </form>
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