<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Artikel;
use App\KategoriArtikel;
use App\Kontributor;
use App\Tag;
use App\User;

class ArtikelController extends Controller
{
    /**
     * Menampilkan data artikel
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_int(strpos(url()->full(), '/admin'))){
            if(Auth::user()->role == role_admin()){
                // Data artikel
                $artikel = Artikel::orderBy('artikel_at','desc')->get();

                // View
                return view('admin/artikel/index', [
                    'artikel' => $artikel
                ]);
            }
        }
        else{
            // Data artikel
            $artikel = Artikel::orderBy('artikel_at','desc')->get();

            // View
            return view('front/artikel/index', [
                'artikel' => $artikel
            ]);
        }
    }

    /**
     * Menambah artikel
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin()){
            // Kategori artikel
            $kategori = KategoriArtikel::orderBy('id_ka','asc')->get();

            // Kontributor
            $kontributor = Kontributor::orderBy('kontributor','asc')->get();

            // View
            return view('admin/artikel/create', [
                'kategori' => $kategori,
                'kontributor' => $kontributor,
            ]);
        }
    }

    /**
     * Menambah artikel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'judul_artikel' => 'required|max:255',
            'kategori' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'judul_artikel',
                'kategori',
            ]));
        }
        // Jika tidak ada error
        else{
            // Menambah data
            $artikel = new Artikel;
            $artikel->judul_artikel = $request->judul_artikel;
            $artikel->slug_artikel = slugify($request->judul_artikel, 'artikel', 'slug_artikel', 'id_artikel', null);
            $artikel->gambar_artikel = generate_image_name("assets/images/artikel/", $request->gambar, $request->gambar_url);
            $artikel->kategori_artikel = $request->kategori;
            $artikel->tag_artikel = generate_tag_by_name($request->get('tag'));
            $artikel->author_artikel = Auth::user()->id_user;
            $artikel->kontributor_artikel = $request->kontributor != null ? $request->kontributor : 0;
            $artikel->konten_artikel = htmlentities(upload_quill_image($request->konten, 'assets/images/konten-artikel/'));
            $artikel->artikel_at = date('Y-m-d H:i:s');
            $artikel->save();
        }

        // Redirect
        return redirect()->route('admin.artikel.index')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan data artikel
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($permalink)
    {
        // Data artikel
        $artikel = Artikel::join('kategori_artikel','artikel.kategori_artikel','=','kategori_artikel.id_ka')->join('users','artikel.author_artikel','=','users.id_user')->where('slug_artikel','=',$permalink)->firstOrFail();

        // Kategori
        $kategori = KategoriArtikel::orderBy('id_ka','asc')->get();

        // Kontributor
        $kontributor = Kontributor::find($artikel->kontributor_artikel);

        // Tag
        $data_tag = [];
        if($artikel->tag_artikel != ''){
            $tags = explode(',', $artikel->tag_artikel);
            if(count($tags)>0){
                foreach($tags as $data){
                    $tag = Tag::find($data);
                    if($tag) array_push($data_tag, $tag);
                }
            }
        }

        // Artikel Lainnya
        $artikel_lainnya = Artikel::join('kategori_artikel','artikel.kategori_artikel','=','kategori_artikel.id_ka')->join('users','artikel.author_artikel','=','users.id_user')->where('id_artikel','!=',$artikel->id_artikel)->orderBy('artikel_at','desc')->limit(3)->get();

        // View
        return view('front/artikel/detail', [
            'artikel' => $artikel,
            'artikel_lainnya' => $artikel_lainnya,
            'kategori' => $kategori,
            'kontributor' => $kontributor,
            'tag' => $data_tag,
        ]);
    }

    /**
     * Menampilkan form edit artikel
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data artikel
        $artikel = Artikel::findOrFail($id);

        // Kategori
        $kategori = KategoriArtikel::orderBy('id_ka','desc')->get();

        // Kontributor
        $kontributor = Kontributor::orderBy('kontributor','asc')->get();

        // View
        return view('admin/artikel/edit', [
            'artikel' => $artikel,
            'kategori' => $kategori,
            'kontributor' => $kontributor,
        ]);
    }

    /**
     * Mengupdate artikel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'judul_artikel' => 'required|max:255',
            'kategori' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'judul_artikel',
                'kategori',
            ]));
        }
        // Jika tidak ada error
        else{
            // Mengupdate data
            $artikel = Artikel::find($request->id);
            $artikel->judul_artikel = $request->judul_artikel;
            $artikel->slug_artikel = slugify($request->judul_artikel, 'artikel', 'slug_artikel', 'id_artikel', $request->id);
            $artikel->gambar_artikel = generate_image_name("assets/images/artikel/", $request->gambar, $request->gambar_url) != '' ? generate_image_name("assets/images/artikel/", $request->gambar, $request->gambar_url) : $artikel->gambar_artikel;
            $artikel->kategori_artikel = $request->kategori;
            $artikel->tag_artikel = generate_tag_by_name($request->get('tag'));
            $artikel->kontributor_artikel = $request->kontributor != null ? $request->kontributor : 0;
            $artikel->konten_artikel = htmlentities(upload_quill_image($request->konten, 'assets/images/konten-artikel/'));
            $artikel->save();
        }

        // Redirect
        return redirect()->route('admin.artikel.index')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Menghapus artikel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {        
        // Menghapus data
        $artikel = Artikel::find($request->id);
        $artikel->delete();

        // Redirect
        return redirect()->route('admin.artikel.index')->with(['message' => 'Berhasil menghapus data.']);
    }
      
    /**
     * Menampilkan file gambar
     *
     * @return \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function showImages(Request $request)
    {
        echo json_encode(generate_file(public_path('assets/images/artikel')));
    }
}
