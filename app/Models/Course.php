<?php

namespace App\Models;

use App\Models\Module;
use App\Models\CourseQuestion;
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

    public function courseQuestions()
    {
        return $this->hasOne(CourseQuestion::class);
    }


    // Property to hold the lessons count
    public $lessonsCount = 0;

    public function checkLessonsCount()
    {
        $this->lessonsCount = 0;
        foreach ($this->modules as $module) {
            $this->lessonsCount += $module->lessons->count();
        }

        return $this->lessonsCount;
    }
}
