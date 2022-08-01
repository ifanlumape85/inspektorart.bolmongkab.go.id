<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    use HasFactory;
    protected $table = 'perizinan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_perizinan',
        'slug',
        'persyaratan',
        'cara_penanganan',
        'waktu',
        'biaya'
    ];
}
