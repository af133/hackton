<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    public $timestamps = false;
    protected $table = 'detail_pembelians';
    protected $fillable = [
        'pembelian_id',
        'kelas_id',
        'rating',
        'tanggal_pembelian',
    ];
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    
}
