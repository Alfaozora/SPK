<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\alternatif;
use App\Models\pemeringkatan;

class HomeController extends Controller
{
    public function index()
    {
        //$penduduks = penduduk::where('status', '1')->count();
        $penduduks = Penduduk::all();
        $alternatifs = Alternatif::all();
        $pemeringkatans = Pemeringkatan::all();

        //menampilkan data NKK dari database alternatif kemudian ditampilkan dengan tabel pemeringkatan
        foreach ($pemeringkatans as $kode) {
            $alternatifs = Alternatif::where('kode', $kode)->first();
            $nkk = $alternatifs ? $alternatifs->nkk : null;
        }
        // dd($pemeringkatans);

        return view('home', [
            'penduduks' => $penduduks,
            'alternatifs' => $alternatifs,
            'pemeringkatans' => $pemeringkatans,
            'nkk' => $nkk,
        ]);
    }
}
