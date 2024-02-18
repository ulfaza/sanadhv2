<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Input;  
use Excel;
use File;
use Validator;
use Redirect;
use App\User;
use App\Kelas;
use App\Siswa;
use App\TgSmt;

class SiswaController extends Controller
{
    public function index($k_id){
    	$data['no'] = 1;
        $kelas = DB::table('m_kelas')
            ->where('k_id',$k_id)
            ->get();
        $siswa = DB::table('m_siswa')
        	->join('m_kelas', 'm_kelas.k_id', '=', 'm_siswa.k_id')
        	->where('m_siswa.k_id',$k_id)
        	->get();
        $data['kelas'] = $kelas;
        $data['siswa'] = $siswa;  
        return view('/admin/siswa/index',$data);
    }

    public function insert($k_id)
    {
        $kelas = DB::table('m_kelas')
            ->where('k_id',$k_id)
            ->get();
            
        $data['kelas'] = $kelas;
        return view('/admin/siswa/insert',$data);
    }

    public function store(Request $request, $k_id)
    {
        $siswa = new Siswa;
        $siswa->k_id    = $request->k_id;
        $siswa->nis     = $request->nis;
        $siswa->nisn    = $request->nisn;
        $siswa->s_nama  = $request->s_nama;
        $siswa->status  = $request->status;
        $siswa->jenis_kel = $request->jenis_kel;
        $siswa->transkrip_kh = NULL;
        $siswa->th_lulus = NULL;
        $siswa->alamat = NULL;
        $siswa->ketuntasan_ijazah = "TIDAK TUNTAS";
        $siswa->tg_keuangan = "BELUM LUNAS";
        $siswa->bukti_perpus = NULL;
        $siswa->nominal = NULL;
        $siswa->ket_keuangan = NULL;
        $siswa->tg_pondok = "TIDAK TUNTAS";
        $siswa->nominal_pondok = NULL;
        $siswa->bukti_pondok = NULL;
        $siswa->ket_pondok = NULL;
        $siswa->tg_aman_pa = "TIDAK TUNTAS";
        $siswa->nominal_aman_pa = NULL;
        $siswa->bukti_aman_pa = NULL;
        $siswa->ket_aman_pa = NULL;
        $siswa->tg_dzikrul = "TIDAK TUNTAS";
        $siswa->nilai_dzikrul = NULL;
        $siswa->real_dzikrul = NULL;
        $siswa->tg_paper = "BELUM UJIAN";
        $siswa->ket_paper = NULL;
        $siswa->tg_perpus = "TIDAK TUNTAS";
        $siswa->denda_perpus = NULL;
        $siswa->ket_perpus = NULL;
        $siswa->status_ijazah = "BELUM TERAMBIL";
        $siswa->pengambil = NULL;

        if ($siswa->save()){
            $rekapkh = DB::table('uji_kh')
                ->where('uji_kh.k_id',$k_id)
                ->get();
            foreach ($rekapkh as $row){
                DB::table('rekap_kh')->insert([
                  ['uji_id' => $row->uji_id, 
                    's_id' => $siswa->s_id,
                    'nilai_a1' => NULL,
                    'nilai_a2' => NULL,
                    'nilai_a3' => NULL,
                    'nilai_a4' => NULL,
                    'total' => NULL,
                    'kriteria' => "TIDAK TUNTAS",
                   'nama_penguji' => NULL
                  ],
                ]);
            } 
            $thaktif = DB::table('m_th_ajar')
                ->where('status',"AKTIF")
                ->get();
            foreach ($thaktif as $row){
                $ta_id = $row->ta_id;
            }
            $sis = DB::table('m_kelas')
                ->join('m_siswa', 'm_kelas.k_id', '=', 'm_siswa.k_id')
                ->where('m_siswa.s_id',$siswa->s_id)
                ->get();
            foreach($sis as $s){
                if ($s->tingkat == "10") {
                  DB::table('tanggungan_smt')->insert([
                    ['ta_id' => $ta_id,
                     's_id' => $siswa->s_id,
                     'keuangan' => "TIDAK TUNTAS",
                     'ket_keu' => NULL,
                     'k_hijau' => "TIDAK TUNTAS",
                     'ket_k_h' => NULL,
                     'paper' => "BELUM",
                     'ket_ppr' => NULL,
                     'kartu_aksi' => "TIDAK PUNYA",
                     'osis' => "TUNTAS",
                     'da' => "TUNTAS",
                     'pmr' => "TUNTAS",
                     'ketuntasan' => "TIDAK TUNTAS"
                    ],
                  ]);
                }
                else if (($s->tingkat == "11") or ($s->tingkat == "12")) {
                  DB::table('tanggungan_smt')->insert([
                    ['ta_id' => $ta_id,
                     's_id' => $siswa->s_id,
                     'keuangan' => "TIDAK TUNTAS",
                     'ket_keu' => NULL,
                     'k_hijau' => "TIDAK TUNTAS",
                     'ket_k_h' => NULL,
                     'paper' => "TIDAK TUNTAS",
                     'ket_ppr' => NULL,
                     'kartu_aksi' => "TIDAK PUNYA",
                     'osis' => "TUNTAS",
                     'da' => "TUNTAS",
                     'pmr' => "TUNTAS",
                     'ketuntasan' => "TIDAK TUNTAS"
                    ],
                  ]);
                }
            }
            
            DB::table('paper')->insert([
                ['siswa_s_id' => $siswa->s_id,
                 'judul' => NULL,
                 'rumusan' => NULL,
                 'status_acc' => "BELUM ACC",
                 'pembimbing' => NULL,
                 'status_paper' => "BELUM ACC",
                 'bimbingan' => NULL,
                 'tgl_ujian' => NULL,
                 'penguji1' => NULL,
                 'penguji2' => NULL,
                 'penguasaan' => NULL,
                 'sinkron' => NULL,
                 'penulisan' => NULL,
                 'adab' => NULL,
                 'nilai' => NULL,
                 'predikat' => NULL,
                 'catatan' => NULL,
                 'jilid' => NULL,
                 'ambil' => NULL,
                 'nama_pengambil' => NULL
                ],
            ]);
            return redirect()->route('siswa',$k_id);
        }
        else{
            return redirect()->route('insert.siswa',$k_id);
        } 
    }

