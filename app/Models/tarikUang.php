<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarikUang extends Model
{
    protected $table = 'tarik_uangs';

    protected $fillable = [
        'user_id',
        'detail_pembelian_id',
        'jumlah_tarik',
        'status'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke DetailPembelian
    public function detailPembelian()
    {
        return $this->belongsTo(DetailPembelian::class, 'detail_pembelian_id');
    }
}
