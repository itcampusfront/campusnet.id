<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\User;
use App\Website;
use App\WebRequest;

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
            $website->website_url = is_int(strpos($request->website_url, 'https://')) ? $request->website_url : 'https://'.$request->website_url;
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
            // Catat request mencurigakan ke database
            $web_request = new WebRequest;
            $web_request->api_key = $key;
            $web_request->username = $username;
            $web_request->host = $host;
            $web_request->ip_address = $request->ip();
            $web_request->request_at = date('Y-m-d H:i:s');
            $web_request->save();
            
			echo false;
		}
    }

    /**
     * Menampilkan detail website
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        if(Auth::user()->role == role_admin()){
        	// Data website
        	$website = Website::join('users','website.id_user','=','users.id_user')->find($id);

            if(!$website){
                abort(404);
            }

            // View
            return view('admin/website/detail', [
            	'website' => $website,
            ]);
        }
        elseif(Auth::user()->role == role_member()){
        	// Data website
        	$website = Website::join('users','website.id_user','=','users.id_user')->where('website.id_user','=',Auth::user()->id_user)->find($id);

            if(!$website){
                abort(404);
            }

            // View
            return view('member/website/detail', [
            	'website' => $website,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menghapus website
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
    	// Menghapus data
        $website = Website::find($request->id);
        $website->delete();

        // Redirect
        return redirect('/admin/website')->with(['message' => 'Berhasil menghapus data.']);
    }
}