    public function edit($id)
    {
        $siswa = DB::table('m_siswa')
            ->where('s_id',$id)
            ->get();
        $data['siswa'] = $siswa;
        return view('/admin/siswa/edit',$data);
    }

    public function update(Request $request, $s_id, $k_id){
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'nis'   => $request->nis,
            'nisn'  => $request->nisn,
            's_nama'=> $request->s_nama,
            'status'=> $request->status
        ]);           
        return redirect()->route('siswa', $k_id);
    }

    public function delete($s_id, $k_id){
        $kelas = Siswa::findOrFail($s_id)->delete();
        return redirect()->route('siswa', $k_id);
    }

    public function cari(Request $request){
        $siswa = DB::table('m_siswa')
            ->join('kelas_12', 'm_siswa.s_id', '=', 'kelas_12.s_id')
            ->where('m_siswa.nis', $request->nis)
            ->get();
        $data['siswa'] = $siswa;
        return view('/isidata',$data);
    }

    public function datadiri(Request $request, $s_id){
        if($request->hasFile('foto')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('foto12/'.$datalama->foto);
            
            $file = $request->file('foto');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'foto12';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'foto'  => $nama_file
            ]);  
        }

        if($request->hasFile('ijazah')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('ijazah/'.$datalama->ijazah);
            
            $file = $request->file('ijazah');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'ijazah';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'ijazah'  => $nama_file
            ]);  
        }

        DB::table('m_siswa')->where('s_id',$s_id)->update([
            's_nama'=> $request->s_nama
        ]);  
        DB::table('kelas_12')->where('s_id',$s_id)->update([
            'no_hp'   => $request->no_hp,
            'email'  => $request->email
        ]);  
        $siswa = DB::table('kelas_12')
            ->where('s_id', $request->s_id)
            ->get();

        $data['siswa'] = $siswa;
        return view('/data_ortu',$data);
    }

    public function dataortu(Request $request, $s_id){
        if($request->hasFile('kk')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('kk/'.$datalama->kk);
            
            $file = $request->file('kk');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'kk';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'kk'  => $nama_file
            ]);  
        }
        DB::table('kelas_12')->where('s_id',$s_id)->update([
            'tg_ortu'   => $request->tg_ortu,
            'penghasilan_ayah'   => $request->penghasilan_ayah,
            'penghasilan_ibu'  => $request->penghasilan_ibu
        ]);  
        $siswa = DB::table('kelas_12')
            ->where('s_id', $request->s_id)
            ->get();

        $data['siswa'] = $siswa;
        return view('/berkas_siswa',$data);
    }

    public function berkasrapor(Request $request, $s_id){
        if($request->hasFile('rapor_smt1')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('rapor1/'.$datalama->rapor_smt1);
            
            $file = $request->file('rapor_smt1');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'rapor1';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'rapor_smt1'  => $nama_file
            ]);  
        }

        if($request->hasFile('rapor_smt2')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('rapor2/'.$datalama->rapor_smt2);
            
            $file = $request->file('rapor_smt2');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'rapor2';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'rapor_smt2'  => $nama_file
            ]);  
        }

        if($request->hasFile('rapor_smt3')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('rapor3/'.$datalama->rapor_smt3);
            
            $file = $request->file('rapor_smt3');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'rapor3';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'rapor_smt3'  => $nama_file
            ]);  
        }

        if($request->hasFile('rapor_smt4')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('rapor4/'.$datalama->rapor_smt4);
            
            $file = $request->file('rapor_smt4');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'rapor4';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'rapor_smt4'  => $nama_file
            ]);  
        }

        if($request->hasFile('rapor_smt5')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('rapor5/'.$datalama->rapor_smt5);
            
            $file = $request->file('rapor_smt5');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'rapor5';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'rapor_smt5'  => $nama_file
            ]);  
        }

        if($request->hasFile('sertif')){ 
            $datalama = DB::table('kelas_12')->where('s_id',$s_id)->first();
            File::delete('sertif/'.$datalama->sertif);
            
            $file = $request->file('sertif');
     
            $nama_file = time()."_".$file->getClientOriginalName();
           
            $tujuan_upload = 'sertif';
            $file->move($tujuan_upload,$nama_file);

            DB::table('kelas_12')->where('s_id',$s_id)->update([
                'sertif'  => $nama_file
            ]);  
        }

        $siswa = DB::table('kelas_12')
            ->where('s_id', $request->s_id)
            ->get();

        $data['siswa'] = $siswa;
        return view('/blok_verif',$data);
    }

    public function selesai(Request $request, $s_id){ 
        $siswa = DB::table('m_siswa')
            ->where('s_id', $request->s_id)
            ->get();

        $data['siswa'] = $siswa;
        return view('/selesai',$data);
    }

    public function pindah($id)
    {
        $siswa = DB::table('m_siswa')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'm_siswa.k_id')
            ->where('m_siswa.s_id',$id)
            ->get();
        $kelas = DB::table('m_kelas')
            ->get();
        $data['siswa'] = $siswa;
        $data['kelas'] = $kelas;
        return view('/admin/siswa/pindah',$data);
    }

    public function updatekelas(Request $request, $s_id){
        DB::table('m_siswa')->where('s_id',$s_id)->update([
            'k_id'   => $request->kelas_baru
        ]);           
        return redirect()->route('siswa', $request->kelas_baru);
    }

    public function import($k_id)  
    {
        $kelas = DB::table('m_kelas')
            ->where('k_id',$k_id)
            ->get();
        $data['kelas'] = $kelas;
        return view('/admin/siswa/import',$data);  
    }

    public function importExcel($k_id)  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    $insert[] = ['k_id' => $k_id, 'nis' => $value->nis,  's_nama' => $value->s_nama, 'nisn' => $value->nisn, 'status' => $value->status, 'jenis_kel' => $value->jenis_kel];  
                }  
                if(!empty($insert)){ 
                    DB::table('m_siswa')->insert($insert);  
                    for ($i=0; $i < sizeof($insert); $i++) { 
                        $siswa = DB::table('m_siswa')
                            ->where('nis',$insert[$i]['nis'])
                            ->get();
                        foreach ($siswa as $row){
                            DB::table('paper')->insert([
                                ['siswa_s_id' => $row->s_id,
                                 'judul' => NULL,
                                 'rumusan' => NULL,
                                 'status_acc' => "BELUM ACC",
                                 'pembimbing' => NULL,
                                 'status_paper' => "BELUM ACC",
                                 'bimbingan' => NULL,
                                 'tgl_ujian' => NULL,
                                 'penguji1' => NULL,
                                 'penguji2' => NULL,
                                 'penguasaan' => NULL,
                                 'sinkron' => NULL,
                                 'penulisan' => NULL,
                                 'adab' => NULL,
                                 'nilai' => NULL,
                                 'predikat' => NULL,
                                 'catatan' => NULL,
                                 'setor' => NULL,
                                 'jilid' => NULL,
                                 'ambil' => NULL,
                                 'nama_pengambil' => NULL
                                ],
                            ]);
                        }
                    }
                    return redirect()->route('siswa', $k_id);  
                }  
            }  
        }  
        return back();  
    }
}
