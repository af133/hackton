<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badge extends Model
{
    protected $fillable = ['key', 'name', 'description', 'icon_path', 'type'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_badge')
                    ->withPivot('progress', 'unlocked_at')
                    ->withTimestamps();
    }
}
