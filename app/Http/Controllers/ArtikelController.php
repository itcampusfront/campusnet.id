<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Fitur;
use App\User;

class ArtikelController extends Controller
{
    /**
     * Menampilkan data fitur
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == role_admin()){
            // Data fitur

            // View
            return view('front/artikel/index', [

            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menampilkan data fitur
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($permalink)
    {
        if(Auth::user()->role == role_admin()){
            // Data fitur

            // View
            return view('front/artikel/detail', [

            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

}
