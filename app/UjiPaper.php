<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UjiPaper extends Model
{
    use Notifiable;
    protected $table = 'uji_paper';
    public $timestamps = false;
    protected $primaryKey = 'up_id';


    public $incrementing = true;    

    protected $fillable = [
        'tahun_ajar', 'gel', 'tgl', 
    ];
}
