<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nilaiintensitas;
use Alert;

class IntensitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilaiintensitas = nilaiintensitas::all();
        return view('nilai_ins.nilai_ins', compact('nilaiintensitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nilaiintensitas = nilaiintensitas::all();
        return view('nilai_ins.tambahnilai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'jum_nilai' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $nilaiintensitas = nilaiintensitas::create([
            'jum_nilai' => $request->jum_nilai,
            'keterangan' => $request->keterangan
        ]);
        if ($nilaiintensitas) {
            Alert::success('Data Nilai Intensitas Berhasil Ditambahkan', 'Selamat');
            return redirect()->route('nilaiIntensitas.create');
        } else {
            Alert::error('Data Nilai Intensitas Gagal Ditambahkan', 'Gagal');
            return redirect()->route('nilaiIntensitas.create');
        }
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
        $nilaiintensitas = nilaiintensitas::find($id);
        return view('nilai_ins.editnilai', compact('nilaiintensitas'));
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
        $this->validate($request, [
            'jum_nilai' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $nilaiintensitas = nilaiintensitas::find($id);
        $nilaiintensitas->update([
            'jum_nilai' => $request->jum_nilai,
            'keterangan' => $request->keterangan
        ]);
        if ($nilaiintensitas) {
            Alert::success('Data Nilai Intensitas Berhasil Diubah', 'Selamat');
            return redirect()->route('nilaiIntensitas.index');
        } else {
            Alert::error('Data Nilai Intensitas Gagal Diubah', 'Gagal');
            return redirect()->route('nilaiIntensitas.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilaiintensitas = nilaiintensitas::find($id);
        $nilaiintensitas->delete();
        return response()->json(['status' => 'Nilai Intensitas Berhasil di hapus!']);
    }
}
