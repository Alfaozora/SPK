<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\alternatif;
use App\Models\pemeringkatan;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //$penduduks = penduduk::where('status', '1')->count();
        $pemeringkatans = Pemeringkatan::all();
        $jumlahOrang = $request->input('jumlahOrang');

        //mengambil data NKK dari database alternatif kemudian ditampilkan dengan tabel pemeringkatan
        $pemeringkatans = Pemeringkatan::join('alternatifs', 'pemeringkatans.alternatif_id', '=', 'alternatifs.kode')
            ->select('alternatifs.nkk', 'alternatifs.nik', 'alternatifs.alamat', 'pemeringkatans.*')
            ->orderBy('id', 'ASC')
            ->take($jumlahOrang)
            ->get();
        // dd($pemeringkatans);

        return view('home', [
            'pemeringkatans' => $pemeringkatans,
        ]);
    }

    // public function filter(Request $request)
    // {
    //     $jumlahOrang = $request->input('jumlah_orang');
    //     $pemeringkatan = Pemeringkatan::orderBy('peringkat')->take($jumlahOrang)->get();

    //     return view('home', compact('pemeringkatan'));
    //     dd($pemeringkatan);
    // }
}
