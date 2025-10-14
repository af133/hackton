<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveClas extends Model
{
    public $timestamps = false;
    protected $table ='sesi_live';
     
    protected $fillable =[
        'kelas_id', 'judul', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'zona_waktu'
    ];
   public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
