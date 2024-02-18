<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;  
use Excel;
use App\User;

class UserController extends Controller
{
    public function guru(){
        $data['no'] = 1;
        $guru = DB::table('users')
        	->where('role', "guru")
        	->get();
        $data['guru'] = $guru;
        return view('/admin/pengguna/guru/index',$data);
    }

    public function siswa(){
        $data['no'] = 1;
        $siswa = DB::table('users')
            ->where('role', "siswa")
            ->get();
        $data['siswa'] = $siswa;
        return view('/admin/pengguna/siswa/index',$data);
    }

    public function insert()
    {
        return view('/admin/pengguna/guru/insert');
    }

    public function add()
    {
        return view('admin.pengguna.siswa.tambah');
    }

    public function store(Request $request)
    {
      $guru = new User;
      $guru->nama     	= $request->nama;
      $guru->username  	= $request->username;
      $guru->foto     	= "avatar.jpg";
      $guru->role     	= "guru";
      $guru->password   = bcrypt($request->password);

      if ($guru->save()){
        return redirect('/admin/daftar/guru');
      }
      else{
        return redirect('/admin/tambah/guru');
      }
    }

    public function simpanakunsiswa(Request $request)
    {
      $siswa = new User;
      $siswa->nama       = $request->nama;
      $siswa->username   = $request->username;
      $siswa->foto       = "avatar.jpg";
      $siswa->role       = "siswa";
      $siswa->password   = bcrypt($request->password);

      if ($siswa->save()){
        return redirect('/admin/siswa');
      }
      else{
        return redirect('/admin/add/akun/siswa');
      }
    }

    public function edit($id)
    {
        $guru = DB::table('users')
        	->where('id',$id)
        	->get();
        $data['guru'] = $guru;
        return view('/admin/pengguna/guru/edit',$data);
    }

    public function sunting($id)
    {
        $siswa = DB::table('users')
            ->where('id',$id)
            ->get();
        $data['siswa'] = $siswa;
        return view('/admin/pengguna/siswa/edit',$data);
    }

    public function update(Request $request, $id){
        DB::table('users')->where('id',$id)->update([
            'nama'      => $request->nama,
            'username'  => $request->username
        ]);           
      	return redirect()->route('list.guru');
    }

    public function ubah(Request $request, $id){
        DB::table('users')->where('id',$id)->update([
            'nama'      => $request->nama,
            'username'  => $request->username
        ]);           
        return redirect()->route('list.siswa');
    }

    public function delete($id){
        $guru = User::findOrFail($id)->delete();
        return redirect()->route('list.guru');
    }

    public function hapus($id){
        $siswa = User::findOrFail($id)->delete();
        return redirect()->route('list.siswa');
    }

    public function import()  
    {  
        return view('/admin/pengguna/guru/import');  
    }

    public function importsiswa()  
    {  
        return view('/admin/pengguna/siswa/import');  
    }

    public function importExcel()  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    $insert[] = [
                    	'nama' => $value->nama, 
                    	'username' => $value->username, 
                    	'foto' => "avatar.jpg",
                    	'role' => "guru",
                    	'password' => bcrypt($value->password)
                    ];  
                }  
                if(!empty($insert)){  
                    DB::table('users')->insert($insert);  
                    return redirect()->route('list.guru');  
                }  
            }  
        }  
        return back();  
    }

    public function importExcelsiswa()  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    $insert[] = [
                        'nama' => $value->nama, 
                        'username' => $value->username, 
                        'foto' => "avatar.jpg",
                        'role' => "siswa",
                        'password' => bcrypt($value->password)
                    ];  
                }  
                if(!empty($insert)){  
                    DB::table('users')->insert($insert);  
                    return redirect()->route('list.siswa');  
                }  
            }  
        }  
        return back();  
    }
}
