<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Kh extends Model
{
	use Notifiable;

	protected $table = 'm_kh';
	public $timestamps = false;
    protected $primarykey = 'kh_id';

    protected $fillable = [
        'kh_nama', 'singkatan', 'kkm', 'aspek1', 'aspek2', 'aspek3', 'aspek4', 'max_a1', 'max_a2', 'max_a3', 'max_a4',
    ];

    public function uji_kh()
    {
        return $this->hasMany(\App\UjiKh::class);
    }
}
