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

class KelasController extends Controller
{
    /**
     * Menampilkan data kelas
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() && (Auth::user()->role == role_admin() || Auth::user()->role == role_manager()) && strpos(url()->current(), '/admin/kelas')){
            // Data kelas
            $kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->get();

            // View
            return view('admin/kelas/index', [
                'kelas' => $kelas,
            ]);
        }
        elseif(Auth::check() && Auth::user()->role == role_pengajar() && strpos(url()->current(), '/admin/kelas')){
            // Data kelas
            $kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('kelas.pengajar_kelas','=',Auth::user()->id_user)->get();

            if(count($kelas)>0){
                foreach($kelas as $key=>$data){
                    $count_topik = Topik::where('id_kelas','=',$data->id_kelas)->count();
                    $kelas[$key]->topik = $count_topik;
                }
            }

            // View
            return view('admin/kelas/index', [
                'kelas' => $kelas,
            ]);
        }
        else{
            // Data kelas
            $kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->orderBy('kelas_at','desc')->paginate(16);

            // View
            return view('front/kelas/index', [
                'kelas' => $kelas,
            ]);
        }
    }

    /**
     * Menampilkan form tambah kelas
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager() || Auth::user()->role == role_pengajar()){
            // Data kategori
            $kategori = Kategori::all();

            // Data pengajar
            $pengajar = User::where('role','=',role_pengajar())->where('status','=',1)->get();

            // Data level
            $level = Level::all();

            // View
            return view('admin/kelas/create', [
                'kategori' => $kategori,
                'pengajar' => $pengajar,
                'level' => $level
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menambah kategori
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|max:200',
            'kategori_kelas' => 'required',
            'pengajar_kelas' => Auth::user()->role == role_admin() || Auth::user()->role == role_manager() ? 'required' : '',
            'level_kelas' => 'required',
            // 'harga_kelas' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'nama_kelas',
                'kategori_kelas',
                'pengajar_kelas',
                'level_kelas',
                // 'harga_kelas',
            ]));
        }
        // Jika tidak ada error
        else{
			// Upload gambar
            $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/kelas/") : '';

            // Upload gambar dari quill
            $html = upload_quill_image($request->deskripsi_kelas, 'assets/images/konten-kelas/');

            // Permalink
            $permalink = generate_permalink($request->nama_kelas);
            $i = 1;
            while(count_existing_data('kelas', 'slug_kelas', $permalink, 'id_kelas', null) > 0){
                $permalink = rename_permalink(generate_permalink($request->nama_kelas), $i);
                $i++;
            }

            // Menyimpan data
            $kelas = new Kelas;
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->slug_kelas = $permalink;
            $kelas->deskripsi_kelas = htmlentities($html);
            $kelas->kategori_kelas = $request->kategori_kelas;
            $kelas->pengajar_kelas = Auth::user()->role == role_admin() || Auth::user()->role == role_manager() ? $request->pengajar_kelas : Auth::user()->id_user;
            $kelas->level_kelas = $request->level_kelas;
            $kelas->level_kelas = 0;
            // $kelas->harga_kelas = str_replace('.', '', $request->harga_kelas);
            $kelas->gambar_kelas = $image_name;
            $kelas->kelas_at = date('Y-m-d H:i:s');
            $kelas->save();
        }

        // Redirect
        return redirect('/admin/kelas')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan detail data kelas
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        if(Auth::check() && (Auth::user()->role == role_admin() || Auth::user()->role == role_manager()) && strpos(url()->current(), '/admin/kelas')){
        	// Data kelas
        	$kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->find($id);

            if(!$kelas){
                abort(404);
            }

            // Data topik
            $topik = Topik::where('id_kelas','=',$kelas->id_kelas)->orderBy('topik_order','asc')->get();

            // Data konten
            if(count($topik)>0){
                foreach($topik as $key=>$data){
                    $konten = Konten::where('id_topik','=',$data->id_topik)->orderBy('konten_order','asc')->get();
                    $topik[$key]->konten = count($konten) > 0 ? $konten : [];
                }
            }

            // View
            return view('admin/kelas/detail', [
            	'kelas' => $kelas,
            	'topik' => $topik,
            ]);
        }
        elseif(Auth::check() && Auth::user()->role == role_pengajar() && strpos(url()->current(), '/admin/kelas')){
        	// Data kelas
        	$kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('kelas.pengajar_kelas','=',Auth::user()->id_user)->find($id);

            if(!$kelas){
                abort(404);
            }

            // Data topik
            $topik = Topik::where('id_kelas','=',$kelas->id_kelas)->orderBy('topik_order','asc')->get();

            // Data konten
            if(count($topik)>0){
                foreach($topik as $key=>$data){
                    $konten = Konten::where('id_topik','=',$data->id_topik)->orderBy('konten_order','asc')->get();
                    $topik[$key]->konten = count($konten) > 0 ? $konten : [];
                }
            }

            // View
            return view('admin/kelas/detail', [
            	'kelas' => $kelas,
            	'topik' => $topik,
            ]);
        }
        else{
        	// Data kelas
        	$kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('slug_kelas','=',$id)->first();

            if(!$kelas){
                abort(404);
            }

            // Data topik
            $topik = Topik::where('id_kelas','=',$kelas->id_kelas)->orderBy('topik_order','asc')->get();

            // Data konten
            if(count($topik)>0){
                foreach($topik as $key=>$data){
                    $konten = Konten::where('id_topik','=',$data->id_topik)->orderBy('konten_order','asc')->get();
                    $topik[$key]->konten = count($konten) > 0 ? $konten : [];

                    if(count($konten) > 0){
                        foreach($konten as $data2){
                            $data2->konten = json_decode($data2->konten, true);
                        }
                    }
                }
            }

            // View
            return view('front/kelas/detail', [
            	'kelas' => $kelas,
            	'topik' => $topik,
            ]);
        }
    }

    /**
     * Menampilkan form edit kelas
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
        	// Data kelas
        	$kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->find($id);

            if(!$kelas){
                abort(404);
            }

            // Data kategori
            $kategori = Kategori::all();

            // Data pengajar
            $pengajar = User::where('role','=',role_pengajar())->where('status','=',1)->get();

            // Data level
            $level = Level::all();

            // View
            return view('admin/kelas/edit', [
            	'kelas' => $kelas,
            	'kategori' => $kategori,
            	'pengajar' => $pengajar,
            	'level' => $level,
            ]);
        }
        elseif(Auth::user()->role == role_pengajar()){
        	// Data kelas
        	$kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('kelas.pengajar_kelas','=',Auth::user()->id_user)->find($id);

            if(!$kelas){
                abort(404);
            }

            // Data kategori
            $kategori = Kategori::all();

            // Data pengajar
            $pengajar = User::where('role','=',role_pengajar())->where('status','=',1)->get();

            // Data level
            $level = Level::all();

            // View
            return view('admin/kelas/edit', [
            	'kelas' => $kelas,
            	'kategori' => $kategori,
            	'pengajar' => $pengajar,
            	'level' => $level,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Mengupdate kelas
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|max:200',
            'kategori_kelas' => 'required',
            'pengajar_kelas' => Auth::user()->role == role_admin() || Auth::user()->role == role_manager() ? 'required' : '',
            'level_kelas' => 'required',
            // 'harga_kelas' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'nama_kelas',
                'kategori_kelas',
                'pengajar_kelas',
                'level_kelas',
                // 'harga_kelas',
            ]));
        }
        // Jika tidak ada error
        else{
			// Upload gambar
            $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/kelas/") : '';

            // Upload gambar dari quill
            $html = upload_quill_image($request->deskripsi_kelas, 'assets/images/konten-kelas/');

            // Permalink
            $permalink = generate_permalink($request->nama_kelas);
            $i = 1;
            while(count_existing_data('kelas', 'slug_kelas', $permalink, 'id_kelas', $request->id) > 0){
                $permalink = rename_permalink(generate_permalink($request->nama_kelas), $i);
                $i++;
            }

            // Mengupdate data
            $kelas = Kelas::find($request->id);
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->slug_kelas = $permalink;
            $kelas->deskripsi_kelas = htmlentities($html);
            $kelas->kategori_kelas = $request->kategori_kelas;
            $kelas->pengajar_kelas = Auth::user()->role == role_admin() || Auth::user()->role == role_manager() ? $request->pengajar_kelas : Auth::user()->id_user;
            $kelas->level_kelas = $request->level_kelas;
            // $kelas->harga_kelas = str_replace('.', '', $request->harga_kelas);
            $kelas->gambar_kelas = $image_name != '' ? $image_name : $kelas->gambar_kelas;
            $kelas->save();
        }

        // Redirect
        return redirect('/admin/kelas')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Menghapus kelas
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
    	// Menghapus data
        $kelas = Kelas::find($request->id);
        $kelas->delete();

        // Redirect
        return redirect('/admin/kelas')->with(['message' => 'Berhasil menghapus data.']);
    }

    /**
     * Menampilkan aktivitas kelas
     *
     * string $permalink
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function activity($permalink, $id)
    {
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

        // Data konten
        $konten = Konten::join('topik','konten.id_topik','=','topik.id_topik')->join('kelas','topik.id_kelas','=','kelas.id_kelas')->find($id);

        if(!$konten){
            abort(404);
        }
        $konten->konten = json_decode($konten->konten, true);

        // Mengecek apakah task sudah dikerjakan atau belum
        if(check_task_progress(Auth::user()->id_user, $konten->id_konten) <= 0 && $id != get_first_konten($kelas->id_kelas) && check_task_progress(Auth::user()->id_user, get_konten_before($kelas->id_kelas, $konten->id_konten)) <= 0){
            // Redirect
            return redirect('/kelas/'.$kelas->slug_kelas.'/aktivitas/'.get_first_konten($kelas->id_kelas));
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

        // Tugas
        if($konten->jenis_konten == 5){
            $tugas = Progress::where('id_user','=',Auth::user()->id_user)->where('id_konten','=',$konten->id_konten)->first();
            
            if(!$tugas){
                $tugas = null;
            }
            else{
                $tugas->progress_keterangan = json_decode($tugas->progress_keterangan, true);
            }
        }
        else{
            $tugas = null;
        }

        // View
        return view('front/kelas/activity', [
            'kelas' => $kelas,
            'topik' => $topik,
            'konten' => $konten,
            'tugas' => $tugas,
        ]);
    }

    /**
     * Mendaftar kelas
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Request
     */
    public function register(Request $request)
    {
        if(Auth::user()->role == role_pelajar()){
            if(check_member_kelas(Auth::user()->id_user, $request->id_kelas) <= 0){
                // Menyimpan data
                $member_kelas = new MemberKelas;
                $member_kelas->id_user = Auth::user()->id_user;
                $member_kelas->id_kelas = $request->id_kelas;
                $member_kelas->mk_at = date('Y-m-d H:i:s');
                $member_kelas->save();
            }

            // Kelas
            $kelas = Kelas::find($request->id_kelas);

            // Redirect
            return redirect('/kelas/'.$kelas->slug_kelas.'/aktivitas/'.get_first_konten($request->id_kelas));
        }
    }

    /**
     * List kelas
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        if(Auth::check() && Auth::user()->role == role_pengajar()){
            // Data kelas
            $kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('pengajar_kelas','=',Auth::user()->id_user)->orderBy('kelas_at','desc')->paginate(10);

        	// Data user
        	$user = User::find(Auth::user()->id_user);

            // View
            return view('front/user/list-kelas', [
                'kelas' => $kelas,
                'user' => $user,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Riwayat kelas
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        if(Auth::check() && Auth::user()->role == role_pelajar()){
            // Data kelas
            $kelas = MemberKelas::join('kelas','member_kelas.id_kelas','=','kelas.id_kelas')->join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('member_kelas.id_user','=',Auth::user()->id_user)->orderBy('mk_at','desc')->paginate(10);

        	// Data user
        	$user = User::find(Auth::user()->id_user);

            // View
            return view('front/user/riwayat-kelas', [
                'kelas' => $kelas,
                'user' => $user,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }
}
