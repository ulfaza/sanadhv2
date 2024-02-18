<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use Notifiable;
    protected $table = 'm_kelas';
    public $timestamps = false;
    protected $primaryKey = 'k_id';
    
    protected $fillable = [
        'wali', 'tingkat', 'k_nama', 'penguji_dzikrul'
    ];

    public function siswa()
    {
        return $this->hasMany(\App\Siswa::class);
    }

    public function uji_kh()
    {
        return $this->hasMany(\App\UjiKh::class);
    }
}
