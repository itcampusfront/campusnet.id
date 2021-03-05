<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Role;
use App\UpdatePassword;
use App\User;

class UserController extends Controller
{
    /**
     * Menampilkan data user
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
            // Data user
            $user = User::join('role','users.role','=','role.id_role')->orderBy('role','asc')->get();

            // View
            return view('admin/user/index', [
                'user' => $user,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menampilkan form tambah user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
            // Data role
            $role = Role::all();

            // View
            return view('admin/user/create', [
                'role' => $role
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Menambah user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|max:200',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|string|email|max:200|unique:users',
            'nomor_hp' => 'required|numeric',
            'username' => 'required|string|alpha_dash|max:200|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            'status' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'nama_user',
                'tanggal_lahir',
                'jenis_kelamin',
                'username',
                'email',
                'nomor_hp',
                'role',
                'status',
            ]));
        }
        // Jika tidak ada error
        else{
			// Upload gambar
            $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/user/") : '';

            // Menambah data
            $user = new User;
            $user->nama_user = $request->nama_user;
            $user->tanggal_lahir = generate_date_format($request->tanggal_lahir, '-');
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->email = $request->email;
            $user->nomor_hp = $request->nomor_hp;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->foto = $request->gambar != '' ? $image_name : '';
            $user->role = $request->role;
            $user->status = $request->status;
            $user->email_verified = 1;
            $user->last_visit = null;
            $user->register_at = date('Y-m-d H:i:s');
            $user->save();
        }

        // Redirect
        return redirect('/admin/user')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Menampilkan profil user
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        if(Auth::check()){
        	// Data user
        	$user = User::find(Auth::user()->id_user);

            if(!$user){
                abort(404);
            }

            // View
            return view('front/user/profile', [
            	'user' => $user,
            ]);
        }
        else{
            // Redirect Login
            session()->put('url.intended', url()->to('/profil'));
            return redirect('/login');
        }
    }

    /**
     * Mengupdate profil
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|max:200',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_hp' => 'required|numeric',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'nama_user',
                'tanggal_lahir',
                'jenis_kelamin',
                'nomor_hp',
            ]));
        }
        // Jika tidak ada error
        else{
            // Mengupdate data
            $user = User::find(Auth::user()->id_user);
            $user->nama_user = $request->nama_user;
            $user->tanggal_lahir = generate_date_format($request->tanggal_lahir, '-');
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->nomor_hp = $request->nomor_hp;
            $user->save();
        }

        // Redirect
        return redirect('/profil')->with(['message' => 'Berhasil mengupdate profil.']);
    }

    /**
     * Mengupdate foto profil
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_photo(Request $request)
    {
        // Upload gambar
        $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/user/") : '';

        // Mengupdate gambar
        $user = User::find(Auth::user()->id_user);
        $user->foto = $request->gambar != '' ? $image_name : $user->foto;
        $user->save();
        
        // Redirect
        return redirect('/profil')->with(['message' => 'Berhasil mengupdate foto profil.']);
    }

    /**
     * Menampilkan form update password
     *
     * @return \Illuminate\Http\Response
     */
    public function update_password_form()
    {
        if(Auth::check()){
        	// Data user
        	$user = User::find(Auth::user()->id_user);

            if(!$user){
                abort(404);
            }

            // View
            return view('front/user/update-password', [
            	'user' => $user,
            ]);
        }
        else{
            // Redirect Login
            session()->put('url.intended', url()->to('/ganti-password'));
            return redirect('/ganti-password');
        }
    }

    /**
     * Mengupdate password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error
        else{
            // Data user
            $user = User::find(Auth::user()->id_user);

            // Hash password
            $old_password = $user->password;
            $new_password = bcrypt($request->new_password);

            // Cek password lama, untuk alasan keamanan
            $check = Hash::check($request->old_password, $user->password);

            // Jika password lama yang diinputkan cocok dengan password saat ini
            if($check){
                // Mengupdate password baru
                $user->password = $new_password;
                $user->save();

                // Menyimpan update password ke record
                $update_password = new UpdatePassword;
                $update_password->id_user = Auth::user()->id_user;
                $update_password->old_password = $old_password;
                $update_password->new_password = $new_password;
                $update_password->up_at = date('Y-m-d H:i:s');
                $update_password->save();

                // Redirect
                return redirect('/ganti-password')->with(['message' => 'Berhasil mengupdate password.', 'status' => 1]);
            }
            // Jika password lama yang diinputkan TIDAK cocok dengan password saat ini
            else{
                // Redirect
                return redirect('/ganti-password')->with(['message' => 'Password lama yang diinput tidak cocok dengan password yang dimiliki saat ini.', 'status' => 0]);
            }
        }

    }

    /**
     * Menampilkan form edit user
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager()){
        	// Data user
        	$user = user::find($id);

            if(!$user){
                abort(404);
            }

            // View
            return view('admin/user/edit', [
            	'user' => $user,
            ]);
        }
        else{
            // View
            return view('error/403');
        }
    }

    /**
     * Mengupdate user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|max:200',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => [
                'required', 'string', 'email', 'max:200', Rule::unique('users')->ignore($request->id, 'id_user')
            ],
            'nomor_hp' => 'required|numeric',
            'username' => [
                'required', 'string', 'max:200', Rule::unique('users')->ignore($request->id, 'id_user')
            ],
            'password' => $request->password != '' ? 'required|min:6' : '',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'nama_user',
                'tanggal_lahir',
                'jenis_kelamin',
                'username',
                'email',
                'nomor_hp',
            ]));
        }
        // Jika tidak ada error
        else{
			// Upload gambar
            $image_name = $request->gambar != '' ? upload_file($request->gambar, "assets/images/user/") : '';

            // Mengupdate data
            $user = User::find($request->id);
            $user->nama_user = $request->nama_user;
            $user->tanggal_lahir = generate_date_format($request->tanggal_lahir, '-');
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->email = $request->email;
            $user->nomor_hp = $request->nomor_hp;
            $user->username = $request->username;
            $user->password = $request->password != '' ? bcrypt($request->password) : $user->password;
            $user->foto = $request->gambar != '' ? $image_name : $user->foto;
            $user->save();
        }

        // Redirect
        return redirect('/admin/user')->with(['message' => 'Berhasil mengupdate data.']);
    }

    /**
     * Menghapus user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
    	// Menghapus data
        $user = User::where('role','!=',role_admin())->find($request->id);

        if(!$user){
            // Redirect
            return redirect('/admin/user')->with(['message' => 'Tidak diizinkan menghapus akun ini.']);
        }
        $user->delete();

        // Redirect
        return redirect('/admin/user')->with(['message' => 'Berhasil menghapus data.']);
    }
}
