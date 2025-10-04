<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['lesson_id', 'user_id', 'content'];

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
