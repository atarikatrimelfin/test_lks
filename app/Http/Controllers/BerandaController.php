<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function landing(){
        return view('beranda.landing');
    }

    public function account(){
        return view('beranda.account');
    }

    public function post(){
        return view('beranda.post');
    }
}
