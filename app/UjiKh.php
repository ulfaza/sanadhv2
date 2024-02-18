<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UjiKh extends Model
{
    use Notifiable;

	protected $table = 'uji_kh';
	public $timestamps = false;
    protected $primarykey = 'uji_id';

    protected $fillable = [
        'penguji', 'penguji_laju',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class,'id');
    }

    public function kelas()
    {
        return $this->belongsTo(\App\Kelas::class,'k_id');
    }

    public function th_ajar()
    {
        return $this->belongsTo(\App\ThAjar::class,'ta_id');
    }

    public function kh()
    {
        return $this->belongsTo(\App\Kh::class,'kh_id');
    }

    public function rekap_kh()
    {
        return $this->hasMany(\App\RekapKh::class);
    }
}
