<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Artikel;
use App\Models\Fitur;
use App\Models\Testimoni;
use App\Models\User;
use App\Models\Website;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        // Count data user
        $count_user = User::where('role','=',role_member())->where('status','=',1)->count();

        // Count data website
        $count_website = Website::join('users','website.id_user','=','users.id_user')->where('users.status','=',1)->count();

        // Data website
        $website = Website::join('users','website.id_user','=','users.id_user')->where('users.status','=',1)->orderBy('website_at','desc')->limit(6)->get();

        // View
        return view('admin/dashboard/index', [
            'count_user' => $count_user,
            'count_website' => $count_website,
            'website' => $website,
        ]);
    }

    /**
     * Dashboard Member
     *
     * @return \Illuminate\Http\Response
     */
    public function member()
    {
        // Data website
        $website = Website::join('users','website.id_user','=','users.id_user')->where('website.id_user','=',Auth::user()->id_user)->where('users.status','=',1)->orderBy('website_at','desc')->get();

        // View
        return view('member/dashboard/index', [
            'website' => $website
        ]);
    }

    /**
     * Home Page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // Data fitur
        $fitur = Fitur::orderBy('order_fitur','asc')->get();

        // Data testimoni
        $testimoni = Testimoni::orderBy('order_testimoni','asc')->get();

        // Data artikel
        $artikel = Artikel::orderBy('artikel_at','desc')->limit(4)->get();

        // View
        return view('front/home', [
            'fitur' => $fitur,
            'testimoni' => $testimoni,
            'artikel' => $artikel,
        ]);
    }
}
