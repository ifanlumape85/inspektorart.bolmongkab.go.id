<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_layanan', 'id_user', 'catatan'
    ];

    protected $hidden = [];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id');
    }
}
