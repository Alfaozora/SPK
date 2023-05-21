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
        return view('kriteria.tampilkriteria', [
            'kriteria' => Kriteria::all()
        ]);
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
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',

        ]);

        $kriteria = Kriteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,

        ]);
        if ($kriteria) {
            Alert::success('Kriteria Berhasil Ditambahkan', 'Selamat');
            return redirect()->route('kriteria.create');
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
        $kriteria = Kriteria::find($id);
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
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
        ]);

        $kriteria = Kriteria::find($id);
        $kriteria->update([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
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
        $kriteria = Kriteria::find($id);
        $kriteria->delete();
        return response()->json(['status' => 'Kriteria Berhasil di hapus!']);
    }
}
