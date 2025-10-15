<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveCommunity extends Model
{
    protected $table = 'live_communites';
    protected $fillable = [
        'komunitas_id',
        'judul',
        'tanggal',
        'waktu_mulai',
        'zona_waktu',
    ];
    public $timestamps = false;
    public function komunitas()
    {
        return $this->belongsTo(Community::class, 'komunitas_id');
    }
}
