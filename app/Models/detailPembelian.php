<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailPembelian extends Model
{
    protected $table = 'detail_pembelians';
    protected $fillable = [
        'pembelian_id',
        'kelas_id',
        'tanggal_pembelian',
    ];
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }

    
}
