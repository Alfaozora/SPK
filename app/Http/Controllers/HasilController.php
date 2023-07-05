<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\pemeringkatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilExport;
use Illuminate\Support\Carbon;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        $pemeringkatans = Pemeringkatan::all();
        $jumlahOrang = $request->input('jumlahOrang');
        //mengambil nilai input dari form pemfilteran

        //mengambil data NKK dari database alternatif kemudian ditampilkan dengan tabel pemeringkatan
        $pemeringkatans = Pemeringkatan::join('alternatifs', 'pemeringkatans.alternatif_id', '=', 'alternatifs.kode')
            ->select('alternatifs.nkk', 'alternatifs.nik', 'alternatifs.alamat', 'pemeringkatans.*')
            ->orderBy('peringkat', 'ASC')
            ->take($jumlahOrang)
            ->get();
        // dd($pemeringkatans);

        //menghapus data session
        $request->session()->forget('jumlahOrang');

        //mengambil data pemeringkatan hasil pemfilteran menggunkan session
        $request->session()->put('jumlahOrang', $pemeringkatans);

        return view('hasil.tampilhasil', [
            'pemeringkatans' => $pemeringkatans,
        ]);
    }

    public function cetak(Request $request)
    {
        $pemeringkatans = Pemeringkatan::all();

        //mengambil data pemeringkatan hasil pemfilteran menggunkan session di halaman sebelumnya
        $pemeringkatans = $request->session()->get('jumlahOrang');

        return view('hasil.cetak', [
            'pemeringkatans' => $pemeringkatans
        ]);
    }

    public function excel(Request $request)
    {
        $pemeringkatans = Pemeringkatan::all();

        //mengambil data pemeringkatan hasil pemfilteran menggunkan session di halaman sebelumnya
        $pemeringkatans = $request->session()->get('jumlahOrang');

        return view('hasil.excel', [
            'pemeringkatans' => $pemeringkatans
        ]);
    }

    public function excelDwonload()
    {
        return Excel::download(new HasilExport, 'Laporan-Hasil ' . Carbon::now() . '.xlsx');
    }
}
