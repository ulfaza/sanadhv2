<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;  
use Excel;

class PaperController extends Controller
{
    public function index()
    {
      $data['no'] = 1;
      $angkatan = DB::table('m_siswa')
            ->where('th_lulus', '!=', NULL)
            ->select('th_lulus')->distinct()
            ->get();
      $data['angkatan'] = $angkatan;
      
      return view('/admin/paper/index', $data);
    }

    public function view($th_lulus){
        $tg_paper = DB::table('m_siswa')
            ->join('m_kelas', 'm_siswa.k_id', '=', 'm_kelas.k_id')
            ->where('m_siswa.th_lulus',$th_lulus)
            ->get();

        $data['th_lulus'] = $th_lulus;
        $data['tg_paper'] = $tg_paper;

        return view('admin/paper/view',$data);
    }

    public function edit($th_lulus, $id)
    {
        $siswa = DB::table('m_siswa')
            ->where('s_id',$id)
            ->get();
        $data['siswa'] = $siswa;
        $data['th_lulus'] = $th_lulus;

        return view('admin/paper/edit', $data);
    }

    public function update(Request $request, $th_lulus, $s_id)
    {
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'tg_paper'	=> $request->tg_paper,
            'ket_paper'  => $request->ket_paper
        ]);   

        $tg_ijazah = DB::table('m_siswa')
            ->where('s_id',$s_id)
            ->get();
        foreach ($tg_ijazah as $row) {
            if ($row->jenis_kel == "PUTRA") {
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
            else{
                if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TUNTAS"
                    ]);
                }
                else{
                    DB::table('m_siswa')->where('s_id',$s_id)->update([
                        'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                    ]);
                }
            }
        }

        return redirect()->route('view.paper', $th_lulus);
    }

    public function import($th_lulus)  
    {  
        $data['th_lulus'] = $th_lulus;

        return view('admin/paper/import', $data);  
    }

    public function importExcel($th_lulus)  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    DB::table('m_siswa')
                        ->where('s_id',$value->id)
                        ->update(['tg_paper' => $value->ketuntasan, 'ket_paper' => $value->keterangan]);

                    $tg_ijazah = DB::table('m_siswa')
                        ->where('s_id',$value->id)
                        ->get();
                    foreach ($tg_ijazah as $row) {
                        if ($row->jenis_kel == "PUTRA") {
                            if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_aman_pa == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                                DB::table('m_siswa')->where('s_id',$value->id)->update([
                                    'ketuntasan_ijazah'        => "TUNTAS"
                                ]);
                            }
                            else{
                                DB::table('m_siswa')->where('s_id',$value->id)->update([
                                    'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                                ]);
                            }
                        }
                        else{
                            if (($row->tg_keuangan == "LUNAS") && ($row->tg_pondok == "TUNTAS") && ($row->tg_dzikrul == "TUNTAS") && ($row->tg_paper == "TUNTAS") && ($row->tg_perpus == "TUNTAS") && ($row->tg_ujian == "TUNTAS")) {
                                DB::table('m_siswa')->where('s_id',$value->id)->update([
                                    'ketuntasan_ijazah'        => "TUNTAS"
                                ]);
                            }
                            else{
                                DB::table('m_siswa')->where('s_id',$value->id)->update([
                                    'ketuntasan_ijazah'        => "TIDAK TUNTAS"
                                ]);
                            }
                        }
                    }

                }  
                return redirect()->route('view.paper', $th_lulus);   
            }  
        }  
        return back(); 
    }
}
