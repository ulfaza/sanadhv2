<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kelas;
use Input;  
use Excel;

class PembimbingController extends Controller
{
    public function index(){
        $data['no'] = 1;
      
        $tingkatan = DB::table('m_kelas')
            ->where('tingkat', '!=', "alumni")
            ->select('tingkat')->distinct()
            ->get();

        $data['tingkatan'] = $tingkatan;

        return view('paper/pembimbing/index', $data);
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

      return view('paper/pembimbing/view', $data);
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

      $guru = DB::table('users')
            ->where('role',"guru")->get();
      $data['guru'] = $guru;

      return view('/paper/pembimbing/edit', $data);
    }

    public function update(Request $request, $tingkat, $p_id)
    {
      $data['no'] = 1;
      
      $pembimbing = DB::table('paper')
              ->where('p_id', $p_id)
              ->update(['pembimbing' => $request->pembimbing]);    

      return redirect()->route('view.pembimbing', $tingkat);
    }

    public function import($tingkat)
    {
      $data['no'] = 1;
      $data['tingkat'] = $tingkat;

      return view('paper/pembimbing/import', $data);
    }

    public function importExcel($tingkat)  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    DB::table('paper')
                        ->where('p_id',$value->id)
                        ->update(['pembimbing' => $value->pembimbing]);
                }
                return redirect()->route('view.pembimbing', $tingkat);  
            }  
        }  
        return back();  
    }
}
