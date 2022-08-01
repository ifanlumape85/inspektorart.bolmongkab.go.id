<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'about', 'phone', 'address', 'email', 'opening_hours', 'facebook', 'twitter', 'google_plus', 'google_maps', 'instagram', 'image', 'video_embed', 'departemen_head', 'welcome_speech', 'profil_picture'
    ];

    protected $hidden = [];
}
