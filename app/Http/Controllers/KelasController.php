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
use App\RekapKh;

class KelasController extends Controller
{
    public function index(){
        $data['no'] = 1;
        $kelas = DB::table('m_kelas')
        	->join('users', 'users.id', '=', 'm_kelas.wali')
            ->where('m_kelas.tingkat',"10")
            ->orWhere('m_kelas.tingkat',"11")
            ->orWhere('m_kelas.tingkat',"12")
        	->get();
        $data['kelas'] = $kelas;
        return view('/admin/kelas/index',$data);
    }

    public function insert()
    {
    	$guru = DB::table('users')
    		->where('role',"guru")->get();
    	$data['guru'] = $guru;
        return view('/admin/kelas/insert', $data);
    }

    public function store(Request $request)
    {
      $kelas = new Kelas;
      $kelas->wali     = $request->wali;
      $kelas->tingkat  = $request->tingkat;
      $kelas->k_nama   = $request->k_nama;
      $kelas->penguji_dzikrul = NULL;

      if ($kelas->save()){
        return redirect('/admin/kelas');
      }
      else{
        return redirect('/admin/kelas/insert');
      }
    }

    public function edit($id)
    {
        $kelas = DB::table('m_kelas')
        	->join('users', 'users.id', '=', 'm_kelas.wali')
        	->where('m_kelas.k_id',$id)
        	->get();
        $guru = DB::table('users')
            ->where('role',"guru")->get();
        $data['guru'] = $guru;
        $data['kelas'] = $kelas;
        return view('/admin/kelas/edit',$data);
    }

    public function update(Request $request, $id){
        DB::table('m_kelas')->where('k_id',$request->id)->update([
            'wali'      => $request->wali,
            'tingkat'   => $request->tingkat,
            'k_nama'    => $request->k_nama
        ]);           
      	return redirect()->route('kelas');
    }

    public function delete($k_id){
        $kelas = Kelas::findOrFail($k_id)->delete();
        return redirect()->route('kelas');
    }

    public function import()  
    {  
        return view('/admin/kelas/import');  
    }

    public function importExcel()  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    $insert[] = ['wali' => $value->wali, 'tingkat' => $value->tingkat, 'k_nama' => $value->k_nama, 'penguji_dzikrul' => NULL];  
                }  
                if(!empty($insert)){  
                    DB::table('m_kelas')->insert($insert);  
                    return redirect()->route('kelas');  
                }  
            }  
        }  
        return back();  
    }

    public function importwali()  
    {  
        return view('/admin/kelas/importwali');  
    }

    public function importwaliExcel()  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    DB::table('m_kelas')
                        ->where('k_id',$value->k_id)
                        ->update(['wali' => $value->wali]);
                }  
                return redirect()->route('kelas');   
            }  
        }  
        return back();  
    }

    public function naik()
    {
        $kelas = DB::table('m_kelas')
            ->where('tingkat',"10")
            ->orWhere('tingkat',"11")
            ->orWhere('tingkat',"12")
            ->get();

        foreach ($kelas as $k) {
            if ($k->tingkat == "12") {
                $value = "alumni";
            }
            else if ($k->tingkat == "11") {
                $value = "12";
            }
            else if ($k->tingkat == "10") {
                $value = "11";
            }
            DB::table('m_kelas')
                    ->where('k_id', $k->k_id)
                    ->update(['tingkat' => $value]);
        }
        
        return redirect()->route('kelas');
    }
}
