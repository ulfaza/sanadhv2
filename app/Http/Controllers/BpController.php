<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Kelas;

class BpController extends Controller
{
    public function tanggungan(){
        $tg_bp = DB::table('m_kelas')
            ->join('m_siswa', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
            ->where('m_th_ajar.status',"AKTIF")
            ->get();
 
        $data['tg_bp'] = $tg_bp;

        return view('/bp/tanggungan',$data);
    }

    public function update(Request $request, $tg_id)
    {
        DB::table('tanggungan_smt')->where('tg_id',$tg_id)->update([
            'bp'        => $request->bp,
            'ket_bp'    => $request->ket_bp
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

        return redirect()->route('tanggungan.bp');
    }
}
