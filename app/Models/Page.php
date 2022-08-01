<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'menus_id', 'name', 'slug', 'body', 'image', 'group_id', 'link'
    ];

    protected $hidden = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menus_id', 'id');
    }
}
