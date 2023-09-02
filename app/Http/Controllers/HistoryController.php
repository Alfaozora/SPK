<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\riwayat_alternatif;
use Illuminate\Support\Carbon;

class HistoryController extends Controller
{
    public function riwayat()
    {
        $alternatifs = alternatif::all();

        foreach ($alternatifs as $data) {
            $riwayat_alternatif = new riwayat_alternatif;
            $riwayat_alternatif->kode = $data->kode;
            $riwayat_alternatif->nkk = $data->nkk;
            $riwayat_alternatif->nik = $data->nik;
            $riwayat_alternatif->nama = $data->nama;
            $riwayat_alternatif->alamat = $data->alamat;
            $riwayat_alternatif->nomor = $data->nomor;
            $riwayat_alternatif->save();
        }
        return redirect()->route('riwayat.tampil')->with('success', 'Data alternatif berhasil dicadangkan.');
    }

    public function riwayatAlternatif(Request $request)
    {
        $tahun = $request->input('tahun');
        //mengambil data tahun list dari controller
        $tahunList = $this->generateYearList();
        $riwayat_alternatifs = riwayat_alternatif::whereYear('created_at', '=', $tahun)->get();
        return view('riwayat.tampilriwayat', [
            'riwayat_alternatifs' => $riwayat_alternatifs,
            'tahunList' => $tahunList,
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
}
