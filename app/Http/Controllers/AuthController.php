<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home()
    {
        return view('home');
    }
    
    public function register()
    {
        return view('account/add');
    }


    public function registered(Request $request)
    {
        $existingAccount = Account::where('username', $request->username)
        ->where('name', $request->name)->exists();;
        if ($existingAccount) {
            return redirect()->back()->withInput()->withErrors(['username' => 'Pengguna sudah terdaftar.']);
        }

        $account = Account::create([
            'username' => $request->username,
            'name' => $request->name,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/account')->with('success', 'Akun berhasil ditambahkan');
    }

    public function login(){
        return view('beranda/login');
    }

    public function ceklogin(Request $request){
        if(
            !Auth::attempt([
                'username' => $request->username,
                'password' => $request->password,
            ])
        ){
            return redirect('/login')->with('error', 'Email atau password salah.');
        } else {
            return redirect ('/home');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
