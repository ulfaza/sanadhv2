<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;  
use Excel;

class PondokController extends Controller
{
    public function index()
    {
      $data['no'] = 1;
      $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
      $data['angkatan'] = $angkatan;
      
      return view('/admin/pondok/index', $data);
    }

    public function view($th_lulus){
        $tg_pondok = DB::table('m_siswa')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->where('m_siswa.th_lulus',$th_lulus)
            ->get();

        $data['th_lulus'] = $th_lulus;
        $data['tg_pondok'] = $tg_pondok;

        return view('admin/pondok/view',$data);
    }

    public function edit($th_lulus, $id)
    {
        $siswa = DB::table('m_siswa')
            ->where('s_id',$id)
            ->get();
        $data['siswa'] = $siswa;
        $data['th_lulus'] = $th_lulus;

        return view('admin/pondok/edit', $data);
    }

    public function update(Request $request, $th_lulus, $s_id)
    {
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_pondok'   => $request->tg_pondok,
            'nominal_pondok'   => $request->nominal_pondok,
            'ket_pondok'  => $request->ket_pondok
        ]);   

        $tg_ijazah = DB::table('m_siswa')
            ->where('s_id',$s_id)
            ->get();
        foreach ($tg_ijazah as $row) {
            if ($row->jenis_kel == "PUTRA") {
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
            else{
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
        }

        return redirect()->route('view.pondok', $th_lulus);
    }

    public function import($th_lulus)  
    {  
        $data['th_lulus'] = $th_lulus;

        return view('admin/pondok/import', $data);  
    }

    public function importExcel($th_lulus)  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    $nominal_str = preg_replace("/[^0-9]/", "", $value->nominal);
                    DB::table('m_siswa')
                        ->where('s_id',$value->id)
                        ->update(['tg_pondok' => $value->ketuntasan, 'nominal_pondok' => $nominal_str, 'ket_pondok' => $value->keterangan]);

                    $tg_ijazah = DB::table('m_siswa')
                        ->where('s_id',$value->id)
                        ->get();
                    foreach ($tg_ijazah as $row) {
                        if ($row->jenis_kel == "PUTRA") {
                            if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                                DB::table('m_siswa')->where('s_id',$value->id)->update([
                                    'ketuntasan_ijazah'        => "TUNTAS"
                                ]);
                            }
                            else{
                                DB::table('m_siswa')->where('s_id',$value->id)->update([
                                    'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                                ]);
                            }
                        }
                        else{
                            if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                                DB::table('m_siswa')->where('s_id',$value->id)->update([
                                    'ketuntasan_ijazah'        => "TUNTAS"
                                ]);
                            }
                            else{
                                DB::table('m_siswa')->where('s_id',$value->id)->update([
                                    'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                                ]);
                            }
                        }
                    }

                }  
                return redirect()->route('view.pondok', $th_lulus);   
            }  
        }  
        return back(); 
    }

    public function bukti($bukti)
    {
        return response()->download('/home/u1725879/public_html/pondok/'.$bukti);
    }

    public function acc($th_lulus, $s_id)
    {
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_pondok'        => "TUNTAS"
        ]);

        $tg_ijazah = DB::table('m_siswa')
            ->where('s_id',$s_id)
            ->get();
        foreach ($tg_ijazah as $row) {
            if ($row->jenis_kel == "PUTRA") {
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
            else{
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
        }
        
        return redirect()->route('view.pondok', $th_lulus);
    } 

    public function home()
    {
        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;
        return view('pondok/home', $data);
    } 

    public function profil($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        $data['users'] = $users;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        // passing data keamanan yang didapat ke view edit_profil.blade.php
        return view('/pondok/edit_profil',$data);
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

        $data['users'] = $users;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        return view('/pondok/edit_profil',$data);
    }

    public function updatepw(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        DB::table('users')->where('id',$request->id)->update([
            'password' => bcrypt($request->password)
        ]);   

        $users = DB::table('users')->where('id',$id)->get();

        $data['users'] = $users;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        return view('pondok/edit_profil',$data);
    }

    public function tanggungan($id){
        $tg_pondok = DB::table('m_siswa')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->where('m_siswa.th_lulus',$id)
            ->where('m_siswa.jenis_kel',"PUTRA")
            ->get();

        $data['th_lulus'] = $id;
        $data['tg_pondok'] = $tg_pondok;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        return view('/pondok/tanggungan',$data);
    }

    public function ijazah(Request $request, $th_lulus, $s_id)
    {
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_pondok'   => $request->tg_pondok,
            'nominal_pondok'   => $request->nominal_pondok,
            'ket_pondok'   => $request->ket_pondok
        ]);   

        $tg_ijazah = DB::table('m_siswa')
            ->where('s_id',$s_id)
            ->get();
        foreach ($tg_ijazah as $row) {
            if ($row->jenis_kel == "PUTRA") {
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
            else{
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
        }

        return redirect()->route('tanggungan.pondok', $th_lulus);
    }

    public function accpondok($th_lulus, $s_id)
    {
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_pondok'        => "TUNTAS"
        ]);
        $tg_ijazah = DB::table('m_siswa')
            ->where('s_id',$s_id)
            ->get();
        foreach ($tg_ijazah as $row) {
            if ($row->jenis_kel == "PUTRA") {
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
            else{
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
        }
        return redirect()->route('tanggungan.pondok', $th_lulus);
    }
}
