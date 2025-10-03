<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['module_id', 'title', 'type', 'content'];

    public function module() {
        return $this->belongsTo(Modul::class);
    }
}
