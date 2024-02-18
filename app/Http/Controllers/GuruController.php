<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use App\Kelas;
use App\Siswa;
use App\Kh;
use App\ThAjar;
use App\UjiKh;
use App\RekapKh;
use App\TgSmt;
use App\Paper;
use App\UjiPaper;
use Input;  
use Excel;
use File;
use PDF;

class GuruController extends Controller
{
    public function index(){
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
            
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();

        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $data['ujipaper'] = $ujipaper;
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        return view('guru/home', $data);
    }

    public function edit($id)
    {
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        $data['users'] = $users;
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/guru/edit_profil',$data);
    }

    public function update(Request $request, $id){
        DB::table('users')->where('id',$request->id)->update([
            'nama' => $request->nama
        ]);   

        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        $data['users'] = $users;
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/guru/edit_profil',$data);
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

        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        $data['users'] = $users;
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/guru/edit_profil',$data);
    }

    public function updatepw(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        DB::table('users')->where('id',$request->id)->update([
            'password' => bcrypt($request->password)
        ]);   

        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        $data['users'] = $users;
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/guru/edit_profil',$data);
    }

    public function kelas($k_id){
        $kelas = DB::table('m_kelas')
              ->where('k_id',$k_id)
              ->get();
        $th_ajar = DB::table('m_th_ajar')
              ->where('m_th_ajar.status', "AKTIF")
              ->get();
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        $data['kelas'] = $kelas;
        $data['k_id'] = $k_id;
        $data['th_ajar'] = $th_ajar;

        return view('/guru/wali/index',$data);
    }

    public function rekap_kelas($k_id){
        $th_ajar = DB::table('m_th_ajar')
              ->where('m_th_ajar.status', "AKTIF")
              ->get();
        foreach ($th_ajar as $ta) {
            $id_th_ajar = $ta->ta_id;
        }
        $kelas = DB::table('m_kelas')
              ->where('k_id',$k_id)
              ->get();
        $kh = DB::table('uji_kh')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.ta_id',$id_th_ajar)
            ->where('uji_kh.k_id',$k_id)
            ->select('m_kh.kh_nama')
            ->get();
        $siswa = DB::table('m_siswa')
            ->where('k_id', $k_id)
            ->where('status', '!=', "BOYONG")
            ->select('s_nama', 'nis', 'status')
            ->get();
        $rekapkh = DB::table('rekap_kh')
            ->join('uji_kh', 'uji_kh.uji_id', '=', 'rekap_kh.uji_id')
            ->join('m_siswa', 'm_siswa.s_id', '=', 'rekap_kh.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.ta_id',$id_th_ajar)
            ->where('uji_kh.k_id',$k_id)
            ->select('m_kh.kh_nama', 'm_siswa.s_nama', 'rekap_kh.total', 'rekap_kh.kriteria')
            ->get();
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();    
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        $data['no'] = 1;
        $data['th_ajar'] = $th_ajar;
        $data['kelas'] = $kelas;
        $data['kh'] = $kh;
        $data['siswa'] = $siswa;
        $data['rekapkh'] = $rekapkh;

        return view('/guru/wali/rekap_kh',$data);
    }

    public function rekap_paper($k_id){
        $kelas = DB::table('m_kelas')
              ->where('k_id',$k_id)
              ->get();
        $rekap = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->where('m_kelas.k_id', $k_id)
            ->get();
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();    
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        $data['no'] = 1;
        $data['kelas'] = $kelas;
        $data['rekap'] = $rekap;

        return view('/guru/wali/rekap_paper',$data);
    }

