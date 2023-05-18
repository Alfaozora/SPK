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
                <li class="active">Kriteria</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Kriteria</h2>
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
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-danger" href="{{route('kriteria.create')}}"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-info" href=""><i class="fa fa-print"></i> Cetak</a>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="text-center" style="vertical-align:middle;">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Kode Kriteria</th>
                                    <th rowspan="2">Nama Kriteria</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" style="vertical-align:middle;">
                                @foreach ($kriteria as $k)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $k->id_kriteria}}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $k->kode_kriteria }}</td>
                                    <td class="text-left">{{ $k->nama_kriteria }}</td>
                                    <td>
                                        <a href="{{ route('kriteria.edit', $k->id_kriteria) }}" class="btn btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('kriteria.destroy', $k->id_kriteria) }}" method="POST">
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
                            url: 'kriteria/' + deleteid,
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