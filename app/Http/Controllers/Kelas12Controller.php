<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;  
use Excel;

class Kelas12Controller extends Controller
{
    public function index()
    {
      $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
      $data['angkatan'] = $angkatan;
      
      return view('/admin/kelas12/index', $data);
    }

    public function view($th_lulus){
        $kelas12 = DB::table('m_siswa')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->join('kelas_12', 'm_siswa.s_id', '=', 'kelas_12.s_id')
            ->where('m_siswa.th_lulus',$th_lulus)
            ->get();

        $data['no'] = 1;
        $data['th_lulus'] = $th_lulus;
        $data['kelas12'] = $kelas12;

        return view('admin/kelas12/view',$data);
    }
}
