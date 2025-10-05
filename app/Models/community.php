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

    // Relasi pembuat komunitas
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // Relasi anggota komunitas
    public function users()
    {
        return $this->belongsToMany(User::class, 'community_user');
    }

    // Relasi pesan komunitas
    public function messages()
    {
        return $this->hasMany(CommunityMessage::class);
    }
}