    public function rekap($uji_id)
    {
        $kh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();

        foreach ($kh as $khs) {
            $aspek1 = $khs->aspek1;
            $aspek2 = $khs->aspek2;
            $aspek3 = $khs->aspek3;
            $aspek4 = $khs->aspek4;
            $max_a1 = $khs->max_a1;
            $max_a2 = $khs->max_a2;
            $max_a3 = $khs->max_a3;
            $max_a4 = $khs->max_a4;
        }

        $cek = DB::table('uji_kh')
            ->where('uji_id',$uji_id)
            ->get();

        foreach ($cek as $c) {
            if ($c->penguji == Auth::user()->nama) {
                $rekapkh = DB::table('rekap_kh')
                    ->join('m_siswa', 'm_siswa.s_id', '=', 'rekap_kh.s_id')
                    ->where('rekap_kh.uji_id',$uji_id)
                    ->get();
            }
        }

        $ujikh = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();

        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();

        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();

        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['ujikh'] = $ujikh;
        $data['kh'] = $kh;
        $data['uji_id'] = $uji_id;
        $data['aspek1'] = $aspek1;
        $data['aspek2'] = $aspek2;
        $data['aspek3'] = $aspek3;
        $data['aspek4'] = $aspek4;
        $data['max_a1'] = $max_a1;
        $data['max_a2'] = $max_a2;
        $data['max_a3'] = $max_a3;
        $data['max_a4'] = $max_a4;
        $data['rekapkh'] = $rekapkh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        return view('/guru/rekapkh/index', $data);
    }

    function updatenilai(Request $request, $r_id, $uji_id)
    {
        $kh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();

        foreach ($kh as $khs) {
            $kkm = $khs->kkm;
            $ta_id = $khs->ta_id;
        }

        if ($request->nilai_a1 + $request->nilai_a2 + $request->nilai_a3 + $request->nilai_a4 >= $kkm) {
            $kriteria = "TUNTAS";
        }
        else{
            $kriteria = "TIDAK TUNTAS";
        }

        DB::table('rekap_kh')->where('r_id',$r_id)->update([
            'nilai_a1' => $request->nilai_a1,
            'nilai_a2' => $request->nilai_a2,
            'nilai_a3' => $request->nilai_a3,
            'nilai_a4' => $request->nilai_a4,
            'total'    => $request->nilai_a1 + $request->nilai_a2 + $request->nilai_a3 + $request->nilai_a4,
            'kriteria' => $kriteria,
            'nama_penguji'  =>  Auth::user()->nama
        ]);

        $rekapkh = DB::table('rekap_kh')
            ->where('r_id',$r_id)
            ->get();     

        foreach ($rekapkh as $r) {
            $s_id = $r->s_id;
        }

        $tg_kh = DB::table('rekap_kh')
            ->join('m_siswa', 'm_siswa.s_id', '=', 'rekap_kh.s_id')
            ->join('uji_kh', 'uji_kh.uji_id', '=', 'rekap_kh.uji_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('rekap_kh.s_id',$s_id)
            ->where('uji_kh.ta_id',$ta_id)
            ->select('m_kh.kh_nama', 'rekap_kh.kriteria')
            ->get();
        $sum = 0;
        $ket = "";
        foreach ($tg_kh as $tk) {
            if ($tk->kriteria == "TUNTAS") {
                $sum += 1;
            }
            else if ($tk->kriteria != "TUNTAS") {
                $ket = $ket . '- ' . $tk->kh_nama.' ';
            }
        }
        if ($sum == 4) {
            DB::table('tanggungan_smt')
                ->where('ta_id',$ta_id)
                ->where('s_id',$s_id)
                ->update(['k_hijau' => "TUNTAS", 'ket_k_h' => ""]);
        } 
        else {
            DB::table('tanggungan_smt')
                ->where('ta_id',$ta_id)
                ->where('s_id',$s_id)
                ->update(['ket_k_h' => $ket]);
        }

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->where('tanggungan_smt.ta_id',$ta_id)
            ->where('tanggungan_smt.s_id',$s_id)
            ->get();

        foreach ($tg_smt as $ts) {
            if ($ts->tingkat == "12") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && (($ts->status_paper == "SUDAH UJIAN") or ($ts->status_paper == "SETOR BERKAS")) && ($ts->kartu_aksi == "PUNYA") ) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
            
            elseif ($ts->tingkat == "11") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ( (Str::contains($ts->status_paper, 'BAB 2')) or (Str::contains($ts->status_paper, 'BAB 3')) or (Str::contains($ts->status_paper, 'BAB 4')) or (Str::contains($ts->status_paper, 'SIAP UJIAN')) or (Str::contains($ts->status_paper, 'DAFTAR UJIAN')) or (Str::contains($ts->status_paper, 'SUDAH UJIAN')) or (Str::contains($ts->status_paper, 'SETOR BERKAS')) ) && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }

            elseif ($ts->tingkat == "10") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
        }

