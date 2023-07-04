<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\pemeringkatan;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        //$penduduks = penduduk::where('status', '1')->count();
        $pemeringkatans = Pemeringkatan::all();
        $jumlahOrang = $request->input('jumlahOrang');

        //mengambil data NKK dari database alternatif kemudian ditampilkan dengan tabel pemeringkatan
        $pemeringkatans = Pemeringkatan::join('alternatifs', 'pemeringkatans.alternatif_id', '=', 'alternatifs.kode')
            ->select('alternatifs.nkk', 'alternatifs.nik', 'alternatifs.alamat', 'pemeringkatans.*')
            ->orderBy('peringkat', 'ASC')
            ->take($jumlahOrang)
            ->get();
        // dd($pemeringkatans);

        return view('hasil.tampilhasil', [
            'pemeringkatans' => $pemeringkatans,
        ]);
    }

    public function cetak(Request $request)
    {
        $pemeringkatans = Pemeringkatan::all();
        $jumlahOrang = $request->input('jumlahOrang');

        //mengambil data NKK dari database alternatif kemudian ditampilkan dengan tabel pemeringkatan
        $pemeringkatans = Pemeringkatan::join('alternatifs', 'pemeringkatans.alternatif_id', '=', 'alternatifs.kode')
            ->select('alternatifs.nkk', 'alternatifs.nik', 'alternatifs.alamat', 'pemeringkatans.*')
            ->orderBy('peringkat', 'ASC')
            ->take($jumlahOrang)
            ->get();
        $pdf = Pdf::loadView('hasil.cetak', compact('pemeringkatans'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Penerima Bantuan.pdf');
    }
}
