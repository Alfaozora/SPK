@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="wow fadeInLeft">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Alternatif</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Alternatif</h2>
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
                    <div class="panel-heading">
                        <form class="form-inline">
                            <div class="form-group">
                                <a type="button" class="btn btn-danger" href="{{route('alternatif.create')}}"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                            <div class="form-group">
                                <input id="floatingInputGroup1" name="cari" type="text" class="form-control" placeholder="Cari Nama, NIK, NKK">
                                <button class="input-group-text btn btn-primary">Cari</button>
                            </div>
                            <ul class="pull-right panel-settings panel-button-tab-right">
                                <li class="dropdown">
                                    <a class="pull-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <em class="fa fa-cogs"></em>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <ul class="dropdown-settings">
                                                <li>
                                                    <a href="{{route('riwayat')}}">
                                                        <em class="fa fa-upload"></em> Cadangkan Alternatif
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="{{route('riwayat.tampil')}}">
                                                        <em class="fa fa-bars"></em> Lihat Riwayat
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="text-center" style="vertical-align:middle;">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Tahun</th>
                                    <th rowspan="2">NKK</th>
                                    <th rowspan="2">NIK</th>
                                    <th rowspan="2">Nama Penduduk</th>
                                    <th rowspan="2">Alamat</th>
                                    <th rowspan="2">Nomor Hp</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" style="vertical-align:middle;">
                                @foreach ($alternatifs as $a)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $a->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$a->created_at->year }}</td>
                                    <td>{{$a->nkk}}</td>
                                    <td>{{ $a->nik }}</td>
                                    <td>{{ $a->nama }}</td>
                                    <td>{{ $a->alamat }}</td>
                                    <td>{{ $a->nomor }}</td>
                                    <td>
                                        <a href="{{ route('alternatif.edit', $a->id) }}" class="btn btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('alternatif.destroy', $a->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btndelete"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 my-12">
                        {{ $alternatifs->links() }}
                    </div>
                    <div class="col-md-12 my-6 text-right">
                        <form action="/alternatif/hapus_semua" method="POST" id="formHapusSemua">
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus Semua Data Alternatif</button>
                        </form>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
</script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btndelete').click(function(e) {
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deleteid,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: 'alternatif/' + deleteid,
                            data: data,
                            success: function(response) {
                                swal(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        });

    });
</script>
@endsection