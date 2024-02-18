<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ThAjar extends Model
{
    use Notifiable;

	protected $table = 'm_th_ajar';
	public $timestamps = false;
    protected $primarykey = 'ta_id';

    protected $fillable = [
        'smt', 'th_ajaran', 'status',
    ];

    public function uji_kh()
    {
        return $this->hasMany(\App\UjiKh::class);
    }
}
