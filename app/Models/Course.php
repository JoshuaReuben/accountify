<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


    protected $fillable = [
        'course_name',
        'course_description',
        'course_difficulty',
        'course_overview',
        'course_cover_photo',
        'course_duration',
        'course_publish_date',
    ];
}
