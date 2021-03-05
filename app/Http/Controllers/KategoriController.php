<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kategori;
use App\Kelas;
use App\User;

class KategoriController extends Controller
{
    /**
     * Menampilkan data kategori
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() && (Auth::user()->role == role_admin() || Auth::user()->role == role_manager()) && strpos(url()->current(), '/admin/kategori')){
            // Data kategori
            $kategori = Kategori::where('id_kategori','>',0)->get();

            // View
            return view('admin/kategori/index', [
                'kategori' => $kategori,
            ]);
        }
        elseif(Auth::check() && Auth::user()->role == role_pengajar() && strpos(url()->current(), '/admin/kategori')){
            // View
            return view('error/403');
        }
        else{
            // Data kategori
            $kategori = Kategori::orderBy('kategori_at','desc')->paginate(16);

            // Count kelas berdasarkan kategori
            if(count($kategori)>0){
                foreach($kategori as $key=>$data){
                    $count = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('kelas.kategori_kelas','=',$data->id_kategori)->count();
                    $kategori[$key]->count_kelas = $count;
                }
            }

            // View
            return view('front/kategori/index', [
                'kategori' => $kategori,
            ]);
        }
    }

    /**
     * Menampilkan form tambah kategori
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
            // View
            return view('admin/kategori/create');
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
            'nama_kategori' => 'required|max:200',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
			// Upload gambar
            $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/kategori/") : '';

            // Permalink
            $permalink = generate_permalink($request->nama_kategori);
            $i = 1;
            while(count_existing_data('kategori', 'slug_kategori', $permalink, 'id_kategori', null) > 0){
                $permalink = rename_permalink(generate_permalink($request->nama_kategori), $i);
                $i++;
            }

            // Menyimpan data
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->slug_kategori = $permalink;
            $kategori->gambar_kategori = $image_name;
            $kategori->kategori_at = date('Y-m-d H:i:s');
            $kategori->save();
        }

        // Redirect
        return redirect('/admin/kategori')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan detail kategori
     *
     * string $permalink
     * @return \Illuminate\Http\Response
     */
    public function detail($permalink)
    {
        // Data kategori
        $kategori = Kategori::where('slug_kategori','=',$permalink)->first();

        if(!$kategori){
            abort(404);
        }

        // Data kelas
        $kelas = Kelas::join('kategori','kelas.kategori_kelas','=','kategori.id_kategori')->join('users','kelas.pengajar_kelas','=','users.id_user')->join('level','kelas.level_kelas','=','level.id_level')->where('kelas.kategori_kelas','=',$kategori->id_kategori)->orderBy('kelas_at','desc')->paginate(16);

        // View
        return view('front/kategori/detail', [
            'kategori' => $kategori,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Menampilkan form edit kategori
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
        	// Data kategori
        	$kategori = Kategori::find($id);

            if(!$kategori){
                abort(404);
            }

            // View
            return view('admin/kategori/edit', [
            	'kategori' => $kategori,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Mengupdate kategori
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|max:200',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
			// Upload gambar
            $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/kategori/") : '';

            // Permalink
            $permalink = generate_permalink($request->nama_kategori);
            $i = 1;
            while(count_existing_data('kategori', 'slug_kategori', $permalink, 'id_kategori', $request->id) > 0){
                $permalink = rename_permalink(generate_permalink($request->nama_kategori), $i);
                $i++;
            }

            // Mengupdate data
            $kategori = Kategori::find($request->id);
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->slug_kategori = $permalink;
            $kategori->gambar_kategori = $request->gambar != '' ? $image_name : $kategori->gambar_kategori;
            $kategori->save();
        }

        // Redirect
        return redirect('/admin/kategori')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Menghapus kategori
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
    	// Menghapus data
        $kategori = Kategori::find($request->id);
        $kategori->delete();

        // Redirect
        return redirect('/admin/kategori')->with(['message' => 'Berhasil menghapus data.']);
    }
}
