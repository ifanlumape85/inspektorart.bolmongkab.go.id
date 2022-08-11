<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggapanLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_layanan', 'tanggapan'
    ];

    protected $hidden = [];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id');
    }
}
