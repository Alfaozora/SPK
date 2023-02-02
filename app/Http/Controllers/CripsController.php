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
        $crips = Crips::all();
        $kriterias = kriteria::all();
        return view('crips.tampilcrips', compact('crips', 'kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('crips.tambahcrips', compact('kriteria'));
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
            'nama' => 'required',
            'keterangan' => 'required',
            'nilai' => 'required|numeric'
        ]);

        $crips = Crips::create([$request->all()]);
        if ($crips) {
            Alert::success('Nilai Kriteria Berhasil Ditambahkan', 'Selamat');
            return redirect()->route('crips.index');
        } else {
            Alert::error('Nilai Kriteria Berhasil Ditambahkan', 'Maaf');
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
            'nama' => 'required',
            'keterangan' => 'required',
            'nilai' => 'required|numeric'
        ]);

        $crips = Crips::find($id);
        $crips->update([
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

    function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('crips')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        foreach ($data as $row) {
            $output = '<option value="' . $row->$dependent . '" name="nama" selected>' . ucfirst($row->$dependent) . '</option>';
        }
        echo $output;
    }
}
