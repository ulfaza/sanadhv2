<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use Notifiable;
    protected $table = 'paper';
    public $timestamps = false;
    protected $primaryKey = 'p_id';


    public $incrementing = true;    

    protected $fillable = [
        'judul', 'judul_ujian', 'rumusan', 'status_acc', 'pembimbing',  'status_paper', 'bimbingan', 'tgl_ujian', 'penguji1', 'penguji2', 'penguasaan', 'sinkron', 'penulisan', 'adab', 'nilai', 'predikat', 'catatan', 'berkas', 'jilid', 'ambil', 'nama_pengambil',
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Siswa::class,'s_id');
    }
}
