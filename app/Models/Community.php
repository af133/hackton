<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'avatar',
        'creator_id',
        'description',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_user');
    }

    public function CommunityUser()
    {
        return $this->hasMany(CommunityUser::class);
    }
    public function live()
    {
        return $this->hasMany(LiveCommunity::class, 'komunitas_id');
    }
    
}
