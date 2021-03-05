<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kategori;
use App\Kelas;
use App\Konten;
use App\Level;
use App\MemberKelas;
use App\Progress;
use App\Topik;
use App\User;

class TopikController extends Controller
{
    /**
     * Menambah data topik
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_topik(Request $request)
    {
        // Mengambil data topik terakhir
        $last_topik = Topik::where('id_kelas','=',$request->id_kelas)->latest('topik_order')->first();

        // Menyimpan data
        $topik = new Topik;
        $topik->id_kelas = $request->id_kelas;
        $topik->nama_topik = $request->nama_topik;
        $topik->topik_order = $last_topik->topik_order + 1;
        $topik->topik_at = date('Y-m-d H:i:s');
        $topik->save();

        // Redirect
        return redirect('/admin/kelas/detail/'.$request->id_kelas.'?tab=materi')->with(['message' => 'Berhasil menambah topik.']);
    }

    /**
     * Mengupdate data topik
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_topik(Request $request)
    {
        // Menyimpan data
        $topik = Topik::find($request->id_topik);
        $topik->nama_topik = $request->nama_topik;
        $topik->save();

        // Redirect
        return redirect('/admin/kelas/detail/'.$request->id_kelas.'?tab=materi')->with(['message' => 'Berhasil mengupdate topik.']);
    }

    /**
     * Menghapus topik
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_topik(Request $request)
    {
    	// Menghapus data
        $topik = Topik::find($request->id);
        $topik->delete();

        // Redirect
        return redirect('/admin/kelas/detail/'.$topik->id_kelas.'?tab=materi')->with(['message' => 'Berhasil menghapus topik.']);
    }

    /**
     * Mengurutkan topik
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sort_topik(Request $request)
    {
        // Mengurutkan topik
        foreach($request->get('ids') as $key=>$id){
            $topik = Topik::where('id_topik','=',$id)->where('id_kelas','=',$request->kelas)->first();
            if($topik){
                $topik->topik_order = $key + 1;
                $topik->save();
            }
        }
        echo 'Sukses mengupdate urutan topik!';
    }
}
