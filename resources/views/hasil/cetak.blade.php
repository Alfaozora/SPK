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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td style="padding-left: 10px; padding: 5px;"> <img src="{{asset ('gambar/logo.jpg')}}" width="120px"> </td>
                <td class="tengah">
                    <p style="font-family: 'Arial'; font-weight:bold; font-size: 24px; padding: 5px; color: black;">PEMERINTAH KABUPATEN LAMONGAN</p>
                    <p style="font-family: 'Arial'; font-weight:bold; font-size: 24px; padding: 5px; color: black;">KECAMATAN TURI</p>
                    <p style="font-family: 'Arial'; font-weight:bold; font-size: 30px; padding: 5px; color: black;">DESA GEDONGBOYOUNTUNG</p>
                    <p style="font-family: 'Arial'; padding: 5px; color: black;">Alamat: Jl. Poros Desa, Mlanggeng, Gedongboyountung, Kec. Turi, Kode Pos. 62252</p>
                </td>
            </tr>
        </table>
        <table class="table table-bordered" id="tableContainer">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">Daftar Warga Yang Mendapatkan Bantuan</th>
                </tr>
                <tr>
                    <th rowspan="2" class="text-center">No</th>
                    <th rowspan="2" class="text-center">NKK</th>
                    <th rowspan="2" class="text-center">NIK</th>
                    <th rowspan="2" class="text-center">Nama</th>
                    <th rowspan="2" class="text-center">Alamat</th>
                </tr>
            </thead>
            <tbody class="text-center" style="vertical-align:middle;">
                <br>
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
            <button class="btn btn-danger mb-2" id="btnCetak">Download</button>
        </div>
    </div>
    <script src="{{asset ('js/bootstrap.min.js')}}"></script>
</body>

</html>
<script>
    document.getElementById('btnCetak').addEventListener('click', function() {
        window.print();
    });
</script>