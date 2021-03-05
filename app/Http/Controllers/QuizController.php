<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kuis;
use App\MemberKuis;
use App\User;

class QuizController extends Controller
{
    /**
     * Menampilkan data kuis
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
            // Data kuis
            $kuis = Kuis::join('users','kuis.kuis_author','=','users.id_user')->orderBy('kuis_up','desc')->get();

            // View
            return view('admin/kuis/index', [
                'kuis' => $kuis,
            ]);
        }
        elseif(Auth::user()->role == role_pengajar()){
            // Data kuis
            $kuis = Kuis::join('users','kuis.kuis_author','=','users.id_user')->where('kuis_author','=',Auth::user()->id_user)->orderBy('kuis_up','desc')->get();

            // View
            return view('admin/kuis/index', [
                'kuis' => $kuis,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Membuat kuis
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // View
        return view('admin/kuis/create');
    }

    /**
     * Menyimpan kuis
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        // Mengambil data
        $kuis = $request->id != '' && $request->id != null ? Kuis::find($request->id) : new Kuis;

        // Membuat kode unik
        $kode_unik = $request->id != '' && $request->id != null ? $kuis->kode_kuis : shuffle_string(8);
        if($request->id == '' || $request->id == null){
            while(Kuis::where('kode_kuis','=',$kode_unik)->count() > 0){
                $kode_unik = shuffle_string(8);
            }
        }
        
        // Menyimpan data
        $kuis->kode_kuis = $kode_unik;
        $kuis->judul_kuis = $request->judul != '' ? $request->judul : '';
        $kuis->deskripsi_kuis = $request->deskripsi != '' ? $request->deskripsi : '';
        $kuis->pertanyaan = $request->pertanyaan;
        $kuis->pilihan = $request->pilihan;
        $kuis->gambar_pertanyaan = $request->gambar_pertanyaan;
        $kuis->gambar_pilihan = $request->gambar_pilihan;
        $kuis->dimensi_pertanyaan = $request->dimensi_pertanyaan;
        $kuis->dimensi_pilihan = $request->dimensi_pilihan;
        $kuis->kunci_jawaban = $request->kunci_jawaban;
        $kuis->kuis_author = Auth::user()->id_user;
        $kuis->kuis_at = $request->id != '' && $request->id != null ? $kuis->kuis_at : date('Y-m-d H:i:s');
        $kuis->kuis_up = date('Y-m-d H:i:s');
        $kuis->save();

        // Get kuis
        $saved_kuis = Kuis::where('kode_kuis','=',$kuis->kode_kuis)->first();

        // JSON Encode
        echo json_encode([
            'id' => $saved_kuis->id_kuis,
            'kode' => $saved_kuis->kode_kuis,
            'url' => url('quiz/embed/'.$saved_kuis->kode_kuis)
        ]);
    }

    /**
     * Menampilkan kuis
     *
     * string $code
     * @return \Illuminate\Http\Response
     */
    public function view($code)
    {
        $kuis = Kuis::where('kode_kuis','=',$code)->first();

        if(!$kuis){
            abort(404);
        }

        // Convert
        $kuis->pertanyaan = json_decode($kuis->pertanyaan, true);
        $kuis->pilihan = json_decode($kuis->pilihan, true);
        $kuis->gambar_pertanyaan = json_decode($kuis->gambar_pertanyaan, true);
        $kuis->gambar_pilihan = json_decode($kuis->gambar_pilihan, true);
        $kuis->dimensi_pertanyaan = json_decode($kuis->dimensi_pertanyaan, true);
        $kuis->dimensi_pilihan = json_decode($kuis->dimensi_pilihan, true);
        $kuis->kunci_jawaban = json_decode($kuis->kunci_jawaban, true);

        // Count
        $count = count($kuis->pertanyaan);

        // View
        return view('front/kuis', [
            'kuis' => $kuis,
            'count' => $count,
        ]);
    }

    /**
     * Mengedit kuis
     *
     * string $code
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
            $kuis = Kuis::where('kode_kuis','=',$code)->first();

            if(!$kuis){
                abort(404);
            }

            // Convert
            $kuis->pertanyaan = json_decode($kuis->pertanyaan, true);
            $kuis->pilihan = json_decode($kuis->pilihan, true);
            $kuis->gambar_pertanyaan = json_decode($kuis->gambar_pertanyaan, true);
            $kuis->gambar_pilihan = json_decode($kuis->gambar_pilihan, true);
            $kuis->dimensi_pertanyaan = json_decode($kuis->dimensi_pertanyaan, true);
            $kuis->dimensi_pilihan = json_decode($kuis->dimensi_pilihan, true);
            $kuis->kunci_jawaban = json_decode($kuis->kunci_jawaban, true);

            // Count
            $count = count($kuis->pertanyaan);

            // View
            return view('admin/kuis/edit', [
                'kuis' => $kuis,
                'count' => $count,
            ]);
        }
        elseif(Auth::user()->role == role_pengajar()){
            $kuis = Kuis::where('kode_kuis','=',$code)->where('kuis_author','=',Auth::user()->id_user)->first();

            if(!$kuis){
                abort(404);
            }

            // Convert
            $kuis->pertanyaan = json_decode($kuis->pertanyaan, true);
            $kuis->pilihan = json_decode($kuis->pilihan, true);
            $kuis->gambar_pertanyaan = json_decode($kuis->gambar_pertanyaan, true);
            $kuis->gambar_pilihan = json_decode($kuis->gambar_pilihan, true);
            $kuis->dimensi_pertanyaan = json_decode($kuis->dimensi_pertanyaan, true);
            $kuis->dimensi_pilihan = json_decode($kuis->dimensi_pilihan, true);
            $kuis->kunci_jawaban = json_decode($kuis->kunci_jawaban, true);

            // Count
            $count = count($kuis->pertanyaan);

            // View
            return view('admin/kuis/edit', [
                'kuis' => $kuis,
                'count' => $count,
            ]);
        }
    }

    /**
     * Menyubmit kuis
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {        
        // Get kode unik kuis
        $explode = explode("/", $request->id);
        $kode_unik = $explode[count($explode)-1];

        // Get kuis
        $kuis = Kuis::where('kode_kuis','=',$kode_unik)->first();

        if(!$kuis){
            echo "Kuis tidak ditemukan!";
        }

        // Kunci jawaban, jumlah soal
        $kunci = json_decode(stripslashes($kuis->kunci_jawaban));
        $jumlah = count($kunci);

        // Jawaban
        $jawaban = json_decode(stripslashes($request->jawaban));

        // Poin per soal
        $poin = 100 / $jumlah;

        // Hitung skor
        $skor = 0;
        for($i = 0; $i < $jumlah; $i++){
            if($jawaban[$i] != '' && $jawaban[$i] == $kunci[$i]){
                $skor += $poin;
            }
        }
        echo round($skor);
    }

    /**
     * Mengupload gambar
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_image(Request $request)
    {
        // Nama file
        $nama_file = date('Y-m-d-H-i-s').'.'.mime_to_ext($_FILES["file"]["type"])[0];
        
        // Proses upload file ke folder
        if(move_uploaded_file($_FILES["file"]["tmp_name"], 'assets/images/konten-kuis/'.$nama_file)){
            echo url("assets/images/konten-kuis/".$nama_file);
        }
    }
      
    /**
     * Menampilkan file gambar soal
     *
     * @return \Illuminate\Http\Response
     */
    public function show_images()
    {
        echo json_encode(generate_file(public_path('assets/images/konten-kuis')));
    }
}
