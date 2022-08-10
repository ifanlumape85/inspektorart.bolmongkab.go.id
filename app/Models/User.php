<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik',
        'name',
        'username',
        'email',
        'telpon',
        'password',
        'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'users_id', 'id');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_user', 'id');
    }

    public function isAdmin()
    {
        return $this->is_admin == 'Y';
    }

    public function gravatar($size = 150)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mp&s=" . $size;
    }

    public function layanans()
    {
        return $this->belongsToMany(Layanan::class, 'layanan_users', 'id_layanan', 'id_user');
    }

    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'id_user', 'id');
    }
}
