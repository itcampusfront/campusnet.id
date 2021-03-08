<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Fitur;
use App\User;

class FiturController extends Controller
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
            $fitur = Fitur::orderBy('order_fitur','asc')->get();

            // View
            return view('admin/fitur/index', [
                'fitur' => $fitur,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menampilkan form tambah fitur
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin()){
            // View
            return view('admin/fitur/create');
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menambah fitur
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_fitur' => 'required|max:255',
            'deskripsi_fitur' => 'required',
            'gambar' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Latest fitur
            $latest_fitur = Fitur::latest('order_fitur')->first();

			// Upload gambar
            $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/fitur/") : '';

            // Menyimpan data
            $fitur = new Fitur;
            $fitur->nama_fitur = $request->nama_fitur;
            $fitur->deskripsi_fitur = $request->deskripsi_fitur;
            $fitur->gambar_fitur = $image_name;
            $fitur->order_fitur = $latest_fitur ? $latest_fitur->order_fitur + 1 : 1;
            $fitur->fitur_at = date('Y-m-d H:i:s');
            $fitur->save();
        }

        // Redirect
        return redirect('/admin/fitur')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan form edit fitur
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == role_admin()){
        	// Data fitur
        	$fitur = Fitur::find($id);

            if(!$fitur){
                abort(404);
            }

            // View
            return view('admin/fitur/edit', [
            	'fitur' => $fitur,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Mengupdate fitur
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_fitur' => 'required|max:255',
            'deskripsi_fitur' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
			// Upload gambar
            $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/fitur/") : '';

            // Menyimpan data
            $fitur = Fitur::find($request->id);
            $fitur->nama_fitur = $request->nama_fitur;
            $fitur->deskripsi_fitur = $request->deskripsi_fitur;
            $fitur->gambar_fitur = $image_name != '' ? $image_name : $fitur->gambar_fitur;
            $fitur->save();
        }

        // Redirect
        return redirect('/admin/fitur')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Mengurutkan fitur
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sorting(Request $request)
    {
        // Mengurutkan fitur
        foreach($request->get('ids') as $key=>$id){
            $fitur = Fitur::find($id);
            if($fitur){
                $fitur->order_fitur = $key + 1;
                $fitur->save();
            }
        }
        echo 'Sukses mengupdate urutan fitur!';
    }

    /**
     * Menghapus fitur
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
    	// Menghapus data
        $fitur = Fitur::find($request->id);
        $fitur->delete();

        // Redirect
        return redirect('/admin/fitur')->with(['message' => 'Berhasil menghapus data.']);
    }
}
