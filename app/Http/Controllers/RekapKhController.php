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

class RekapKhController extends Controller
{
    public function index($uji_id)
    {
      $kh = DB::table('m_kh')
          ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();

        $rekapkh = DB::table('rekap_kh')
          ->join('m_siswa', 'm_siswa.s_id', '=', 'rekap_kh.s_id')
            ->where('rekap_kh.uji_id',$uji_id)
            ->get();

        $ujikh = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();
            
        $data['ujikh'] = $ujikh;
        $data['kh'] = $kh;
        $data['rekapkh'] = $rekapkh;
        return view('/admin/rekapkh/index', $data);
    }

    public function actionrekap(Request $request)
    {
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                if ($request->nilai_a1 + $request->nilai_a2 + $request->nilai_a3 + $request->nilai_a4 >= 70) {
                    $kriteria = "TUNTAS";
                }
                else {
                    $kriteria = "TIDAK TUNTAS";
                }
                $data = array(
                    'nilai_a1'  =>  $request->nilai_a1,
                    'nilai_a2'  =>  $request->nilai_a2,
                    'nilai_a3'  =>  $request->nilai_a3,
                    'nilai_a4'  =>  $request->nilai_a4,
                    'total'   =>  $request->nilai_a1 + $request->nilai_a2 + $request->nilai_a3 + $request->nilai_a4,
                    'kriteria'  =>  $kriteria
                );
                DB::table('rekap_kh')
                    ->where('r_id', $request->r_id)
                    ->update($data);
            }
            if($request->action == 'delete')
            {
                DB::table('rekap_kh')
                    ->where('r_id', $request->r_id)
                    ->delete();
            }
            return response()->json($request);
        }
    }

    public function rekap($ta_id){
      $th_ajar = DB::table('m_th_ajar')
          ->where('ta_id',$ta_id)
          ->get(); 
      $kh = DB::table('m_kh')
        ->where('kh_nama', '!=', "Dzikrul Ghofilin")
        ->select('kh_nama', 'singkatan')
        ->get();
      $siswa = DB::table('rekap_kh')
        ->join('uji_kh', 'rekap_kh.uji_id', '=', 'uji_kh.uji_id')
        ->where('uji_kh.ta_id',$ta_id)
        ->select('rekap_kh.s_id')
        ->distinct()
        ->get();
      $rekappersiswa = array();
      foreach ($siswa as $s) {
         $rekapkh = DB::table('rekap_kh')
            ->join('uji_kh', 'uji_kh.uji_id', '=', 'rekap_kh.uji_id')
            ->join('m_siswa', 'm_siswa.s_id', '=', 'rekap_kh.s_id')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.ta_id',$ta_id)
            ->where('rekap_kh.s_id',$s->s_id)
            ->select('m_siswa.s_id','m_kh.kh_nama', 'm_siswa.nis', 'm_siswa.s_nama', 'm_kelas.tingkat', 'm_kelas.k_nama', 'm_siswa.status', 'rekap_kh.total', 'rekap_kh.kriteria')
            ->get()
            ->toArray();
          array_push($rekappersiswa, $rekapkh);
      }
      $totaldata = sizeof($rekappersiswa);
      $data['no'] = 1;
      $data['th_ajar'] = $th_ajar;
      $data['ta_id'] = $ta_id;
      $data['kh'] = $kh;
      $data['totaldata'] = $totaldata;
      $data['rekappersiswa'] = $rekappersiswa;
      return view('/admin/th_ajar/rekaptotal',$data);
    }

    public function rekappenguji($ta_id){
        $data['no'] = 1;
        $th_ajar = DB::table('m_th_ajar')
          ->where('ta_id',$ta_id)
          ->get(); 
        $data['th_ajar'] = $th_ajar;
        $penguji = DB::table('rekap_kh')
            ->join('uji_kh', 'rekap_kh.uji_id', '=', 'uji_kh.uji_id')
            ->where('uji_kh.ta_id',$ta_id)
            ->where('rekap_kh.nama_penguji', '!=', NULL)
            ->select(DB::raw('count(*) as count, nama_penguji'))
            ->groupBy('nama_penguji')
            ->get();
        $data['penguji'] = $penguji;
        
        return view('/admin/th_ajar/rekappenguji',$data);
    }
}
