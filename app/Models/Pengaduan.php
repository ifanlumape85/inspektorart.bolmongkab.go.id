<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul', 'uraian', 'lokasi', 'waktu', 'penyebab', 'proses', 'kerugian', 'bukti', 'id_user'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function pihak_terkait()
    {
        return $this->hasMany(PihakTerkait::class, 'id_pengaduan', 'id');
    }

    public function tanggapan()
    {
        return $this->hasMany(TanggapanPengaduan::class, 'id_pengaduan', 'id');
    }
}
