<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\ThAjar;
use App\UjiPaper;
use App\Paper;
use App\Kelas;
use Input;
use Excel;

class UjianController extends Controller
{
    public function index(){
        $data['no'] = 1;
      
        $thajar = ThAjar::select('th_ajaran')->distinct()->get();
        $data['thajar'] = $thajar;

        return view('paper/ujian/index', $data);
    }

    public function view($th_ajaran)
    {
        $data['no'] = 1;
        $gel = UjiPaper::select("*")
                        ->where("tahun_ajar", $th_ajaran)
                        ->get();
        $data['th_ajaran'] = $th_ajaran;
        $data['gel'] = $gel;
        return view('paper/ujian/view', $data);
    }

    public function peserta($th_ajaran, $tgl)
    {
        $data['no'] = 1;   
        $siswa = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                    ->join('m_kelas', 'm_kelas.k_id', '=', 'm_siswa.k_id')
                    ->where("tgl_ujian", $tgl)
                    ->get();
        $data['th_ajaran'] = $th_ajaran;
        $data['tgl'] = $tgl;
        $data['siswa'] = $siswa;
        return view('paper/ujian/peserta', $data);
    }

    public function edit($th_ajaran, $tgl, $p_id)
    {
        $data['no'] = 1;
        $paper = Paper::join('m_siswa', 'paper.siswa_s_id', '=', 'm_siswa.s_id')
                    ->join('m_kelas', 'm_kelas.k_id', '=', 'm_siswa.k_id')
                    ->where("p_id", $p_id)
                    ->get();
        $data['paper'] = $paper;
        $guru = DB::table('users')
                ->where('role',"guru")->get();
        $data['guru'] = $guru;
        $data['th_ajaran'] = $th_ajaran;
        $data['tgl'] = $tgl;
        return view('paper/ujian/edit', $data);
    }

    public function update(Request $request, $th_ajaran, $tgl, $p_id)
    {
      $data['no'] = 1;
      
      $penguji = DB::table('paper')
              ->where('p_id', $p_id)
              ->update(['judul' => $request->judul,
                        'penguji1' => $request->penguji1,
                        'penguji2' => $request->penguji2]);    

      return redirect()->route('peserta.ujian', [$th_ajaran, $tgl]);
    }

    public function insert($th_ajaran)
    {
        $data['th_ajaran'] = $th_ajaran;
        return view('paper/ujian/insert', $data);
    }

    public function store(Request $request, $th_ajaran)
    {
      $gelombang = new UjiPaper;
      $gelombang->tahun_ajar    = $th_ajaran;
      $gelombang->gel           = $request->gel;
      $gelombang->tgl           = $request->tgl;

      if ($gelombang->save()){
        return redirect()->route('view.ujian', $th_ajaran);
      }
      else{
        return redirect()->route('insert.gel', $th_ajaran);
      }
    }

    public function edit_gel(Request $request, $th_ajaran, $up_id)
    {
        $data['th_ajaran'] = $th_ajaran;
        $gelombang = UjiPaper::where("up_id", $up_id)
                    ->get();
        $data['gelombang'] = $gelombang;
        return view('paper/ujian/edit_gel', $data);
    }

    public function update_gel(Request $request, $th_ajaran, $up_id, $tgl_lama)
    {
        $gelombang = DB::table('uji_paper')
              ->where('up_id', $request->up_id)
              ->update(['gel' => $request->gel,
                        'tgl' => $request->tgl,
                        'status_ujian' => $request->status]);

        $update = DB::table('paper')
              ->where('tgl_ujian', $tgl_lama)
              ->update(['tgl_ujian' => $request->tgl]);

        return redirect()->route('view.ujian', $th_ajaran);
    }

    public function insert_peserta($th_ajaran, $tgl)
    {
        $data['th_ajaran'] = $th_ajaran;
        $data['tgl'] = $tgl;
        $siswa = DB::table('m_siswa')->get();
        $data['siswa'] = $siswa;
        return view('paper/ujian/insert_peserta', $data);
    }

    public function store_peserta(Request $request, $th_ajaran, $tgl)
    {
        $siswa = DB::table('paper')
              ->where('siswa_s_id', $request->s_id)
              ->update(['tgl_ujian' => $tgl,
                        'status_paper' => "DAFTAR UJIAN"]);

        $tg_smt = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
            ->where('m_siswa.s_id',$request->s_id)
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
        
        return redirect()->route('peserta.ujian', [$th_ajaran, $tgl]);
    }

    public function delete($th_ajaran, $tgl, $p_id)
    {
        $siswa = DB::table('paper')
              ->where('p_id', $p_id)
              ->update(['tgl_ujian' => NULL]);

        return redirect()->route('peserta.ujian', [$th_ajaran, $tgl]);
    }

    public function import($th_ajaran, $tgl)
    {
      $data['no'] = 1;
      $data['th_ajaran'] = $th_ajaran;
      $data['tgl'] = $tgl;

      return view('paper/ujian/import', $data);
    }

    public function importExcel($th_ajaran, $tgl)  
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
                                'penguji1' => $value->penguji1,
                                'penguji2' => $value->penguji2 ]);
                }
                return redirect()->route('peserta.ujian', [$th_ajaran, $tgl]);  
            }  
        }  
        return back();  
    }
}