        return redirect()->route('rekap.guru', $uji_id);
    }

    public function downloadkh($uji_id)
    {
        $kh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();

        foreach ($kh as $khs) {
            $aspek1 = $khs->aspek1;
            $aspek2 = $khs->aspek2;
            $aspek3 = $khs->aspek3;
            $aspek4 = $khs->aspek4;
            $max_a1 = $khs->max_a1;
            $max_a2 = $khs->max_a2;
            $max_a3 = $khs->max_a3;
            $max_a4 = $khs->max_a4;
        }

        $cek = DB::table('uji_kh')
            ->where('uji_id',$uji_id)
            ->get();

        foreach ($cek as $c) {
            if ($c->penguji == Auth::user()->nama) {
                $rekapkh = DB::table('rekap_kh')
                    ->join('m_siswa', 'm_siswa.s_id', '=', 'rekap_kh.s_id')
                    ->where('rekap_kh.uji_id',$uji_id)
                    ->get();
            }
        }

        $ujikh = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();

        $data['no'] = 1;
        $data['ujikh'] = $ujikh;
        $data['kh'] = $kh;
        $data['uji_id'] = $uji_id;
        $data['aspek1'] = $aspek1;
        $data['aspek2'] = $aspek2;
        $data['aspek3'] = $aspek3;
        $data['aspek4'] = $aspek4;
        $data['max_a1'] = $max_a1;
        $data['max_a2'] = $max_a2;
        $data['max_a3'] = $max_a3;
        $data['max_a4'] = $max_a4;
        $data['rekapkh'] = $rekapkh;

        // Generate the PDF from a view
        $pdf = PDF::loadView('guru.rekapkh.download', $data);

        $pdf->setPaper('A4', 'portrait');
        // Download the PDF
        foreach ($ujikh as $u) {
            return $pdf->download(implode(' ', [$u->tingkat, $u->k_nama, Auth::user()->nama]).'.pdf');
        }
    }

    public function ceklist($k_id){
        $kelas = DB::table('m_kelas')
              ->where('k_id',$k_id)
              ->get();
        $th_ajar = DB::table('m_th_ajar')
              ->where('m_th_ajar.status', "AKTIF")
              ->get();
        foreach ($th_ajar as $ta) {
            $id_th_ajar = $ta->ta_id;
        }
        $siswa = DB::table('m_siswa')
            ->where('k_id', $k_id)
            ->where('status', '!=', "BOYONG")
            ->get();

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->where('m_kelas.k_id',$k_id)
            ->where('tanggungan_smt.ta_id', $id_th_ajar)
            ->get();

        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;

        $data['kelas'] = $kelas;
        $data['k_id'] = $k_id;
        $data['th_ajar'] = $th_ajar;
        $data['siswa'] = $siswa;
        $data['tg_smt'] = $tg_smt;

        return view('guru/wali/ceklist', $data);
    }

    public function ceklistrapor($k_id){
        $kelas = DB::table('m_kelas')
              ->where('k_id',$k_id)
              ->get();
        $th_ajar = DB::table('m_th_ajar')
              ->where('m_th_ajar.status', "AKTIF")
              ->get();
        foreach ($th_ajar as $ta) {
            $id_th_ajar = $ta->ta_id;
        }
        $siswa = DB::table('m_siswa')
            ->where('k_id', $k_id)
            ->where('status', '!=', "BOYONG")
            ->get();

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->where('m_kelas.k_id',$k_id)
            ->where('tanggungan_smt.ta_id', $id_th_ajar)
            ->get();

        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;

        $data['kelas'] = $kelas;
        $data['k_id'] = $k_id;
        $data['th_ajar'] = $th_ajar;
        $data['siswa'] = $siswa;
        $data['tg_smt'] = $tg_smt;

        return view('guru/wali/ceklist_rapor', $data);
    }

    function updateceklist(Request $request, $tg_id, $k_id)
    {
        if($request->hasFile('file_keu')){ 
            $datalama = TgSmt::where('tg_id',$tg_id)->first();
            File::delete('keuangan/'.$datalama->bukti_keu);
            
            $file = $request->file('file_keu');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'keuangan';
            $file->move($tujuan_upload,$nama_file);
     
            DB::table('tanggungan_smt')->where('tg_id',$tg_id)->update([
                'bukti_keu' => $nama_file
            ]);
        }

        DB::table('tanggungan_smt')->where('tg_id',$tg_id)->update([
            'ket_keu' => $request->ket_keu,
            'kartu_aksi' => $request->kartu_aksi,
            'osis' => $request->osis,
            'da' => $request->da,
            'pmr' => $request->pmr
        ]);

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->where('tg_id',$tg_id)
            ->get();

        foreach ($tg_smt as $ts) {
            if ($ts->tingkat == "12") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && (($ts->status_paper == "SUDAH UJIAN") or ($ts->status_paper == "SETOR BERKAS")) && ($ts->kartu_aksi == "PUNYA") ) {
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
            
            elseif ($ts->tingkat == "11") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ( (Str::contains($ts->status_paper, 'BAB 2')) or (Str::contains($ts->status_paper, 'BAB 3')) or (Str::contains($ts->status_paper, 'BAB 4')) or (Str::contains($ts->status_paper, 'SIAP UJIAN')) or (Str::contains($ts->status_paper, 'DAFTAR UJIAN')) or (Str::contains($ts->status_paper, 'SUDAH UJIAN')) or (Str::contains($ts->status_paper, 'SETOR BERKAS')) ) && ($ts->kartu_aksi == "PUNYA")) {
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

            elseif ($ts->tingkat == "10") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ($ts->kartu_aksi == "PUNYA")) {
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
        }

        return redirect()->route('ceklist.kelas', $k_id);
    }

    function updateceklistrapor(Request $request, $tg_id, $k_id)
    {
        DB::table('tanggungan_smt')->where('tg_id',$tg_id)->update([
            'status_rapor' => $request->status_rapor,
            'ket_rapor' => $request->ket_rapor
        ]);

        return redirect()->route('ceklist.rapor', $k_id);
    }

    public function dzikrul($k_id){
        $kelas = DB::table('m_kelas')
              ->where('k_id',$k_id)
              ->get();
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $ujipaper = NULL;
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $siswa = DB::table('m_siswa')
            ->where('k_id', $k_id)
            ->get();
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        $data['kelas'] = $kelas;
        $data['siswa'] = $siswa;

        return view('/guru/dzikrul/index',$data);
    }

    function updatedzikrul(Request $request, $k_id, $s_id)
    {
        if ($request->nilai_dzikrul >= 70) {
            $kriteria = "TUNTAS";
        }
        else{
            $kriteria = "TIDAK TUNTAS";   
        }
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_dzikrul'    => $kriteria,
            'nilai_dzikrul' => $request->nilai_dzikrul,
            'real_dzikrul'  =>  Auth::user()->nama
        ]);

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
            ->where('m_siswa.s_id',$s_id)
            ->where('m_th_ajar.status',"AKTIF")
            ->get();

        foreach ($tg_smt as $ts) {
            if ($ts->tingkat == "12") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && (($ts->status_paper == "SUDAH UJIAN") or ($ts->status_paper == "SETOR BERKAS")) && ($ts->kartu_aksi == "PUNYA") ) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
            
            elseif ($ts->tingkat == "11") {
                 if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ( (Str::contains($ts->status_paper, 'BAB 2')) or (Str::contains($ts->status_paper, 'BAB 3')) or (Str::contains($ts->status_paper, 'BAB 4')) or (Str::contains($ts->status_paper, 'SIAP UJIAN')) or (Str::contains($ts->status_paper, 'DAFTAR UJIAN')) or (Str::contains($ts->status_paper, 'SUDAH UJIAN')) or (Str::contains($ts->status_paper, 'SETOR BERKAS')) ) && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }

            elseif ($ts->tingkat == "10") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
        }

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

        return redirect()->route('dzikrul.guru', $k_id);
    }

    public function asesor($k_id){
        $kelas = DB::table('m_kelas')
              ->where('k_id',$k_id)
              ->get();
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();
        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        $ujipaper = NULL;
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        
        $siswa = Siswa::where('k_id', $k_id)
               ->get();

        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        $data['kelas'] = $kelas;
        $data['siswa'] = $siswa;

        return view('/guru/asesor/index',$data);
    }

    function updateasesor(Request $request, $k_id, $s_id)
    {
        DB::table('paper')->where('siswa_s_id',$s_id)->update([
            'judul'    => $request->judul,
            'status_acc' => "ACC",
            'status_paper' => "ACC"
        ]);

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
            ->where('m_siswa.s_id',$s_id)
            ->where('m_th_ajar.status',"AKTIF")
            ->get();

        foreach ($tg_smt as $ts) {
            if ($ts->tingkat == "12") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && (($ts->status_paper == "SUDAH UJIAN") or ($ts->status_paper == "SETOR BERKAS")) && ($ts->kartu_aksi == "PUNYA") ) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
            
            elseif ($ts->tingkat == "11") {
                 if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ( (Str::contains($ts->status_paper, 'BAB 2')) or (Str::contains($ts->status_paper, 'BAB 3')) or (Str::contains($ts->status_paper, 'BAB 4')) or (Str::contains($ts->status_paper, 'SIAP UJIAN')) or (Str::contains($ts->status_paper, 'DAFTAR UJIAN')) or (Str::contains($ts->status_paper, 'SUDAH UJIAN')) or (Str::contains($ts->status_paper, 'SETOR BERKAS')) ) && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }

            elseif ($ts->tingkat == "10") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
        }

        return redirect()->route('asesor.guru', $k_id);
    }

    public function paper(){
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
            
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();

        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();

        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        $ujipaper = NULL;
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        return view('guru/paper/ujian', $data);
    }

    function updatepaper(Request $request, $p_id)
    {
        if ($request->penguasaan + $request->sinkron + $request->penulisan + $request->adab >= 80) {
            $predikat = "A";
        }
        else if(($request->penguasaan + $request->sinkron + $request->penulisan + $request->adab >= 60) && ($request->penguasaan + $request->sinkron + $request->penulisan + $request->adab < 80)){
            $predikat = "B";
        }
        else if(($request->penguasaan + $request->sinkron + $request->penulisan + $request->adab >= 41) && ($request->penguasaan + $request->sinkron + $request->penulisan + $request->adab < 60)){
            $predikat = "C";
        }
        else{
            $predikat = "D";
        }
        DB::table('paper')->where('p_id',$p_id)->update([
            'penguasaan'    => $request->penguasaan,
            'sinkron'       => $request->sinkron,
            'penulisan'     => $request->penulisan,
            'adab'          => $request->adab,
            'nilai'         => $request->penguasaan + $request->sinkron + $request->penulisan + $request->adab,
            'predikat'      => $predikat,
            'status_paper'  => "SUDAH UJIAN"
        ]);

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
            ->where('paper.p_id',$p_id)
            ->where('m_th_ajar.status',"AKTIF")
            ->get();

        foreach ($tg_smt as $ts) {
            if ($ts->tingkat == "12") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && (($ts->status_paper == "SUDAH UJIAN") or ($ts->status_paper == "SETOR BERKAS")) && ($ts->kartu_aksi == "PUNYA") ) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
            
            elseif ($ts->tingkat == "11") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ( (Str::contains($ts->status_paper, 'BAB 2')) or (Str::contains($ts->status_paper, 'BAB 3')) or (Str::contains($ts->status_paper, 'BAB 4')) or (Str::contains($ts->status_paper, 'SIAP UJIAN')) or (Str::contains($ts->status_paper, 'DAFTAR UJIAN')) or (Str::contains($ts->status_paper, 'SUDAH UJIAN')) or (Str::contains($ts->status_paper, 'SETOR BERKAS')) ) && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }

            elseif ($ts->tingkat == "10") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
        }

        return redirect()->route('paper.guru');
    }

    public function pembimbing(){
        $datauji = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();   
        $walikelas = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('users.nama', Auth::user()->nama)
            ->get();
            
        $namakh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->select('m_kh.kh_nama')->distinct()
            ->get();

        $ujidzikrul = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.penguji_dzikrul', Auth::user()->nama)
            ->get();
        $asesor = DB::table('m_kelas')
            ->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.asesor', Auth::user()->nama)
            ->get();
        $aktif = UjiPaper::where("status_ujian", "AKTIF")
            ->get();
        $ujipaper = NULL;
        foreach ($aktif as $row) {
            $ujipaper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                        ->where("penguji1", Auth::user()->nama)
                        ->orWhere("penguji2", Auth::user()->nama)
                        ->where("tgl_ujian", $row->tgl)
                        ->get();
            $data['ujipaper'] = $ujipaper;
        }
        $pembimbing = Paper::where("pembimbing", Auth::user()->nama)
                        ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
                        ->where('m_kelas.tingkat', '!=', "alumni")
                        ->get();

        $data['pembimbing'] = $pembimbing;
        
        $data['asesor'] = $asesor;
        $data['ujidzikrul'] = $ujidzikrul;
        $data['namakh'] = $namakh;
        $data['datauji'] = $datauji;
        $data['walikelas'] = $walikelas;
        return view('guru/pembimbing/index', $data);
    }

    function updatebimbingan(Request $request, $p_id)
    {
        if (isset($request->status_paper)) {
            DB::table('paper')->where('p_id',$p_id)->update([
                'judul'    => $request->judul,
                'status_paper' => $request->status_paper
            ]);
            return redirect()->route('pembimbing.guru');
        }
        $progress = Input::get('progress', []);
        DB::table('paper')->where('p_id',$p_id)->update([
            'judul'    => $request->judul,
            'status_paper' => implode(', ', $progress)
        ]);

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
            ->where('paper.p_id',$p_id)
            ->where('m_th_ajar.status',"AKTIF")
            ->get();

        foreach ($tg_smt as $ts) {
            if ($ts->tingkat == "12") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && (($ts->status_paper == "SUDAH UJIAN") or ($ts->status_paper == "SETOR BERKAS")) && ($ts->kartu_aksi == "PUNYA") ) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
            
            elseif ($ts->tingkat == "11") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ( (Str::contains($ts->status_paper, 'BAB 2')) or (Str::contains($ts->status_paper, 'BAB 3')) or (Str::contains($ts->status_paper, 'BAB 4')) or (Str::contains($ts->status_paper, 'SIAP UJIAN')) or (Str::contains($ts->status_paper, 'DAFTAR UJIAN')) or (Str::contains($ts->status_paper, 'SUDAH UJIAN')) or (Str::contains($ts->status_paper, 'SETOR BERKAS')) ) && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }

            elseif ($ts->tingkat == "10") {
                if (($ts->bp == "TUNTAS") && ($ts->keuangan == "TUNTAS") && ($ts->k_hijau == "TUNTAS") && ($ts->kartu_aksi == "PUNYA")) {
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TUNTAS" 
                    ]);
                }
                else{
                    DB::table('tanggungan_smt')->where('tg_id',$ts->tg_id)->update([
                        'ketuntasan' => "TIDAK TUNTAS" 
                    ]);
                }
            }
        }

        return redirect()->route('pembimbing.guru');
    }
}
