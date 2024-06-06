<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;


    protected $fillable = [
        'song_title',
        'song_artist',
        'song_cover_photo',
        'song_file_path',
    ];
}
