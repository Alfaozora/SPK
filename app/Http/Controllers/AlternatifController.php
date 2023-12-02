<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use Alert;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->cari;
        $alternatifs = alternatif::where('nama', 'LIKE', "%" . $cari . "%")
            ->orWhere('nik', 'LIKE', "%" . $cari . "%")
            ->orWhere('nkk', 'LIKE', "%" . $cari . "%")
            ->orderBy('id', 'asc')->paginate(20);
        return view('alternatif.tampilalternatif', compact('alternatifs'));
    }

    // public function export()
    // {
    //     return Excel::download(new UsersExport, 'users.xlsx');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alternatif.tambahalternatif');
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
            'nkk' => 'required|unique:alternatifs,nkk,number',
            'nik' => 'required|unique:alternatifs,nik,number',
            'nama' => 'required',
            'alamat' => 'required',
            'nomor' => 'required|unique:alternatifs,nomor,number',
        ]);

        $alternatifs = alternatif::create([
            'kode' => $request->kode,
            'nkk' => $request->nkk,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor' => $request->nomor
        ]);
        if ($alternatifs) {
            Alert::success('Alternatif Berhasil Ditambahkan', 'Selamat');
            return redirect()->route('alternatif.index');
        } else {
            Alert::error('Alternatif Gagal Ditambahkan', 'Maaf');
            return redirect()->route('alternatif.create');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alternatifs = alternatif::find($id);
        return view('alternatif.editalternatif', compact('alternatifs'));
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
            'nkk' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'nomor' => 'required|unique:alternatifs,nomor,number',
        ]);

        $alternatifs = Alternatif::find($id);
        $alternatifs->update([
            'kode' => $request->kode,
            'nkk' => $request->nkk,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor' => $request->nomor
        ]);

        if ($alternatifs) {
            Alert::success('Alternatif Berhasil Diubah', 'Selamat');
            return redirect()->route('alternatif.index');
        } else {
            Alert::error('Alternatif Gagal Diubah', 'Maaf');
            return redirect()->route('alternatif.edit');
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
        $alternatifs = alternatif::find($id);
        $alternatifs->delete();
        return response()->json(['status' => 'Kriteria Berhasil di hapus!']);
    }

    public function hapusSemua()
    {
        Alternatif::truncate();
        if (Alternatif::truncate()) {
            Alert::success('Alternatif Berhasil Dihapus', 'Selamat');
            return redirect()->route('alternatif.index');
        } else {
            Alert::error('Alternatif Gagal Dihapus', 'Maaf');
            return redirect()->route('alternatif.index');
        }
    }
}