<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jenis', 'id_jenis_layanan', 'id_user', 'deskripsi'
    ];

    protected $hidden = [];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis', 'id');
    }

    public function jenis_layanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'id_jenis_layanan', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'layanan_users', 'id_layanan', 'id_user');
    }
}
