<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class PanPaperController extends Controller
{
    public function edit($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        return view('/paper/edit_profil',['users' => $users]);
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
        return view('/paper/edit_profil',['users' => $users]);
    }

    public function updatepw(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        DB::table('users')->where('id',$request->id)->update([
            'password' => bcrypt($request->password)
        ]);   

        $users = DB::table('users')->where('id',$id)->get();
        return view('/paper/edit_profil',['users' => $users]);
    }
}
