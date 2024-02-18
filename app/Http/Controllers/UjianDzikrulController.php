<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;  
use Excel;

class UjianDzikrulController extends Controller
{
    public function index()
    {
      $data['no'] = 1;
      
      $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

      $data['tingkatan'] = $tingkatan;

      return view('/admin/ujiandzikrul/index', $data);
    }

    public function penguji($tingkat)
    {
      $data['no'] = 1;
      
      $kelas = DB::table('m_kelas')
            ->where('tingkat', $tingkat)
            ->get();

      $data['kelas'] = $kelas;
      $data['tingkat'] = $tingkat;

      return view('/admin/ujiandzikrul/penguji', $data);
    }

    public function edit($id)
    {
      $data['no'] = 1;
      
      $tingkatan = DB::table('m_kelas')
            ->where('k_id', $id)
            ->select('tingkat')
            ->get();

      $data['tingkatan'] = $tingkatan;

      $kelas = DB::table('m_kelas')
            ->where('k_id', $id)
            ->get();

      $data['kelas'] = $kelas;

      $guru = DB::table('users')
            ->where('role',"guru")->get();
      $data['guru'] = $guru;

      return view('/admin/ujiandzikrul/edit', $data);
    }

    public function update(Request $request, $id)
    {
      $data['no'] = 1;
      
      $ujidzikrul = DB::table('m_kelas')
              ->where('k_id', $id)
              ->update(['penguji_dzikrul' => $request->penguji]);    

      $tingkatan = DB::table('m_kelas')
            ->where('k_id', $id)
            ->select('tingkat')
            ->get();

      foreach ($tingkatan as $t) {
        $tingkat = $t->tingkat;
      }
      return redirect()->route('penguji.dzikrul', $tingkat);
    }

    public function rekap($tingkat)
    {
      $data['no'] = 1;
      
      $siswa = DB::table('m_siswa')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->where('m_kelas.tingkat',$tingkat)
            ->get();

      $data['siswa'] = $siswa;
      $data['tingkat'] = $tingkat;
      return view('/admin/ujiandzikrul/rekap', $data);
    }

    public function rekappenguji($tingkat){
        $data['no'] = 1;
        $penguji = DB::table('m_siswa')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->where('m_kelas.tingkat',$tingkat)
            ->where('m_siswa.real_dzikrul', '!=', NULL)
            ->select(DB::raw('count(*) as count, real_dzikrul'))
            ->groupBy('real_dzikrul')
            ->get();
        $data['penguji'] = $penguji;
        $data['tingkat'] = $tingkat;
        return view('/admin/ujiandzikrul/rekappenguji',$data);
    }

    public function import($tingkat)
    {
      $data['no'] = 1;
      $data['tingkat'] = $tingkat;

      return view('/admin/ujiandzikrul/import', $data);
    }

    public function importExcel($tingkat)  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    DB::table('m_kelas')
                        ->where('k_id',$value->id)
                        ->update(['penguji_dzikrul' => $value->penguji]);
                }
                return redirect()->route('penguji.dzikrul', $tingkat);  
            }  
        }  
        return back();  
    }
}
