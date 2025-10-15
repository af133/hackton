<?php

namespace App\Models;

use Cloudinary\Api\Exception\NotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getKelasThumbnailUrlAttribute()
    {
        if (empty($this->path_gambar)) {
            return asset('images/default-class-image.png');
        }

        try {
            return Storage::disk('cloudinary')->url($this->path_gambar);
        } catch (NotFound $e) {
            return asset('images/default-class-image.png');
        }
    }
    public function sesiLive() {

        return $this->hasMany(LiveClas::class, 'kelas_id');
    }

    public function updateAverageRating()
    {
        $average = $this->detailPembelians()->where('rating', '>', 0)->avg('rating');

        $this->rating = round($average, 1) ?? 0;
        $this->save();
    }
}
