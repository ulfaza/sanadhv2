<?php

namespace App\Http\Controllers;

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
use Input;  
use Excel;

class TanggunganSmtController extends Controller
{
    public function rekap($ta_id){
      $th_ajar = DB::table('m_th_ajar')
          ->where('ta_id',$ta_id)
          ->get();
      $rekaptg = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->where('tanggungan_smt.ta_id',$ta_id)
            ->get();
        
      $data['no'] = 1;
      $data['th_ajar'] = $th_ajar;
      $data['rekaptg'] = $rekaptg;
      return view('/admin/tgsmt/rekap',$data);
    }

    public function import($ta_id)  
    {  
        $th_ajar = DB::table('m_th_ajar')
          ->where('ta_id',$ta_id)
          ->get();
        $data['th_ajar'] = $th_ajar;
        return view('/admin/tgsmt/import',$data);  
    }

    public function importExcel($ta_id)  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) { 
                    DB::table('tanggungan_smt')
                        ->where('s_id',$value->id)
                        ->where('ta_id',$ta_id)
                        ->update(['bp' => $value->bp, 'ket_bp' => $value->ket_bp, 'keuangan' => $value->keuangan, 'ket_keu' => $value->keterangan]);

                    $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
                        ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
                        ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
                        ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
                        ->where('tanggungan_smt.s_id',$value->id)
                        ->where('tanggungan_smt.ta_id',$ta_id)
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
                }  
                return redirect()->route('tanggungan', $ta_id);   
            }  
        }  
        return back(); 
    }

    public function acc($ta_id, $s_id)
    {
        DB::table('tanggungan_smt')
            ->where('ta_id',$ta_id)
            ->where('s_id',$s_id)
            ->update([
                'keuangan'  => "TUNTAS"
        ]);

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
            ->where('tanggungan_smt.s_id',$s_id)
            ->where('tanggungan_smt.ta_id',$ta_id)
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
        
        return redirect()->route('tanggungan', $ta_id);
    } 

    public function store(Request $request, $ta_id, $s_id)
    {
        // DB::table('tanggungan_smt')
        //     ->where('ta_id',$ta_id)
        //     ->where('s_id',$s_id)
        //     ->update([
        //         'message'        => $request->message
        // ]);
        return redirect()->route('tanggungan', $ta_id);
    }
}
