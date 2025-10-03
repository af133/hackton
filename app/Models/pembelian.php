<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pembelian extends Model
{
    protected $table = 'pembelians';
    protected $fillable = [
        'user_id',
        'total_koin',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function detailPembelians()
    {
        return $this->hasMany(detailPembelian::class, 'pembelian_id');
    }
}