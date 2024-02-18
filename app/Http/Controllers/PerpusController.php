<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;  
use Excel;

class PerpusController extends Controller
{
    public function index()
    {
        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        return view('perpus/home', $data);
    }

    public function edit($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        $data['users'] = $users;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        // passing data perpus yang didapat ke view edit_profil.blade.php
        return view('/perpus/edit_profil',$data);
    }

    public function update(Request $request, $id){
        DB::table('users')->where('id',$request->id)->update([
            'nama' => $request->nama
        ]);   

        $users = DB::table('users')->where('id',$id)->get();

        $data['kelas'] = $kelas;
        $data['users'] = $users;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        return view('/perpus/edit_profil',$data);
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

        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        return view('/perpus/edit_profil',$data);
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

        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        return view('/perpus/edit_profil',$data);
    }

    public function tanggungan($id){
        $tg_perpus = DB::table('m_siswa')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->where('m_siswa.th_lulus',$id)
            ->get();

        $data['th_lulus'] = $id;
        $data['tg_perpus'] = $tg_perpus;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        return view('/perpus/tanggungan',$data);
    }

    public function import($th_lulus)  
    {  
        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        $data['th_lulus'] = $th_lulus;

        return view('/perpus/import', $data);  
    }

    public function importExcel($th_lulus)  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    // $denda_str = preg_replace("/[^0-9]/", "", $value->nominal);
                    DB::table('m_siswa')
                        ->where('s_id',$value->id)
                        ->update(['tg_perpus' => $value->ketuntasan, 'denda_perpus' => $value->nominal, 'ket_perpus' => $value->keterangan]);

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
                return redirect()->route('tanggungan.perpus', $th_lulus);   
            }  
        }  
        return back(); 
    }

    public function edit_tg($th_lulus, $id)
    {
        $siswa = DB::table('m_siswa')
            ->where('s_id',$id)
            ->get();
        $data['siswa'] = $siswa;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;
        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        $data['th_lulus'] = $th_lulus;

        return view('/perpus/edit_tanggungan', $data);
    }

    public function update_tg(Request $request, $th_lulus, $s_id)
    {
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_perpus'    => $request->tg_perpus,
            'denda_perpus' => $request->denda_perpus,
            'ket_perpus'   => $request->ket_perpus
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

        return redirect()->route('tanggungan.perpus', $th_lulus);
    }

    public function acc($th_lulus, $s_id)
    {
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_perpus'        => "TUNTAS"
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
        
        return redirect()->route('tanggungan.perpus', $th_lulus);
    }  

    public function tanggungansiswa($id){
        $tg_perpus = DB::table('m_siswa')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->where('m_kelas.tingkat',$id)
            ->get();

        $data['tingkat'] = $id;
        $data['tg_perpus'] = $tg_perpus;
        $data['no'] = 1;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;

        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        return view('/perpus/siswa/tanggungan',$data);
    }

    public function edit_tg_siswa($tingkat, $id)
    {
        $siswa = DB::table('m_siswa')
            ->where('s_id',$id)
            ->get();
        $data['siswa'] = $siswa;

        $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
        $data['angkatan'] = $angkatan;
        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;
        $data['tingkat'] = $tingkat;

        return view('/perpus/siswa/edit_tanggungan', $data);
    }

    public function update_tg_siswa(Request $request, $tingkat, $s_id)
    {
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_perpus'    => $request->tg_perpus,
            'denda_perpus' => $request->denda_perpus,
            'ket_perpus'   => $request->ket_perpus
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

        return redirect()->route('tanggungan.perpus.siswa', $tingkat);
    }
}
