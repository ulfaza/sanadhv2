<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kelas;
use App\Siswa;
use App\Kh;

class KhController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        $data['jeniskh'] = Kh::all();
        return view('/admin/kh/index', $data);
    }

    function actionkh(Request $request)
    {
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                $data = array(
                    'kh_nama'   =>  $request->kh_nama,
                    'kkm'      	=>  $request->kkm,
                    'aspek1'    =>  $request->aspek1,
                    'max_a1'    =>  $request->max_a1,
                    'aspek2'    =>  $request->aspek2,
                    'max_a2'    =>  $request->max_a2,
                    'aspek3'    =>  $request->aspek3,
                    'max_a3'    =>  $request->max_a3,
                    'aspek4'    =>  $request->aspek4,
                    'max_a4'    =>  $request->max_a4
                );
                DB::table('m_kh')
                    ->where('kh_id', $request->kh_id)
                    ->update($data);
            }
            if($request->action == 'delete')
            {
                DB::table('m_kh')
                    ->where('kh_id', $request->kh_id)
                    ->delete();
            }
            return response()->json($request);
        }
    }

    public function insert()
    {
        return view('/admin/kh/insert');
    }

    public function store(Request $request)
    {
      $kh = new Kh;
      $kh->kh_nama	= $request->kh_nama;
      $kh->kkm   	  = $request->kkm;
      $kh->aspek1	  = $request->aspek1;
      $kh->max_a1   = $request->max_a1;
      $kh->aspek2	  = $request->aspek2;
      $kh->max_a2   = $request->max_a2;
      $kh->aspek3	  = $request->aspek3;
      $kh->max_a3   = $request->max_a3;
      $kh->aspek4	  = $request->aspek4;
      $kh->max_a4   = $request->max_a4;

      if ($kh->save()){
        return redirect('/admin/jenis_kh');
      }
      else{
        return redirect('/admin/tambah/jenis_kh');
      }
    }

    public function transkrip()
    {
        $data['no'] = 1;
      
        $tingkatan = DB::table('m_kelas')
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;

        return view('admin/kh/transkrip/index', $data);
    }

    public function transkrip_tingkat($tingkat)
    {
      $data['no'] = 1;

      $transkrip = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->where('m_kelas.tingkat', $tingkat)
            ->get();

      $data['tingkat'] = $tingkat;
      $data['transkrip'] = $transkrip;

      return view('admin/kh/transkrip/view', $data);
    }
}
