<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;
use Excel;
use App\User;
use App\Kelas;
use App\Siswa;
use App\Kh;
use App\ThAjar;
use App\UjiKh;

class UjiKhController extends Controller
{
    public function index($kh_nama, $ta_id)
    {
        $kh = DB::table('m_kh')
          ->where('kh_nama', $kh_nama)
          ->get();

        foreach ($kh as $k) {
            $id_kh = $k->kh_id;
        }

    	$th_ajar = DB::table('m_th_ajar')
            ->where('ta_id', $ta_id)
            ->get();

        $ujikh = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->where('uji_kh.ta_id', $ta_id)
            ->where('uji_kh.kh_id', $id_kh)
            ->get();

        $data['ta_id'] = $ta_id;
        $data['id_kh'] = $id_kh;
        $data['kh'] = $kh;
        $data['th_ajar'] = $th_ajar;
        $data['ujikh'] = $ujikh;
        
        return view('/admin/th_ajar/penguji/index', $data);
    }

    public function edit($uji_id)
    {
        $guru = DB::table('users')
            ->where('role',"guru")->get();
        $data['guru'] = $guru;
        $ujikh = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();
        $data['ujikh'] = $ujikh;
        return view('/admin/th_ajar/penguji/edit', $data);
    }

    public function update(Request $request, $id, $ta_id, $kh_nama){
        $ujikh = DB::table('uji_kh')
              ->where('uji_id', $id)
              ->update(['penguji' => $request->penguji]);         
        return redirect()->route('ujikh', [$kh_nama,$ta_id]);
    }

    public function import($ta_id, $id_kh)  
    {  
        $kh = DB::table('m_kh')
          ->where('kh_id', $id_kh)
          ->get();
        $th_ajar = DB::table('m_th_ajar')
            ->where('ta_id', $ta_id)
            ->get();
        $data['ta_id'] = $ta_id;
        $data['id_kh'] = $id_kh;
        $data['kh'] = $kh;
        $data['th_ajar'] = $th_ajar;
        return view('/admin/th_ajar/penguji/import', $data);  
    }

    public function importExcel($ta_id, $id_kh)  
    {  
        $kh = DB::table('m_kh')
          ->where('kh_id', $id_kh)
          ->get();
        foreach ($kh as $k) {
            $nama_kh = $k->kh_nama;
        }
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    DB::table('uji_kh')
                        ->where('ta_id',$ta_id)
                        ->where('kh_id',$id_kh)
                        ->where('k_id',$value->k_id)
                        ->update(['penguji' => $value->penguji]);
                }  
                return redirect()->route('ujikh', [$nama_kh,$ta_id]);   
            }  
        }  
        return back();  
    }

    public function download()
    {
        //PDF file is stored under project/public/import_penguji.xlsx
        $file= public_path(). "/import_penguji.xlsx";

        return response()->download($file);
    }
}
