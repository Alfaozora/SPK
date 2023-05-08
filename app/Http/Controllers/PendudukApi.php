<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penduduks = Penduduk::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Penduduk',
            'data' => $penduduks
        ], 200);
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
        $penduduks = Penduduk::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data Penduduk Berhasil Ditambahkan',
            'data' => $penduduks
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penduduks = Penduduk::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Penduduk',
            'data' => $penduduks
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $penduduks = Penduduk::find($id);
        $penduduks->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data Penduduk Berhasil Diubah',
            'data' => $penduduks
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penduduk::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Penduduk Berhasil Dihapus',
        ], 200);
    }
}
