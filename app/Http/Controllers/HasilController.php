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
        $tahun = $request->input('tahun');
        $pemeringkatans = Pemeringkatan::all();
        //memanggil function cari
        $jumlahOrang = $request->input('jumlahOrang');
        //mengambil nilai input dari form pemfilteran

        //mengambil data NKK dari database alternatif kemudian ditampilkan dengan tabel pemeringkatan
        $pemeringkatans = Pemeringkatan::join('alternatifs', 'pemeringkatans.alternatif_id', '=', 'alternatifs.kode')
            ->select('alternatifs.nkk', 'alternatifs.nik', 'alternatifs.alamat', 'alternatifs.nomor', 'alternatifs.created_at', 'pemeringkatans.*')
            ->orderBy('bobot', 'DESC')
            ->take($jumlahOrang)
            ->whereYear('alternatifs.created_at', 'like', '%' . $tahun . '%')
            ->get();
        // dd($pemeringkatans);

        //menghapus data session
        $request->session()->forget('jumlahOrang');

        // //mengambil data pemeringkatan hasil pemfilteran menggunkan session
        $request->session()->put('jumlahOrang', $pemeringkatans);

        //mengambil data tahun list dari controller
        $tahunList = $this->generateYearList();

        return view('hasil.tampilhasil', [
            'pemeringkatans' => $pemeringkatans,
            'tahunList' => $tahunList
        ]);
    }

    private function generateYearList()
    {
        $currentYear = Carbon::now()->year;
        $startYear = 2021; //tahun awal
        $tahunList = [];

        for ($year = $currentYear; $year >= $startYear; $year--) {
            $tahunList[$year] = $year;
        }

        return $tahunList;
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
}
