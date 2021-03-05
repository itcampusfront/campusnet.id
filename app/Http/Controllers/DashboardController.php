<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kategori;
use App\Kelas;
use App\User;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        // View
        return view('admin/dashboard/index');
    }

    /**
     * Home Page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // Data kategori
        $kategori = Kategori::orderBy('kategori_at','desc')->limit(4)->get();

        // Count kelas berdasarkan kategori
        if(count($kategori)>0){
            foreach($kategori as $key=>$data){
                $count = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('kelas.kategori_kelas','=',$data->id_kategori)->count();
                $kategori[$key]->count_kelas = $count;
            }
        }

        // Data kelas
        $kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->orderBy('kelas_at','desc')->limit(8)->get();

        // View
        return view('front/dashboard/index', [
            'kategori' => $kategori,
            'kelas' => $kelas
        ]);
    }
}
