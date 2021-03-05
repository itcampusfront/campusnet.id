<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kategori;
use App\Kelas;
use App\Konten;
use App\Level;
use App\MemberKelas;
use App\Progress;
use App\Topik;
use App\User;

class PengajarController extends Controller
{
    /**
     * Menampilkan data pengajar
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->role == role_admin() && strpos(url()->current(), '/admin/pengajar')){
            // // Data kelas
            // $kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->get();

            // if(count($kelas)>0){
            //     foreach($kelas as $key=>$data){
            //         $count_topik = Topik::where('id_kelas','=',$data->id_kelas)->count();
            //         $kelas[$key]->topik = $count_topik;
            //     }
            // }

            // // View
            // return view('admin/kelas/index', [
            //     'kelas' => $kelas,
            // ]);
        }
        else{
            // Data pengajar
            $pengajar = User::where('role','=',role_pengajar())->paginate(16);

            // View
            return view('front/pengajar/index', [
                'pengajar' => $pengajar,
            ]);
        }
    }
}
