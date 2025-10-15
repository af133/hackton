<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'status_id',
        'description',
        'profile_photo_path',
        'cv_path',
        'portfolio_path',
        'instagram_url',
        'linkedin_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'dibuat_oleh');
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'pengguna_id');
    }
    public function tarikUangs()
    {
        return $this->hasMany(TarikUang::class);
    }
    public function komunitas()
    {
        return $this->hasMany(Community::class, 'community_user');
    }
    public function createdCommunities()
    {
        return $this->hasMany(Community::class,'creator_id');
    }
    public function communities()
    {
        return $this->belongsToMany(Community::class,'community_user');
    }
    

    public function detailPembelians()
    {
        return $this->hasManyThrough(
            DetailPembelian::class,
            Pembelian::class,
            'user_id',
            'pembelian_id',
            'id',
            'id'
        );
    }

    public function kelasDiikuti()
    {
        return $this->hasManyThrough(
            Kelas::class,
            DetailPembelian::class,
            'pembelian_id',
            'id',
            'id',
            'kelas_id'
        );
    }
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? (new \Cloudinary\Cloudinary())->image($this->profile_photo_path)->toUrl()
            : 'https://i.pravatar.cc/300';
    }

    public function getCvUrlAttribute()
    {
        return $this->cv_path ?: '#';
    }

    public function getPortfolioUrlAttribute()
    {
        return $this->portfolio_path ?: '#';
    }

}
