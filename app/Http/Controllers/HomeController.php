<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\alternatif;
use App\Models\pemeringkatan;
use App\Models\Kriteria;

class HomeController extends Controller
{
    public function index()
    {
        $alternatifs = alternatif::all()->count();
        $kriterias = Kriteria::all()->count();
        $pemeringkatans = Pemeringkatan::all();
        return view('home', [
            'pemeringkatans' => $pemeringkatans,
            'alternatifs' => $alternatifs,
            'kriterias' => $kriterias
        ]);
    }
}
