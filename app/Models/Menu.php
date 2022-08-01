<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'body', 'mega_menu', 'position', 'link'
    ];

    protected $hidden = [];

    public function pages()
    {
        return $this->hasMany(Page::class, 'menus_id', 'id');
    }
}
