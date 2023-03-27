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
                    <div class="panel-heading">
                        <form class="form-inline">
                            <div class="form-group">
                                <a type="button" class="btn btn-danger" href="{{route('crips.create')}}"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                            <select class="form-control" id="kriterias" name="kriterias">
                                <option disabled selected>--Pilih Kriteria--</option>
                                @if(count($kriterias) > 0)
                                @foreach($kriterias as $k)
                                <option value="{{ $k['id_kriteria'] }}">{{$k->nama_kriteria}}</option>
                                @endforeach
                                @endif
                            </select>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="text-center" style="vertical-align:middle;">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Kode</th>
                                    <th rowspan="2">Nama Kriteria</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2">Nilai</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @if(count($crips) > 0)
                                @foreach ($crips as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->id_crips }}</td>
                                    <td>{{ $c->nama}}</td>
                                    <td>{{ $c->keterangan }}</td>
                                    <td>{{ $c->nilai }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('crips.edit', $c->id_crips) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('crips.destroy', $c->id_crips) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm btndelete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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

<!--/ .Sweet Alert Hapus -->
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
                            url: 'crips/' + deleteid,
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#kriterias').on('change', function() {
            var kriteria = $(this).val();
            $.ajax({
                url: "{{ route('crips.index') }}",
                type: "GET",
                data: {
                    'kriterias': kriteria
                },
                success: function(data) {
                    console.log(data);
                    var crips = data.crips;
                    var html = '';
                    if (crips.length > 0) {
                        for (let i = 0; i < crips.length; i++) {
                            html += '<tr>\
                                     <td>' + i + '</td>\
                                     <td>' + crips[i][id_crips] + '</td>\
                                     <td>' + crips[i][nama] + '</td>\
                                     <td>' + crips[i][keterangan] + '</td>\
                                     <td>' + crips[i][nilai] + '</td>\
                                     </tr>';
                        }
                    } else {
                        html += '';
                    }
                    $('#tbody').html(html);
                }
            });
        });
    });
</script>
@endsection