<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Status;
use App\Models\Pembelian;
use App\Models\TarikUang;
use App\Models\Community;
use App\Models\DetailPembelian;
use App\Models\CommunityMessage;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'koin'=>0,
        'status_id',
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
        return $this->hasMany(kelas::class, 'dibuat_oleh');
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'pengguna_id');
    }
    public function tarikUangs()
    {
        return $this->hasMany(TarikUang::class);
    }
    public function createdCommunities()
    {
        return $this->hasMany(Community::class,'creator_id');
    }
    public function communities()
    {
        return $this->belongsToMany(Community::class,'community_user');
    }
    public function communityMessages()
    {
        return $this->hasMany(CommunityMessage::class);
    }

    public function detailPembelians()
{
    return $this->hasManyThrough(
        detailPembelian::class,
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
        kelas::class,
        detailPembelian::class,
        'pembelian_id',
        'id',
        'id',
        'kelas_id'
    );
}

}
