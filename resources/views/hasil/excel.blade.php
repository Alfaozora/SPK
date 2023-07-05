<html>

<head>
    <title id="title"> Cetak Hasil </title>
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: white;
        }

        .rangkasurat {
            width: 980px;
            margin: 0 auto;
            background-color: #fff;
            height: 500px;
        }

        table {
            border-bottom: 5px solid #000;
            padding: 2px;
            color: black;
        }

        .tengah {
            text-align: center;
            line-height: 7px;
            padding-right: 110px;
        }

        @media print {
            #btnCetak {
                display: none;
            }
        }
    </style>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <br>

    <div class="rangkasurat" id="konten">
        <table class="table table-bordered" id="tableContainer">
            <thead class="text-center" style="vertical-align:middle;">
                <tr>
                    <th colspan="5" class="text-center">Daftar Warga Yang Mendapatkan Bantuan</th>
                </tr>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">NKK</th>
                    <th rowspan="2">NIK</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Alamat</th>
                </tr>
            </thead>
            <tbody class="text-center" style="vertical-align:middle;">
                @foreach($pemeringkatans as $pemeringkatan => $data)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $data->nkk }}</td>
                    <td>{{ $data->nik }}</td>
                    <td class="text-left">{{ $data->nama }}</td>
                    <td class="text-left">{{ $data->alamat }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="editor"></div>
        <div>
            <a class="btn btn-success mb-2" id="btnCetak" href="{{route('hasil.excelDwonload')}}">Download</a>
        </div>
    </div>
    <script src="{{asset ('js/bootstrap.min.js')}}"></script>
</body>

</html>