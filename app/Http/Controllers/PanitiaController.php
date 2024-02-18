<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TgSmt;
use File;

class PanitiaController extends Controller
{
    public function edit($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/panitia/edit_profil',['users' => $users]);
    }

    public function update(Request $request, $id){
        DB::table('users')->where('id',$request->id)->update([
            'nama' => $request->nama
        ]);   

        $users = DB::table('users')->where('id',$id)->get();
        return view('/panitia/edit_profil',['users' => $users]);
    }

    public function updatefoto(Request $request, $id){
        $this->validate($request, [
            'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);
 
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');
 
        $nama_file = time()."_".$file->getClientOriginalName();
 
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'profile';
        $file->move($tujuan_upload,$nama_file);
 
        DB::table('users')->where('id',$request->id)->update([
            'foto' => $nama_file
        ]);   

        $users = DB::table('users')->where('id',$id)->get();
        return view('/panitia/edit_profil',['users' => $users]);
    }

    public function updatepw(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        DB::table('users')->where('id',$request->id)->update([
            'password' => bcrypt($request->password)
        ]);   

        $users = DB::table('users')->where('id',$id)->get();
        return view('/panitia/edit_profil',['users' => $users]);
    }

    public function ceklist(){
        $th_ajar = DB::table('m_th_ajar')
              ->where('m_th_ajar.status', "AKTIF")
              ->get();
        foreach ($th_ajar as $ta) {
            $ta_id = $ta->ta_id;
        }
        $tg_smt = DB::table('tanggungan_smt')
            ->join('m_siswa', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->where('tanggungan_smt.ketuntasan',"TIDAK TUNTAS")
            ->where('tanggungan_smt.ta_id',$ta_id)
            ->get();

        $data['th_ajar'] = $th_ajar;
        $data['tg_smt'] = $tg_smt;
        return view('panitia/ceklistv2', $data);
    }

    function updateceklist(Request $request, $tg_id)
    {
        if($request->hasFile('file_paper')){ 
            $datalama = TgSmt::where('tg_id',$tg_id)->first();
            File::delete('bimbingan/'.$datalama->ket_ppr);

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file_paper');
     
            $nama_file = time()."_".$file->getClientOriginalName();
     
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'bimbingan';
            $file->move($tujuan_upload,$nama_file);
     
            DB::table('tanggungan_smt')->where('tg_id',$tg_id)->update([
                'ket_ppr' => $nama_file
            ]);
        }

        DB::table('tanggungan_smt')->where('tg_id',$tg_id)->update([
            'kartu_aksi' => $request->kartu_aksi,
            'osis' => $request->osis,
            'da' => $request->da,
            'pmr' => $request->pmr 
        ]);

        $tg_smt = DB::table('tanggungan_smt')
            ->where('tg_id',$tg_id)
            ->get();

        foreach ($tg_smt as $ts) {
            if (($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && (($ts->paper == "TUNTAS") or ($ts->paper == "BELUM")) && ($ts->kartu_aksi == "PUNYA") && ($ts->osis == "TUNTAS") && ($ts->da == "TUNTAS") && ($ts->pmr == "TUNTAS")) {
                DB::table('tanggungan_smt')->where('tg_id',$tg_id)->update([
                    'ketuntasan' => "TUNTAS" 
                ]);
            }
            else{
                DB::table('tanggungan_smt')->where('tg_id',$tg_id)->update([
                    'ketuntasan' => "TIDAK TUNTAS" 
                ]);
            }
        }

        return redirect()->route('ceklist.panitia');
    }
}
