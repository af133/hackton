<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_id',
        'user_id',
        'message',
        'file'
    ];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    // Pengirim pesan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
