<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\nilaiintensitas;
use App\Models\perbandingan_kriteria;

use Illuminate\Http\Request;
use Redirect;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriterias = kriteria::all();
        $nilaiintensitas = nilaiintensitas::all();
        $perbandingan_kriterias = perbandingan_kriteria::all();
        return view('perhitungan.perhitungan', compact('kriterias', 'nilaiintensitas', 'perbandingan_kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nilaiintensitas = nilaiintensitas::all();
        $nilaiintensitas = $request->input('nilai');

        $kriterias = kriteria::all();
        $perbandingan_kriterias = perbandingan_kriteria::all();
        $perbandingan_kriterias = $request->input('nilai');


        //Mendapatkan daftar semua kriteria yang tersedia
        $kriterias = kriteria::pluck('kode_kriteria')->toArray();

        //Menyiapkan matriks perbandingan berpasangan
        $matriksPerbandingan = [];

        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                if ($kriteria1 === $kriteria2) {
                    $nilai = 1;
                } else {
                    $nilai = $perbandingan_kriterias[$kriteria1][$kriteria2];
                }
                $matriksPerbandingan[$kriteria1][$kriteria2] = $nilai;
            }
        }

        //melakukan normalisasi matriks perbandingan
        $matriksNormalisasi = [];
        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                if ($matriksPerbandingan[$kriteria2][$kriteria1] != 0) {
                    $nilaiNormalisasi = 1 / $matriksPerbandingan[$kriteria2][$kriteria1];
                } else {
                    $nilaiNormalisasi = $matriksPerbandingan[$kriteria1][$kriteria2];
                }
                $matriksNormalisasi[$kriteria1][$kriteria2] = number_format($nilaiNormalisasi, 2);
            }
        }


        //Menghitung jumlah bobot setiap kriteria
        $jumlahKolom = [];
        foreach ($kriterias as $kriteria2) {
            $jumlahKolom[$kriteria2] = 0;
            foreach ($kriterias as $kriteria1) {
                $jumlahKolom[$kriteria2] += $matriksNormalisasi[$kriteria1][$kriteria2];
            }
        }

        foreach ($nilaiintensitas as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $perbandingan_kriterias = new perbandingan_kriteria();
                $perbandingan_kriterias->kriteria1 = $key;
                $perbandingan_kriterias->kriteria2 = $key2;
                $perbandingan_kriterias->nilai = $value2;
                //menyimpan dan memperbarui data
                perbandingan_kriteria::updateOrCreate(
                    [
                        'kriteria1' => $key,
                        'kriteria2' => $key2,
                    ],
                    [
                        'nilai' => $value2,
                    ]
                );
            }
        }
        return view('perhitungan.proses', [
            'kriterias' => $kriterias,
            'matriksPerbandingan' => $matriksPerbandingan,
            'jumlahKolom' =>  $jumlahKolom,
            'matriksNormalisasi' => $matriksNormalisasi,
        ]);
    }

    public function proses(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
