<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TgSmt extends Model
{
    use Notifiable;
    protected $table = 'tanggungan_smt';
    public $timestamps = false;
    protected $primaryKey = 'tg_id';


    public $incrementing = true;    

    protected $fillable = [
        'keuangan', 'ket_keu', 'k_hijau', 'ket_k_h', 'paper', 'ket_ppr', 'kartu_aksi', 'ketuntasan', 'ujian', 'osis', 'da', 'pmr',
    ];

    public function th_ajar()
    {
        return $this->belongsTo(\App\ThAjar::class,'ta_id');
    }

    public function siswa()
    {
        return $this->belongsTo(\App\Siswa::class,'s_id');
    }
}
