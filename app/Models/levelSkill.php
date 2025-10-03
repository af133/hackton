<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class levelSkill extends Model
{
    protected $table = 'level_skills';

    protected $fillable = [
        'tingkatan',
    ];
    public function kelases()
    {
        return $this->hasMany(kelas::class, 'level_id');
    }
}
