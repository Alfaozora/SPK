<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use Alert;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = kriteria::all();
        return view('kriteria.tampilkriteria', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.tambahkriteria');
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
            'kode' => 'required',
            'nama_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' =>  'required|numeric'
        ]);

        $kriteria = kriteria::create([
            'kode' => $request->kode,
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'bobot' => $request->bobot
        ]);
        if ($kriteria) {
            Alert::success('Kriteria Berhasil Ditambahkan', 'Selamat');
            return redirect()->route('kriteria.index');
        } else {
            Alert::error('Kriteria Gagal Ditambahkan', 'Maaf');
            return redirect()->route('kriteria.create');
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
        $kriteria = kriteria::find($id);
        return view('kriteria.editkriteria', compact('kriteria'));
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
            'kode' => 'required',
            'nama_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' =>  'required|numeric'
        ]);

        $kriteria = kriteria::find($id);
        $kriteria->update([
            'kode' => $request->kode,
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'bobot' => $request->bobot
        ]);
        if ($kriteria) {
            Alert::success('Kriteria Berhasil Diubah', 'Selamat');
            return redirect()->route('kriteria.index');
        } else {
            Alert::error('Kriteria Gagal Diubah', 'Maaf');
            return redirect()->route('kriteria.edit');
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
        $kriteria = kriteria::find($id);
        $kriteria->delete();
        return response()->json(['status' => 'Kriteria Berhasil di hapus!']);
    }
}
