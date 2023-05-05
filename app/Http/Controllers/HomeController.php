<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;

class HomeController extends Controller
{
    public function index()
    {
        //$penduduks = penduduk::where('status', '1')->count();
        $penduduks = Penduduk::all();
        return view('home', compact('penduduks'));
    }
}
