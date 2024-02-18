<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kelas;
use Input;  
use Excel;

class AsesorController extends Controller
{
    public function index(){
        $data['no'] = 1;
      
        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;

        return view('paper/asesor/index', $data);
    }

    public function view($tingkat)
    {
      $data['no'] = 1;
      
      $kelas = DB::table('m_kelas')
            ->where('tingkat', $tingkat)
            ->get();

      $data['kelas'] = $kelas;
      $data['tingkat'] = $tingkat;

      return view('paper/asesor/view', $data);
    }

    public function import($tingkat)
    {
      $data['no'] = 1;
      $data['tingkat'] = $tingkat;

      return view('paper/asesor/import', $data);
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
                        ->update(['asesor' => $value->asesor]);
                }
                return redirect()->route('view.asesor', $tingkat);  
            }  
        }  
        return back();  
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

      return view('/paper/asesor/edit', $data);
    }

    public function update(Request $request, $id)
    {
      $data['no'] = 1;
      
      $asesor = DB::table('m_kelas')
              ->where('k_id', $id)
              ->update(['asesor' => $request->asesor]);    

      $tingkatan = DB::table('m_kelas')
            ->where('k_id', $id)
            ->select('tingkat')
            ->get();

      foreach ($tingkatan as $t) {
        $tingkat = $t->tingkat;
      }
      return redirect()->route('view.asesor', $tingkat);
    }

    public function rekap($tingkat)
    {
        $data['no'] = 1;

        $rekap = Kelas::join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->join('paper', 'm_siswa.s_id', '=', 'paper.siswa_s_id')
            ->where('m_kelas.tingkat', $tingkat)
            ->get();

        $data['rekap'] = $rekap;
        $data['tingkat'] = $tingkat;

        return view('paper/asesor/rekap', $data);
    }
}
