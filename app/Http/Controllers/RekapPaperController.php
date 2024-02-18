<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Input;  
use Excel;
use App\Kelas;

class RekapPaperController extends Controller
{
    public function index(){
        $data['no'] = 1;
      
        $tingkatan = DB::table('m_kelas')
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;

        return view('paper/rekap/index', $data);
    }

    public function view($tingkat)
    {
      $data['no'] = 1;

      $rekap = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->where('m_kelas.tingkat', $tingkat)
            ->get();

      $data['tingkat'] = $tingkat;
      $data['rekap'] = $rekap;

      return view('paper/rekap/view', $data);
    }

    public function import($tingkat)
    {
      $data['no'] = 1;
      $data['tingkat'] = $tingkat;

      return view('paper/rekap/import', $data);
    }

    public function importExcel($tingkat)  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    DB::table('paper')
                        ->where('p_id',$value->id)
                        ->update(['judul' => $value->judul,
                                'pembimbing' => $value->pembimbing,
                                'status_paper' => $value->status,
                                'penguji1' => $value->penguji1,
                                'penguji2' => $value->penguji2,
                                'nilai' => $value->nilai,
                                'predikat' => $value->predikat]);

                    $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
                        ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
                        ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
                        ->where('paper.p_id',$value->id)
                        ->where('m_th_ajar.status',"AKTIF")
                        ->get();

                    foreach ($tg_smt as $ts) {
                        // UBAH KETUNTASAN DI CEKLIST SEMESTER
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

                        // UBAH KETUNTASAN TANGGUNGAN PAPER UNTUK IJAZAH
                        if ($ts->status_paper == "SETOR BERKAS"){
                            DB::table('m_siswa')->where('s_id',$ts->s_id)->update([
                                'tg_paper' => "TUNTAS" 
                            ]);
                        }
                        else{
                            DB::table('m_siswa')->where('s_id',$ts->s_id)->update([
                                'tg_paper' => "TIDAK TUNTAS" 
                            ]);
                        }

                        $tg_ijazah = DB::table('m_siswa')
                            ->where('s_id',$ts->s_id)
                            ->get();
                        foreach ($tg_ijazah as $row) {
                            // UBAH KETUNTASAN TANGGUNGAN IJAZAH
                            if ($row->jenis_kel == "PUTRA") {
                                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS")) {
                                    DB::table('m_siswa')->where('s_id',$ts->s_id)->update([
                                        'ketuntasan_ijazah'        => "TUNTAS"
                                    ]);
                                }
                                else{
                                    DB::table('m_siswa')->where('s_id',$ts->s_id)->update([
                                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                                    ]);
                                }
                            }
                            else{
                                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS")) {
                                    DB::table('m_siswa')->where('s_id',$ts->s_id)->update([
                                        'ketuntasan_ijazah'        => "TUNTAS"
                                    ]);
                                }
                                else{
                                    DB::table('m_siswa')->where('s_id',$ts->s_id)->update([
                                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                                    ]);
                                }
                            }
                        }
                    }
                }
                return redirect()->route('view.rekap', $tingkat);  
            }  
        }  
        return back();  
    }

    public function index_admin(){
        $data['no'] = 1;
      
        $tingkatan = DB::table('m_kelas')
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;

        return view('admin/paper/rekap/index', $data);
    }

    public function view_admin($tingkat)
    {
      $data['no'] = 1;

      $rekap = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->where('m_kelas.tingkat', $tingkat)
            ->get();

      $data['tingkat'] = $tingkat;
      $data['rekap'] = $rekap;

      return view('admin/paper/rekap/view', $data);
    }
}
