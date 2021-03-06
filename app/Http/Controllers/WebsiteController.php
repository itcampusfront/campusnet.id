<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\User;
use App\Website;

class WebsiteController extends Controller
{
    /**
     * Menampilkan data website
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == role_admin()){
            // Data website
            $website = Website::join('users','website.id_user','=','users.id_user')->get();

            // View
            return view('admin/website/index', [
                'website' => $website,
            ]);
        }
        elseif(Auth::user()->role == role_member()){
            // Data website
            $website = Website::join('users','website.id_user','=','users.id_user')->where('website.id_user','=',Auth::user()->id_user)->orderBy('website_at','desc')->get();

            // View
            return view('member/website/index', [
                'website' => $website,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menampilkan form tambah website
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_member()){
            // View
            return view('member/website/create');
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menambah website
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'website_url' => 'required|unique:website',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Menyimpan data
            $website = new Website;
            $website->id_user = Auth::user()->id_user;
            $website->website_key = '-';
            $website->website_url = $request->website_url;
            $website->website_status = 2;
            $website->website_at = date('Y-m-d H:i:s');
            $website->save();
        }

        // Redirect
        return redirect('/member/website')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan halaman aktivasi website
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function activation($id)
    {
        if(Auth::user()->role == role_admin()){
        	// Data website
        	$website = Website::find($id);

            if(!$website){
                abort(404);
            }

            // View
            return view('admin/website/activation', [
            	'website' => $website,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Mengaktivasi website
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Menyimpan data
            $website = Website::find($request->id);
            $website->website_key = Str::random(40);
            $website->website_status = 1;
            $website->save();
        }

        // Redirect
        return redirect('/admin/website')->with(['message' => 'Berhasil mengaktivasi website.']);
    }
	
    /**
     * Check
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
		// Params
		$key = $request->query('key');
		$username = $request->query('username');
		$host = $request->query('host');

        // Check
        $website =  Website::join('users','website.id_user','=','users.id_user')->where('website_key','=',$key)->where('website_url','=',$host)->where('username','=',$username)->first();
		
		// Conditions
		if($website)
			echo true;
		else{			
			echo false;
		}
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
