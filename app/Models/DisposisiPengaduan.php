<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiPengaduan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pengaduan', 'id_user', 'catatan'
    ];

    protected $hidden = [];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id');
    }
}
