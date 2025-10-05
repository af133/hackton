<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelass';

    protected $fillable = [
        'judul_kelas',
        'deskripsi',
        'kategori',
        'path_gambar',
        'level_kelas',
        'harga_koin',
        'tags',
        'is_draft',
        'rating',
        'dibuat_oleh',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_draft' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class, 'kelas_id');
    }
    public function moduls() {
        return $this->hasMany(Modul::class, 'class_id');
    }
}
