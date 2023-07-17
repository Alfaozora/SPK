<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crips;
use App\Models\Kriteria;
use App\Models\sub_kriteria;
use Alert;
use DB;

class CripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kriterias = kriteria::all();
        $sub_kriterias = sub_kriteria::all();
        return view('crips.tampilcrips', compact('kriterias', 'sub_kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        $sub_kriterias = sub_kriteria::all();
        return view('crips.tambahcrips', compact('kriterias', 'sub_kriterias'));
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
            'nama_sub' => 'required',
            'bobot' => 'required'
        ]);

        $sub_kriterias = sub_kriteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_sub' => $request->nama_sub,
            'bobot' => $request->bobot

        ]);
        if ($sub_kriterias) {
            Alert::success('Kriteria Berhasil Ditambahkan', 'Selamat');
            return redirect()->back();
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
        $kriterias = Kriteria::all();
        $sub_kriterias = sub_kriteria::find($id);
        return view('crips.editcrips', compact('kriterias', 'sub_kriterias'));
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
            'nama_sub' => 'required',
            'bobot' => 'required'
        ]);
        $sub_kriterias = sub_kriteria::find($id);
        $sub_kriterias->update([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_sub' => $request->nama_sub,
            'bobot' => $request->bobot
        ]);
        if ($sub_kriterias) {
            Alert::success('Sub Kriteria Berhasil Ditambahkan', 'Selamat');
            return redirect()->route('crips.index');
        } else {
            Alert::error('Sub Kriteria Gagal Ditambahkan', 'Maaf');
            return redirect()->back();
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
        $sub_kriterias = sub_kriteria::find($id);
        $sub_kriterias->delete();
        return response()->json(['status' => 'Kriteria Berhasil di hapus!']);
    }
}
