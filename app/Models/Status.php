<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    // Nama tabel (kalau tidak sama dengan jamak dari nama model)
    protected $table = 'statuss';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama_status',
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }    

    
}
