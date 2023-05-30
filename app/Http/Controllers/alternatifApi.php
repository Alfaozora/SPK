<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alternatif;

class alternatifApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatifs = alternatif::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Alternatif',
            'data' => $alternatifs
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
        $alternatifs = alternatif::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data Alternatif Berhasil Ditambahkan',
            'data' => $alternatifs
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
        $alternatifs = alternatif::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Alternatif',
            'data' => $alternatifs
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
        $alternatifs = alternatif::find($id);
        $alternatifs->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data Alternatif Berhasil Diubah',
            'data' => $alternatifs
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
        alternatif::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Alternatif Berhasil Dihapus',
        ], 200);
    }
}
