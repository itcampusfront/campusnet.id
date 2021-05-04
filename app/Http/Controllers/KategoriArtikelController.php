<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\KategoriArtikel;

class KategoriArtikelController extends Controller
{
    /**
     * Menampilkan data kategori artikel
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == role_admin()){
            // Kategori artikel
            $kategori = KategoriArtikel::orderBy('id_ka','asc')->get();

            // View
            return view('admin.kategori-artikel.index', [
                'kategori' => $kategori,
            ]);
        }
    }

    /**
     * Menampilkan form tambah kategori artikel
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin()){
            // View
            return view('admin.kategori-artikel.create');
        }
    }

    /**
     * Menambah kategori artikel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Menambah data
            $kategori = new KategoriArtikel;
            $kategori->kategori = $request->kategori;
            $kategori->slug = slugify($request->kategori, 'kategori_artikel', 'slug', 'id_ka', null);
            $kategori->save();
        }

        // Redirect
        return redirect()->route('admin.artikel.kategori.index')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan form edit kategori artikel
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Kategori
        $kategori = KategoriArtikel::findOrFail($id);

        // View
        return view('admin.kategori-artikel.edit', [
            'kategori' => $kategori,
        ]);
    }

    /**
     * Mengupdate kategori artikel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Mengupdate data
            $kategori = KategoriArtikel::find($request->id);
            $kategori->kategori = $request->kategori;
            $kategori->slug = slugify($request->kategori, 'kategori_artikel', 'slug', 'id_ka', $request->id);
            $kategori->save();
        }

        // Redirect
        return redirect()->route('admin.artikel.kategori.index')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Menghapus kategori artikel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {        
        // Menghapus data
        $kategori = KategoriArtikel::where('id_ka','>',0)->findOrFail($request->id);
        $kategori->delete();

        // Redirect
        return redirect()->route('admin.artikel.kategori.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
