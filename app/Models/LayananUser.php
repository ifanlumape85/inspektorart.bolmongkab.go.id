<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_layanan', 'id_user'
    ];

    protected $hidden = [];
}
