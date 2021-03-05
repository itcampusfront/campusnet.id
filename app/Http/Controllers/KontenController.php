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

class KontenController extends Controller
{
    /**
     * Menambah data konten
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_konten(Request $request)
    {
        // Mengambil data konten terakhir
        $last_konten = Konten::where('id_topik','=',$request->id_topik)->latest('konten_order')->first();

        // Konten teks
        $teks = $request->jenis_konten == 1 ? upload_quill_image($request->konten_teks, 'assets/images/konten-kelas/') : '';
        $konten_teks = '';
        if($request->jenis_konten == 1){
            $array_konten_teks['nama'] = $request->judul_teks;
            $array_konten_teks['teks'] = htmlentities($teks);
            $konten_teks = json_encode($array_konten_teks);
        }

        // Konten video
        $konten_video = '';
        if($request->jenis_konten == 2){
            $array_konten_video['nama'] = generate_youtube_info(generate_youtube_id($request->konten_video))['title'];
            $array_konten_video['tipe'] = 'youtube';
            $array_konten_video['video'] = $request->konten_video;
            $array_konten_video['durasi'] = generate_youtube_info(generate_youtube_id($request->konten_video))['lengthSeconds'];
            $konten_video = json_encode($array_konten_video);
        }

        // Konten kuis
        $konten_kuis = '';
        if($request->jenis_konten == 4){
            $array_konten_kuis['nama'] = $request->judul_kuis;
            $array_konten_kuis['kuis'] = $request->konten_kuis;
            $konten_kuis = json_encode($array_konten_kuis);
        }

        // Konten tugas
        $konten_tugas = '';
        if($request->jenis_konten == 5){
            $array_konten_tugas['nama'] = $request->judul_tugas;
            $array_konten_tugas['deskripsi'] = $request->deskripsi_tugas;
            $array_konten_tugas['waktu'] = $request->waktu_tugas;
            $konten_tugas = json_encode($array_konten_tugas);
        }

        // Konten
        if($request->jenis_konten == 1)
            $konten_value = $konten_teks;
        elseif($request->jenis_konten == 2)
            $konten_value = $konten_video;
        elseif($request->jenis_konten == 4)
            $konten_value = $konten_kuis;
        elseif($request->jenis_konten == 5)
            $konten_value = $konten_tugas;
        else
            $konten_value = '';

        // Menyimpan data
        $konten = new Konten;
        $konten->id_topik = $request->id_topik;
        $konten->jenis_konten = $request->jenis_konten;
        $konten->konten = $konten_value;
        $konten->konten_order = $last_konten ? $last_konten->konten_order + 1 : 1;
        $konten->konten_at = date('Y-m-d H:i:s');
        $konten->save();

        // Redirect
        return redirect('/admin/kelas/detail/'.$request->id_kelas.'?tab=materi')->with(['message' => 'Berhasil menambah konten.']);
    }

    /**
     * Mengambil data konten untuk diedit
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit_konten(Request $request)
    {
    	// Get data
        $konten = Konten::join('topik','konten.id_topik','=','topik.id_topik')->find($request->id);
        
        // JSON
        echo json_encode($konten);
    }

    /**
     * Mengupdate data konten
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_konten(Request $request)
    {
        // Get data
        $konten = Konten::join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->find($request->id_konten);

        // Konten teks
        $teks = $konten->jenis_konten == 1 ? upload_quill_image($request->konten_teks, 'assets/images/konten-kelas/') : '';
        $konten_teks = '';
        if($konten->jenis_konten == 1){
            $array_konten_teks['nama'] = $request->judul_teks;
            $array_konten_teks['teks'] = htmlentities($teks);
            $konten_teks = json_encode($array_konten_teks);
        }

        // Konten video
        $konten_video = '';
        if($konten->jenis_konten == 2){
            $array_konten_video['nama'] = generate_youtube_info(generate_youtube_id($request->konten_video))['title'];
            $array_konten_video['tipe'] = 'youtube';
            $array_konten_video['video'] = $request->konten_video;
            $array_konten_video['durasi'] = generate_youtube_info(generate_youtube_id($request->konten_video))['lengthSeconds'];
            $konten_video = json_encode($array_konten_video);
        }

        // Konten kuis
        $konten_kuis = '';
        if($konten->jenis_konten == 4){
            $array_konten_kuis['nama'] = $request->judul_kuis;
            $array_konten_kuis['kuis'] = $request->konten_kuis;
            $konten_kuis = json_encode($array_konten_kuis);
        }

        // Konten tugas
        $konten_tugas = '';
        if($konten->jenis_konten == 5){
            $array_konten_tugas['nama'] = $request->judul_tugas;
            $array_konten_tugas['deskripsi'] = $request->deskripsi_tugas;
            $array_konten_tugas['waktu'] = $request->waktu_tugas;
            $konten_tugas = json_encode($array_konten_tugas);
        }

        // Konten
        if($konten->jenis_konten == 1)
            $konten_value = $konten_teks;
        elseif($konten->jenis_konten == 2)
            $konten_value = $konten_video;
        elseif($konten->jenis_konten == 4)
            $konten_value = $konten_kuis;
        elseif($konten->jenis_konten == 5)
            $konten_value = $konten_tugas;
        else
            $konten_value = '';

        // Menyimpan data
        $konten->konten = $konten_value;
        $konten->save();

        // Redirect
        return redirect('/admin/kelas/detail/'.$konten->id_kelas.'?tab=materi')->with(['message' => 'Berhasil mengupdate konten.']);
    }

    /**
     * Menghapus konten
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_konten(Request $request)
    {
    	// Menghapus data
        $konten = Konten::join('topik','konten.id_topik','=','topik.id_topik')->find($request->id);
        $konten->delete();

        // Redirect
        return redirect('/admin/kelas/detail/'.$konten->id_kelas.'?tab=materi')->with(['message' => 'Berhasil menghapus konten.']);
    }

    /**
     * Mengurutkan konten
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sort_konten(Request $request)
    {
        // Mengurutkan konten
        foreach($request->get('ids') as $key=>$id){
            $konten = Konten::where('id_konten','=',$id)->where('id_topik','=',$request->topik)->first();
            if($konten){
                $konten->konten_order = $key + 1;
                $konten->save();
            }
        }
        echo 'Sukses mengupdate urutan konten!';
    }
	
    /**
     * Mengupload konten video
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_video(Request $request)
    {        
        // Nama file
        $file_name = explode('.'.mime_to_ext($_FILES["datafile"]["type"])[0], $_FILES["datafile"]["name"])[0];
        // Nama file temp
        $file_temp = $_FILES["datafile"]["tmp_name"];
        // Tipe file
        $file_type = $_FILES["datafile"]["type"];
        // Ukuran file
        $file_size = $_FILES["datafile"]["size"];

        // Nama file
        $nama_file = generate_permalink($file_name);
        $i = 1;
        while(in_array($nama_file.'.'.mime_to_ext($file_type)[0], generate_file('assets/videos/konten-video'))){
            $nama_file = rename_permalink(generate_permalink($file_name), $i);
            $i++;
        }
        
        // Upload file ke folder
        if (move_uploaded_file($file_temp, 'assets/videos/konten-video/'.$nama_file.'.'.mime_to_ext($file_type)[0])){
            // Konten video
            $konten_video['nama'] = $_FILES["datafile"]["name"];
            $konten_video['tipe'] = "file";
            $konten_video['video'] = $nama_file.'.'.mime_to_ext($file_type)[0];

            // Mengupdate data
            if($_POST['id_konten'] != 0){
                $konten = Konten::find($_POST['id_konten']);
                $konten->konten = json_encode($konten_video);
                $konten->save();
            }
            // Menambah data
            else{
                // Mengambil data konten terakhir
                $last_konten = Konten::where('id_topik','=',$_POST['id_topik'])->latest('konten_order')->first();

                $konten = new Konten;
                $konten->id_topik = $_POST['id_topik'];
                $konten->jenis_konten = 2;
                $konten->konten = json_encode($konten_video);
                $konten->konten_order = $last_konten ? $last_konten->konten_order + 1 : 1;
                $konten->konten_at = date('Y-m-d H:i:s');
                $konten->save();
            }
        }
	}
	
    /**
     * Mengupload konten file
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_file(Request $request)
    {        
        // Nama file
        $file_name = explode('.'.mime_to_ext($_FILES["datafile"]["type"])[0], $_FILES["datafile"]["name"])[0];
        // Nama file temp
        $file_temp = $_FILES["datafile"]["tmp_name"];
        // Tipe file
        $file_type = $_FILES["datafile"]["type"];
        // Ukuran file
        $file_size = $_FILES["datafile"]["size"];

        // Nama file
        $nama_file = generate_permalink($file_name);
        $i = 1;
        while(in_array($nama_file.'.'.mime_to_ext($file_type)[0], generate_file('assets/files/konten-file'))){
            $nama_file = rename_permalink(generate_permalink($file_name), $i);
            $i++;
        }
        
        // Upload file ke folder
        if (move_uploaded_file($file_temp, 'assets/files/konten-file/'.$nama_file.'.'.mime_to_ext($file_type)[0])){
            // Konten video
            $konten_file['nama'] = $_FILES["datafile"]["name"];
            $konten_file['file'] = $nama_file.'.'.mime_to_ext($file_type)[0];

            // Mengupdate data
            if($_POST['id_konten'] != 0){
                $konten = Konten::find($_POST['id_konten']);
                $konten->konten = json_encode($konten_file);
                $konten->save();
            }
            // Menambah data
            else{
                // Mengambil data konten terakhir
                $last_konten = Konten::where('id_topik','=',$_POST['id_topik'])->latest('konten_order')->first();
    
                // Menyimpan data
                $konten = new Konten;
                $konten->id_topik = $_POST['id_topik'];
                $konten->jenis_konten = 3;
                $konten->konten = json_encode($konten_file);
                $konten->konten_order = $last_konten ? $last_konten->konten_order + 1 : 1;
                $konten->konten_at = date('Y-m-d H:i:s');
                $konten->save();
            }

            // echo "Upload $nama_file selesai";
        }
	}
}
