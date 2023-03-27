<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crips;
use App\Models\Kriteria;
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
        $kriterias = Kriteria::all();
        $query = Crips::query();
        if ($request->ajax()) {
            $crips = $query->where(['id_kriteria' => $request->kriteria])->get();
            return response()->json(['crips' => $crips]);
        }
        $crips = $query->get();
        return view('crips.tampilcrips', compact('kriterias', 'crips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('crips.tambahcrips', compact('kriterias'));
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
            'id_crips' => 'required|numeric',
            'id_kriteria' => 'required|numeric',
            'nama' => 'required',
            'keterangan' => 'required',
            'nilai' =>  'required|numeric'
        ]);

        $crips = Crips::create([
            'id_crips' => $request->id_crips,
            'id_kriteria' => $request->id_kriteria,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai
        ]);
        if ($crips) {
            Alert::success('Data Crips Berhasil Ditambahkan', 'Selamat');
            return redirect()->route('crips.index');
        } else {
            Alert::error('Data Crips Gagal Ditambahkan', 'Maaf');
            return redirect()->route('crips.create');
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
        $crips = crips::find($id);
        $kriteria = Kriteria::all();
        return view('crips.editcrips', compact('crips', 'kriteria'));
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
            'id_crips' => 'required' | 'numeric',
            'nama' => 'required',
            'keterangan' => 'required',
            'nilai' => 'required|numeric'
        ]);

        $crips = Crips::find($id);
        $crips->update([
            'id_crips' => $request->id_crips,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);
        if ($crips) {
            Alert::success('Nilai Kriteria Berhasil Diubah', 'Selamat');
            return redirect()->route('crips.index');
        } else {
            Alert::error('Nilai Kriteria Gagal Diubah', 'Maaf');
            return redirect()->route('crips.edit');
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
        $crips = Crips::find($id);
        $crips->delete();
        return response()->json(['status' => 'Kriteria Berhasil di hapus!']);
    }
}
