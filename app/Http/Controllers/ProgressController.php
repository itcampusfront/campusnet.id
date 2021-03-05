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

class ProgressController extends Controller
{
    /**
     * Menampilkan data progress
     *
     * string $category
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
            // Data progress
            $progress = MemberKelas::join('kelas','member_kelas.id_kelas','=','kelas.id_kelas')->join('users','member_kelas.id_user','=','users.id_user')->orderBy('mk_at','desc')->get();

            // View
            return view('admin/progress/all', [
                'progress' => $progress,
            ]);
        }
    }

    /**
     * Menampilkan data progress
     *
     * string $category
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
            // Data progress
            if($category == 'teks')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->where('jenis_konten','=',1)->orderBy('progress_at','desc')->get();
            elseif($category == 'video')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->where('jenis_konten','=',2)->orderBy('progress_at','desc')->get();
            elseif($category == 'file')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->where('jenis_konten','=',3)->orderBy('progress_at','desc')->get();
            elseif($category == 'kuis')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->where('jenis_konten','=',4)->orderBy('progress_at','desc')->get();
            elseif($category == 'tugas')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->where('jenis_konten','=',5)->orderBy('progress_at','desc')->get();

            if(count($progress) > 0){
                foreach($progress as $data){
                    $data->konten = json_decode($data->konten, true);
                    $data->progress_keterangan = $data->jenis_konten == 5 ? json_decode($data->progress_keterangan, true) : $data->progress_keterangan;
                }
            }

            // View
            return view('admin/progress/index', [
                'category' => $category,
                'progress' => $progress,
            ]);
        }
        elseif(Auth::user()->role == role_pengajar()){
            // Data progress
            if($category == 'teks')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->where('jenis_konten','=',1)->where('pengajar_kelas','=',Auth::user()->id_user)->orderBy('progress_at','desc')->get();
            elseif($category == 'video')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->where('jenis_konten','=',2)->where('pengajar_kelas','=',Auth::user()->id_user)->orderBy('progress_at','desc')->get();
            elseif($category == 'file')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->where('jenis_konten','=',3)->where('pengajar_kelas','=',Auth::user()->id_user)->orderBy('progress_at','desc')->get();
            elseif($category == 'kuis')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->where('jenis_konten','=',4)->where('pengajar_kelas','=',Auth::user()->id_user)->orderBy('progress_at','desc')->get();
            elseif($category == 'tugas')
                $progress = Progress::join('users','progress.id_user','=','users.id_user')->join('konten','progress.id_konten','=','konten.id_konten')->join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->where('jenis_konten','=',5)->where('pengajar_kelas','=',Auth::user()->id_user)->orderBy('progress_at','desc')->get();

            if(count($progress) > 0){
                foreach($progress as $data){
                    $data->konten = json_decode($data->konten, true);
                    $data->progress_keterangan = $data->jenis_konten == 5 ? json_decode($data->progress_keterangan, true) : $data->progress_keterangan;
                }
            }

            // View
            return view('admin/progress/index', [
                'category' => $category,
                'progress' => $progress,
            ]);
        }
    }

    /**
     * Menghapus progress
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $category)
    {
    	// Menghapus data
        $progress = Progress::find($request->id);
        $progress->delete();

        // Redirect
        return redirect('/admin/progress/'.$category)->with(['message' => 'Berhasil menghapus data.']);
    }

    /**
     * Menginput progress
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Request
     */
    public function input(Request $request)
    {
        if(check_task_progress(Auth::user()->id_user, $request->id_konten) <= 0){
            // Menambah progress
            $progress = new Progress;
            $progress->id_user = Auth::user()->id_user;
            $progress->id_konten = $request->id_konten;
            $progress->progress = 1;
            $progress->progress_keterangan = '';
            $progress->progress_at = date('Y-m-d H:i:s');
            $progress->save();

            // Get konten
            $konten = Konten::join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->find($request->id_konten);

            // Response
            $response['message'] = "Sukses!";
            $response['percentage'] = percentage_completed_tasks(Auth::user()->id_user, $konten->id_kelas);
            echo json_encode($response);
        }
        else{
            // Response
            $response['message'] = "Nothing";
            echo json_encode($response);
        }
    }

    /**
     * Menginput tugas
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Request
     */
    public function input_tugas(Request $request)
    {
        if(check_task_progress(Auth::user()->id_user, $request->id_konten) <= 0){
            // Upload file
            $file = $request->file('file_tugas');

            // File original name
            $file_original_name = explode('.'.$file->getClientOriginalExtension(), $file->getClientOriginalName())[0];

            // Nama file
            $file_name = $file_original_name;
            $i = 1;
            while(in_array($file_name.'.'.$file->getClientOriginalExtension(), generate_file('assets/files/upload-tugas'))){
                $file_name = rename_permalink($file_name, $i);
                $i++;
            }

            // Move file
            $file->move('assets/files/upload-tugas', $file_name.'.'.$file->getClientOriginalExtension());

            // Keterangan
            $keterangan = $request->keterangan != '' ? $request->keterangan : '';

            // JSON
            $array['file'] = $file_name.'.'.$file->getClientOriginalExtension();
            $array['keterangan'] = $keterangan;

            // Menambah progress
            $progress = new Progress;
            $progress->id_user = Auth::user()->id_user;
            $progress->id_konten = $request->id_konten;
            $progress->progress = 0;
            $progress->progress_keterangan = json_encode($array);
            $progress->progress_at = date('Y-m-d H:i:s');
            $progress->save();

            // Get konten
            $konten = Konten::join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->find($request->id_konten);

            // Redirect
            return redirect('/kelas/'.$konten->slug_kelas.'/aktivitas/'.$konten->id_konten);
        }
    }

    /**
     * Memberi penilaian pada tugas
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Request
     */
    public function penilaian_tugas(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nilai' => 'required|numeric',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Memberi nilai
            $progress = Progress::find($request->id);
            $keterangan = json_decode($progress->progress_keterangan, true);
            $keterangan['nilai'] = $request->nilai;
            $progress->progress = 1;
            $progress->progress_keterangan = json_encode($keterangan);
            $progress->save();
        }

        // Redirect
        return redirect('/admin/progress/tugas')->with(['message' => 'Berhasil memberi penilaian.']);
    }
}
