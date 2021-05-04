<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kontributor;

class KontributorController extends Controller
{
    /**
     * Menampilkan data kontributor
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == role_admin()){
            // kontributor
            $kontributor = Kontributor::all();

            // View
            return view('admin.kontributor.index', [
                'kontributor' => $kontributor,
            ]);
        }
    }

    /**
     * Menampilkan form tambah kontributor
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin()){
            // View
            return view('admin.kontributor.create');
        }
    }

    /**
     * Menambah kontributor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'kontributor' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Menambah data
            $kontributor = new kontributor;
            $kontributor->kontributor = $request->kontributor;
            $kontributor->slug = slugify($request->kontributor, 'kontributor', 'slug', 'id_kontributor', null);
            $kontributor->save();
        }

        // Redirect
        return redirect()->route('admin.artikel.kontributor.index')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan form edit kontributor
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // kontributor
        $kontributor = Kontributor::findOrFail($id);

        // View
        return view('admin.kontributor.edit', [
            'kontributor' => $kontributor,
        ]);
    }

    /**
     * Mengupdate kontributor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'kontributor' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Mengupdate data
            $kontributor = Kontributor::find($request->id);
            $kontributor->kontributor = $request->kontributor;
            $kontributor->slug = slugify($request->kontributor, 'kontributor', 'slug', 'id_kontributor', $request->id);
            $kontributor->save();
        }

        // Redirect
        return redirect()->route('admin.artikel.kontributor.index')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Menghapus kontributor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {        
        // Menghapus data
        $kontributor = Kontributor::findOrFail($request->id);
        $kontributor->delete();

        // Redirect
        return redirect()->route('admin.artikel.kontributor.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
