<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Alert;
use Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\role;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = role::all();
        return view('login.datauser', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = role::all();
        return view('login.register', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('password', $request->password);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role tidak boleh kosong'
        ]);
        $user = User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if ($user) {
            Alert::success('Berhasil', 'Berhasil Mendaftar');
            return redirect()->route('register.index');
        } else {
            Alert::error('Gagal', 'Gagal Mendaftar');
            return redirect()->route('register.create');
        }
        if ($user) {
            $email_pengirim = 'spkbansos.gmail.com';
            $nama_pengirim = 'Admin';
            $email_penerima = $_POST['email'];
            $subjek = 'Registrasi Pengguna Baru';
            $pesan = 'Selamat Akun Anda Berhasil Ditambahkan, Username Anda' . $_POST['name'] . 'Password Anda' . $_POST['password'];

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = $email_pengirim;
            $mail->Password = 'bxzabhniwfycgfaa';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPDebug = 2;

            $mail->setFrom($email_pengirim, $nama_pengirim);
            $mail->addAddress($email_penerima);
            $mail->isHTML(true);
            $mail->Subject = $subjek;
            $mail->Body = $pesan;

            $send = $mail->send();

            if ($send) {
                echo 'Pesan berhasil dikirim';
            } else {
                echo 'Pesan gagal dikirim';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }
        // event(new Registered($user));
        // Auth::login($user);
        // return redirect('/email/verify');
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
        $roles = role::all();
        return view('login.edituser', compact('users', 'roles'));
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
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',

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
        $users->role = $request->role;
        $users->save();

        if ($users) {
            Alert::success('Data User Berhasil Diubah', 'Selamat');
            return redirect()->route('register.index');
        } else {
            Alert::error('Data User Gagal Diubah', 'Maaf');
            return redirect()->route('register.edit');
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
        $users = User::find($id);
        $users->delete();
        return response()->json(['status' => 'Data Berhasil di hapus!']);
    }
}
