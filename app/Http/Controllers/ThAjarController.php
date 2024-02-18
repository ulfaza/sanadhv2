<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kelas;
use App\Siswa;
use App\Kh;
use App\ThAjar;
use App\UjiKh;
use App\RekapKh;

class ThAjarController extends Controller
{
    public function index()
    {
      $data['no'] = 1;
      $data['th_ajar'] = ThAjar::all();
      
      $uji = DB::table('m_th_ajar')
          ->join('uji_kh', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
          ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
          ->select('m_th_ajar.smt', 'm_th_ajar.th_ajaran', 'm_kh.kh_nama')
          ->where('m_kh.kh_nama', '!=', "Dzikrul Ghofilin")
          ->distinct('m_th_ajar.ta_id')
          ->get();
      
      $data['uji'] = $uji;
      return view('/admin/th_ajar/index', $data);
    }

    public function insert()
    {
        return view('/admin/th_ajar/insert');
    }

    public function store(Request $request)
    {
      $kh = DB::table('m_kh')->where('kh_nama', '!=', "Dzikrul Ghofilin")->get();
      $kelas = DB::table('m_kelas')->where('tingkat', '!=', "alumni")->get();
      
      $th_ajar = new ThAjar;
      $th_ajar->th_ajaran = $request->th_ajaran;
      $th_ajar->smt       = $request->smt;
      $th_ajar->status    = "NONAKTIF";
      $th_ajar->save();

      $th_ajar2 = DB::table('m_th_ajar')->where('th_ajaran',$request->th_ajaran)->where('smt',$request->smt)->get(); 

      foreach ($th_ajar2 as $ta) {
        $id_th_ajar = $ta->ta_id;
      }

      foreach ($kh as $khs) {
        foreach ($kelas as $k){
            DB::table('uji_kh')->insert([
              ['kh_id' => $khs->kh_id, 
               'penguji' => NULL,
               'k_id' => $k->k_id,
               'ta_id' => $id_th_ajar
              ],
            ]);
        }       
      }

      $uji_kh = DB::table('uji_kh')->where('ta_id',$id_th_ajar)->get();
      $siswa = DB::table('m_kelas')
              ->join('m_siswa', 'm_siswa.k_id', '=', 'm_kelas.k_id')
              ->where('m_kelas.tingkat', '!=', "alumni")
              ->get();

      foreach ($uji_kh as $uk) {
        foreach ($siswa as $s){
          if ($uk->k_id == $s->k_id) {
            DB::table('rekap_kh')->insert([
              ['uji_id' => $uk->uji_id,
               's_id' => $s->s_id,
               'nilai_a1' => NULL,
               'nilai_a2' => NULL,
               'nilai_a3' => NULL,
               'nilai_a4' => NULL,
               'total' => NULL,
               'kriteria' => "TIDAK TUNTAS"
              ],
            ]);
          }
        }       
      }
      
      foreach ($siswa as $s){
        if ($s->tingkat == "10") {
          DB::table('tanggungan_smt')->insert([
            ['ta_id' => $id_th_ajar,
             's_id' => $s->s_id,
             'keuangan' => "TIDAK TUNTAS",
             'ket_keu' => NULL,
             'k_hijau' => "TIDAK TUNTAS",
             'ket_k_h' => NULL,
             'paper' => "BELUM",
             'ket_ppr' => NULL,
             'kartu_aksi' => "TIDAK PUNYA",
             'osis' => "TUNTAS",
             'da' => "TUNTAS",
             'pmr' => "TUNTAS",
             'ketuntasan' => "TIDAK TUNTAS"
            ],
          ]);
        }
        else if (($s->tingkat == "11") or ($s->tingkat == "12")) {
          DB::table('tanggungan_smt')->insert([
            ['ta_id' => $id_th_ajar,
             's_id' => $s->s_id,
             'keuangan' => "TIDAK TUNTAS",
             'ket_keu' => NULL,
             'k_hijau' => "TIDAK TUNTAS",
             'ket_k_h' => NULL,
             'paper' => "TIDAK TUNTAS",
             'ket_ppr' => NULL,
             'kartu_aksi' => "TIDAK PUNYA",
             'osis' => "TUNTAS",
             'da' => "TUNTAS",
             'pmr' => "TUNTAS",
             'ketuntasan' => "TIDAK TUNTAS"
            ],
          ]);
        }
      }
      
      return redirect('/admin/th_ajar');
    }

    public function edit($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $th_ajar = DB::table('m_th_ajar')
          ->where('ta_id',$id)
          ->get();
        $data['th_ajar'] = $th_ajar;
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/admin/th_ajar/edit', $data);
    }

    public function update(Request $request, $ta_id){
        DB::table('m_th_ajar')->where('ta_id',$ta_id)->update([
            'th_ajaran' => $request->th_ajaran,
            'smt' => $request->smt,
            'status' => $request->status
        ]);           
        return redirect()->route('th_ajar');
    }

    public function delete($ta_id){
        $th_ajar = DB::table('m_th_ajar')->where('ta_id', $ta_id)->delete();
        return redirect()->route('th_ajar');
    }

    public function rekapkh($ta_id){
      $th_ajar = DB::table('m_th_ajar')
          ->where('ta_id',$ta_id)
          ->get(); 
      $kelas = DB::table('m_kelas')
            ->get();
      $data['no'] = 1;
      $data['th_ajar'] = $th_ajar;
      $data['kelas'] = $kelas;
      $data['ta_id'] = $ta_id;
      return view('/admin/th_ajar/rekap',$data);
    }

    public function rekapsiswa($ta_id, $k_id){
      $th_ajar = DB::table('m_th_ajar')
          ->where('ta_id',$ta_id)
          ->get();
      $kelas = DB::table('m_kelas')
          ->where('k_id',$k_id)
          ->get();
      $kh = DB::table('uji_kh')
        ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
        ->where('uji_kh.ta_id',$ta_id)
        ->where('uji_kh.k_id',$k_id)
        ->select('m_kh.kh_nama')
        ->get();
      $siswa = DB::table('m_siswa')
        ->where('k_id', $k_id)
        ->select('s_nama')
        ->get();
      $rekapkh = DB::table('rekap_kh')
            ->join('uji_kh', 'uji_kh.uji_id', '=', 'rekap_kh.uji_id')
            ->join('m_siswa', 'm_siswa.s_id', '=', 'rekap_kh.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.ta_id',$ta_id)
            ->where('uji_kh.k_id',$k_id)
            ->select('m_kh.kh_nama', 'm_siswa.s_nama', 'rekap_kh.total', 'rekap_kh.kriteria')
            ->get();
      foreach ($kh as $khs=>$value) {
        $total[$khs] = 0;
        foreach ($rekapkh as $rk) {
          if ($value->kh_nama == $rk->kh_nama) {
            if ($rk->kriteria == "TUNTAS") {
              $total[$khs] += 1;
            }
          }
        }
      }
      // $jml = sizeof($total);
      $data['no'] = 1;
      $data['th_ajar'] = $th_ajar;
      $data['kelas'] = $kelas;
      $data['kh'] = $kh;
      $data['siswa'] = $siswa;
      $data['rekapkh'] = $rekapkh;
      // $data['jml'] = $jml;
      // $data['total'] = $total;
      return view('/admin/th_ajar/rekapsiswa',$data);
    }
}
