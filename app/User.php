<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primarykey = 'id';

    protected $fillable = [
        'nama', 'username', 'foto', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const ADMIN_TYPE = 'admin';
    const USERS_TYPE = 'guru';
    const PANITIA_TYPE = 'panitia';
    const SISWA_TYPE = 'siswa';
    const PERPUS_TYPE = 'perpus';
    const PONDOK_TYPE = 'pondok';
    const PAPER_TYPE = 'paper';
    const KEAMANAN_TYPE = 'keamanan';
    const BP_TYPE = 'bp';

    public function isAdmin() {
        return $this->role === self::ADMIN_TYPE;
    }

    public function isUser() {
        return $this->role === self::USERS_TYPE;
    }

    public function isPanitia() {
        return $this->role === self::PANITIA_TYPE;
    }

    public function isSiswa() {
        return $this->role === self::SISWA_TYPE;
    }

    public function isPerpus() {
        return $this->role === self::PERPUS_TYPE;
    }

    public function isPondok() {
        return $this->role === self::PONDOK_TYPE;
    }

    public function isPaper() {
        return $this->role === self::PAPER_TYPE;
    }

    public function isKeamanan() {
        return $this->role === self::KEAMANAN_TYPE;
    }

    public function isBp() {
        return $this->role === self::BP_TYPE;
    }

    public function uji_kh()
    {
        return $this->hasMany(\App\UjiKh::class);
    }
}
