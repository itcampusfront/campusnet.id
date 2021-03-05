<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\PenilaianPengajar;
use App\Kelas;
use App\Topik;
use App\Konten;
use App\User;

class PenilaianPengajarController extends Controller
{
    /**
     * Menampilkan form penilaian pengajar
     *
     * string $permalink
     * @return \Illuminate\Http\Response
     */
    public function form($permalink)
    {
        if(Auth::user()->role == role_pelajar()){
            // Data kelas
            $kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('slug_kelas','=',$permalink)->first();

            if(!$kelas){
                abort(404);
            }

            // Mengecek apakah sudah terdaftar atau belum
            if(check_member_kelas(Auth::user()->id_user, $kelas->id_kelas) <= 0){
                // Redirect
                return redirect('/kelas/'.$kelas->slug_kelas);
            }

            // Mengecek apakah task sudah dikerjakan atau belum
            if(check_penilaian_kelas(Auth::user()->id_user, $kelas->id_kelas) <= 0 && check_penilaian_pengajar(Auth::user()->id_user, $kelas->id_kelas) <= 0){
                // Redirect
                return redirect('/kelas/'.$kelas->slug_kelas.'/aktivitas/penilaian/kelas');
            }

            // Data topik
            $topik = Topik::where('id_kelas','=',$kelas->id_kelas)->orderBy('topik_order','asc')->get();

            // Data konten pada topik
            if(count($topik)>0){
                foreach($topik as $key=>$data){
                    $data_konten = Konten::where('id_topik','=',$data->id_topik)->orderBy('konten_order','asc')->get();
                    $topik[$key]->konten = count($data_konten) > 0 ? $data_konten : [];

                    if(count($data_konten) > 0){
                        foreach($data_konten as $data2){
                            $data2->konten = json_decode($data2->konten, true);
                        }
                    }
                }
            }

            // Data penilaian
            $penilaian = PenilaianPengajar::where('id_user','=',Auth::user()->id_user)->where('id_kelas','=',$kelas->id_kelas)->first();

            // View
            return view('front/kelas/review-pengajar', [
                'kelas' => $kelas,
                'topik' => $topik,
                'penilaian' => $penilaian,
            ]);
        }
        else{
            return view('error/403');
        }
    }

    /**
     * Menambah penilaian pengajar
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'ulasan' => 'required|max:1000',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'rating',
                'ulasan',
            ]));
        }
        // Jika tidak ada error
        else{
            // Data kelas
            $kelas = Kelas::find($request->id_kelas);

            // Menyimpan data
            $penilaian = new PenilaianPengajar;
            $penilaian->id_user = Auth::user()->id_user;
            $penilaian->id_kelas = $request->id_kelas;
            $penilaian->id_pengajar = $kelas->pengajar_kelas;
            $penilaian->rating = $request->rating;
            $penilaian->review = $request->ulasan;
            $penilaian->pp_at = date('Y-m-d H:i:s');
            $penilaian->save();
        }

        // Redirect
        return redirect('/kelas/'.$kelas->slug_kelas.'/aktivitas/penilaian/pengajar')->with(['message' => 'Berhasil menambah penilaian.']);
    }
}
