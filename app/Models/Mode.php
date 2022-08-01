<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug'
    ];

    protected $hidden = [];

    public function programs()
    {
        return $this->hasMany(Program::class, 'mode_id', 'id');
    }

}
