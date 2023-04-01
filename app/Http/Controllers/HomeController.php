<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    penduduk
};

class HomeController extends Controller
{
    public function index()
    {
        $penduduks = penduduk::where('status', '1')->count();
        return view('home', compact('penduduks'));
    }
}
