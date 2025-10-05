<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $fillable = ['class_id', 'title', 'description'];
    protected $table = 'moduls';
    public function lessons() {
        return $this->hasMany(Lesson::class,'module_id');
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'class_id');
    }
}
