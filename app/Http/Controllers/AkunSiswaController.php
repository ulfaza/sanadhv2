<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Siswa;
use File;

class AkunSiswaController extends Controller
{
    public function edit($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        $data['users'] = $users;

        // passing data perpus yang didapat ke view edit_profil.blade.php
        return view('/siswa/edit_profil',$data);
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
        return view('/siswa/edit_profil',['users' => $users]);
    }

    public function updatepw(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        DB::table('users')->where('id',$request->id)->update([
            'password' => bcrypt($request->password)
        ]);   

        $users = DB::table('users')->where('id',$id)->get();
        return view('/siswa/edit_profil',['users' => $users]);
    }

    public function ijazah($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')
        	->select('username')
        	->where('id',$id)
        	->get();

        foreach ($users as $u) {
        	$username = $u->username;
        }

        $siswa = DB::table('m_siswa')
        	->where('nis',$username)
        	->get();

        $data['siswa'] = $siswa;

        return view('/siswa/tg_ijazah',$data);
    }

    public function updatetg(Request $request, $id){
    	if($request->hasFile('file_perpus')){ 
            $datalama = Siswa::where('s_id',$id)->first();
            File::delete('perpus/'.$datalama->bukti_perpus);

    		// menyimpan data file yang diupload ke variabel $file
	        $file = $request->file('file_perpus');
	 
	        $nama_file = time()."_".$file->getClientOriginalName();
	 
	        // isi dengan nama folder tempat kemana file diupload
	        $tujuan_upload = 'perpus';
	        $file->move($tujuan_upload,$nama_file);
	 
	        DB::table('m_siswa')->where('s_id',$id)->update([
	            'bukti_perpus' => $nama_file
	        ]);
    	}
           
    	if($request->hasFile('file_pondok')){ 
            $datalama = Siswa::where('s_id',$id)->first();
            File::delete('pondok/'.$datalama->bukti_pondok);

    		// menyimpan data file yang diupload ke variabel $file
	        $file = $request->file('file_pondok');
	 
	        $nama_file = time()."_".$file->getClientOriginalName();
	 
	        // isi dengan nama folder tempat kemana file diupload
	        $tujuan_upload = 'pondok';
	        $file->move($tujuan_upload,$nama_file);
	 
	        DB::table('m_siswa')->where('s_id',$id)->update([
	            'bukti_pondok' => $nama_file
	        ]);
    	}

        if($request->hasFile('file_keamanan')){ 
            $datalama = Siswa::where('s_id',$id)->first();
            File::delete('keamanan/'.$datalama->bukti_aman_pa);

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file_keamanan');
     
            $nama_file = time()."_".$file->getClientOriginalName();
     
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'keamanan';
            $file->move($tujuan_upload,$nama_file);
     
            DB::table('m_siswa')->where('s_id',$id)->update([
                'bukti_aman_pa' => $nama_file
            ]);
        }

    	$siswa = DB::table('m_siswa')
        	->where('s_id',$id)
        	->get();

        $data['siswa'] = $siswa;

        // passing data perpus yang didapat ke view edit_profil.blade.php
        return redirect()->back();
    }

    public function download()
    {
        //PDF file is stored under project/public/SURAT_PERNYATAAN_KHUSUS_PUTRI.pdf
        $file= base_path(). "/SURAT_PERNYATAAN_KHUSUS_PUTRI.pdf";

        return response()->download($file);
    }
}
