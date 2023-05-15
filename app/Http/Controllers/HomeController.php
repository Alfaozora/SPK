<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\alternatif;

class HomeController extends Controller
{
    public function index()
    {
        //$penduduks = penduduk::where('status', '1')->count();
        $penduduks = Penduduk::all();
        $alternatifs = Alternatif::count();
        return view('home', compact('penduduks', 'alternatifs'));
    }
}
