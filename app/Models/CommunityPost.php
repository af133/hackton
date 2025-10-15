<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityPost extends Model
{
    protected $fillable = ['community_id', 'user_id', 'content', 'image_url'];

    public function community() {
        return $this->belongsTo(Community::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(CommunityPostReply::class, 'post_id');
    }
}
