<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Kelas;
use Input;  
use Excel;
use File;
use PDF;

class JilidPaperController extends Controller
{
    public function index(){
        $data['no'] = 1;
      
        $tingkatan = DB::table('m_kelas')
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;

        return view('paper/jilid/index', $data);
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

      return view('paper/jilid/view', $data);
    }

    public function edit($tingkat, $p_id)
    {
      $data['no'] = 1;
      $data['tingkat'] = $tingkat;

      $paper = DB::table('paper')
            ->join('m_siswa', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->where('p_id', $p_id)
            ->get();

      $data['paper'] = $paper;

      return view('/paper/jilid/edit', $data);
    }

    public function update(Request $request, $tingkat, $p_id)
    {
        $data['no'] = 1;
        
        if ($request->nilai >= 80) {
            $predikat = "A";
        }
        else if(($request->nilai >= 60) && ($request->nilai < 80)){
            $predikat = "B";
        }
        else if(($request->nilai >= 41) && ($request->nilai < 60)){
            $predikat = "C";
        }
        else{
            $predikat = "D";
        }

        $jilid = DB::table('paper')
              ->where('p_id', $p_id)
              ->update(['tgl_ujian' => $request->tgl_ujian,
                        'nilai' => $request->nilai,
                        'predikat' => $predikat,
                        'status_paper' => $request->status_paper,
                        'setor' => $request->setor,
                        'jilid' => $request->jilid,
                        'ambil' => $request->ambil,
                        'nama_pengambil' => $request->nama_pengambil]);    

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
                    if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
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
                    if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
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

      return redirect()->route('view.jilid', $tingkat);
    }
}
