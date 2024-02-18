<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Input;  
use Excel;
use App\Kelas;

class RekapRaporController extends Controller
{
    public function index(){
        $data['no'] = 1;
      
        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;

        return view('admin/rapor/index', $data);
    }

    public function view($tingkat)
    {
      $data['no'] = 1;

      $siswa = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('tanggungan_smt', 'm_siswa.s_id', '=', 'tanggungan_smt.s_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'tanggungan_smt.ta_id')
            ->where('m_kelas.tingkat',$tingkat)
            ->where('m_th_ajar.status',"AKTIF")
            ->get();

      $data['siswa'] = $siswa;
      $data['tingkat'] = $tingkat;
      return view('/admin/rapor/view', $data);
    }
}
