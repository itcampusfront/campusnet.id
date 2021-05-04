<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Tag;

class TagController extends Controller
{
    /**
     * Menampilkan data tag
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == role_admin()){
            // tag
            $tag = Tag::all();

            // View
            return view('admin.tag.index', [
                'tag' => $tag,
            ]);
        }
    }

    /**
     * Menampilkan form tambah tag
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin()){
            // View
            return view('admin.tag.create');
        }
    }

    /**
     * Menambah tag
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'tag' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Menambah data
            $tag = new Tag;
            $tag->tag = $request->tag;
            $tag->slug = slugify($request->tag, 'tag', 'slug', 'id_tag', null);
            $tag->save();
        }

        // Redirect
        return redirect()->route('admin.artikel.tag.index')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan form edit tag
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // tag
        $tag = Tag::findOrFail($id);

        // View
        return view('admin.tag.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Mengupdate tag
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'tag' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Mengupdate data
            $tag = Tag::find($request->id);
            $tag->tag = $request->tag;
            $tag->slug = slugify($request->tag, 'tag', 'slug', 'id_tag', $request->id);
            $tag->save();
        }

        // Redirect
        return redirect()->route('admin.artikel.tag.index')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Menghapus tag
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {        
        // Menghapus data
        $tag = Tag::findOrFail($request->id);
        $tag->delete();

        // Redirect
        return redirect()->route('admin.artikel.tag.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
