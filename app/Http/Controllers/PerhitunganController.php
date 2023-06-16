<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\nilaiintensitas;
use App\Models\perbandingan_kriteria;

use Illuminate\Http\Request;

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

    public function loadTable2()
    {
        $kriterias = kriteria::all();
        $nilaiintensitas = nilaiintensitas::all();
        return view('perhitungan.table2', compact('kriterias', 'nilaiintensitas'));
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
        $nilaiintensitas = $request->input('nilai');
        foreach ($nilaiintensitas as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $perbandingan_kriterias = new perbandingan_kriteria();
                $perbandingan_kriterias->kriteria1 = $key;
                $perbandingan_kriterias->kriteria2 = $key2;
                $perbandingan_kriterias->nilai = $value2;
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
        return redirect()->back();
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
