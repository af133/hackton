<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelass';

    protected $fillable = [
        'nama_kelas',
        'level_id',
        'harga_koin',
        'Keterangan',
        'durasi_jam',
        'rating',
        'tanggal_kelas',
        'dibuat_oleh',
    ];

    public function levelSkill()
    {
        return $this->belongsTo(levelSkill::class, 'level_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
    public function detailPembelians()
    {
        return $this->hasMany(detailPembelian::class, 'kelas_id');
    }

}
