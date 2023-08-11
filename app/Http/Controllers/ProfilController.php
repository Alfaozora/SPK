<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Alert;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::find(auth()->user()->id);
        return view('profile.profil', compact('users'));
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
        //
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
        $users = User::find($id);
        return view('profile.profil', compact('users'));
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
        $users = User::find($id);
        //validasi
        $this->validate($request, [
            'name' => 'required|unique:users,name,' . $users->id,
            'email' => 'required|email',

        ]);
        if ($request->new_password != null) {
            $this->validate($request, [
                'new_password' => 'required|min:8',
                'repeatpassword' => 'required|same:new_password|different:old_password'
            ]);
            if (!Hash::check($request->old_password, $users->password)) {
                Alert::error('Password lama tidak sesuai', 'Error');
                return redirect()->back();
            }
            $users->password = Hash::make($request->new_password);
        }
        $users->name = $request->name;
        $users->email = $request->email;
        $users->save();
        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('home');
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
