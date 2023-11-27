<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Testimoni;
use App\Models\User;

class TestimoniController extends Controller
{
    /**
     * Menampilkan data testimoni
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == role_admin()){
            // Data testimoni
            $testimoni = Testimoni::orderBy('order_testimoni','asc')->get();

            // View
            return view('admin/testimoni/index', [
                'testimoni' => $testimoni,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menampilkan form tambah testimoni
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin()){
            // View
            return view('admin/testimoni/create');
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menambah testimoni
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'klien' => 'required|max:255',
            'ucapan_testimoni' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Latest testimoni
            $latest_testimoni = Testimoni::latest('order_testimoni')->first();

            // Menyimpan data
            $testimoni = new Testimoni;
            $testimoni->klien = $request->klien;
            $testimoni->ucapan_testimoni = $request->ucapan_testimoni;
            $testimoni->order_testimoni = $latest_testimoni ? $latest_testimoni->order_testimoni + 1 : 1;
            $testimoni->testimoni_at = date('Y-m-d H:i:s');
            $testimoni->save();
        }

        // Redirect
        return redirect('/admin/testimoni')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan form edit testimoni
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == role_admin()){
        	// Data testimoni
        	$testimoni = Testimoni::find($id);

            if(!$testimoni){
                abort(404);
            }

            // View
            return view('admin/testimoni/edit', [
            	'testimoni' => $testimoni,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Mengupdate testimoni
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'klien' => 'required|max:255',
            'ucapan_testimoni' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Menyimpan data
            $testimoni = Testimoni::find($request->id);
            $testimoni->klien = $request->klien;
            $testimoni->ucapan_testimoni = $request->ucapan_testimoni;
            $testimoni->save();
        }

        // Redirect
        return redirect('/admin/testimoni')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Mengurutkan testimoni
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sorting(Request $request)
    {
        // Mengurutkan testimoni
        foreach($request->get('ids') as $key=>$id){
            $testimoni = Testimoni::find($id);
            if($testimoni){
                $testimoni->order_testimoni = $key + 1;
                $testimoni->save();
            }
        }
        echo 'Sukses mengupdate urutan testimoni!';
    }

    /**
     * Menghapus testimoni
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
    	// Menghapus data
        $testimoni = Testimoni::find($request->id);
        $testimoni->delete();

        // Redirect
        return redirect('/admin/testimoni')->with(['message' => 'Berhasil menghapus data.']);
    }
}
