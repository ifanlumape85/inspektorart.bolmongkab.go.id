<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggapanPengaduan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pengaduan', 'tanggapan'
    ];

    protected $hidden = [];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id');
    }
}
