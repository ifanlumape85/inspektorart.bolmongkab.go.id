<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News_tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'news_id', 'tags_id'
    ];

    protected $hidden = [];
}
