<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use Notifiable;
    protected $table = 'm_siswa';
    public $timestamps = false;
    protected $primaryKey = 's_id';


    public $incrementing = true;    

    protected $fillable = [
        's_nama', 'nis', 'nisn', 'status', 'transkrip_kh', 'th_lulus', 'alamat', 'status_lulus', 'tg_keuangan', 'ket_keuangan', 'tg_pondok', 'ket_pondok', 'tg_kh', 'ket_kh', 'tg_dzikrul', 'nilai_dzikrul', 'real_dzikrul', 'tg_paper', 'ket_paper', 'tg_perpus', 'denda_perpus', 'ket_perpus', 'status_ijazah'
    ];

    public function kelas()
    {
        return $this->belongsTo(\App\Kelas::class,'k_id');
    }

    public function rekap_kh()
    {
        return $this->hasMany(\App\RekapKh::class);
    }

    public function paper()
    {
        return $this->hasOne('App\Paper');
    }
}

