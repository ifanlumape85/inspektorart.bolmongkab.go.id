<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'users_id', 'category_id', 'name', 'slug', 'body', 'image'
    ];

    protected $hidden = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
