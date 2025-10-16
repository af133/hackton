<?php
namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getAvatarUrlAttribute(): string
    {

        if ($this->avatar) {
            try {
                return Storage::disk('cloudinary')->url($this->avatar);

            } catch (\Exception $e) {
                Log::error('Gagal membuat URL Cloudinary untuk avatar komunitas.', [
                    'community_id' => $this->id,
                    'avatar_path' => $this->avatar,
                    'error' => $e->getMessage()
                ]);

            }
        }
        return asset('images/default-class-image.png');
    }

}
