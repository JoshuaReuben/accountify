<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
