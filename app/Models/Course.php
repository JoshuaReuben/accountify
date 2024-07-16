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



    public function checkLessonsCount()
    {
        $lessonsCount = 0;
        foreach ($this->modules as $module) {
            $lessonsCount += $module->lessons->count();
        }

        return $lessonsCount;
    }

    public function isCourseReadyToPublish()
    {
        // Check Course Exam Question Count
        if ($this->courseQuestions()->count() == 0) {
            return false;
        }

        // Check Module Count
        if ($this->modules->count() == 0) {
            return false;
        }

        // Check Module Exam Count
        foreach ($this->modules as $module) {
            if ($module->moduleQuestions()->count() == 0) {
                return false;
            }
        }

        // Check Lesson Count
        if ($this->checkLessonsCount() == 0) {
            return false;
        }

        // Check Lesson Questions Count
        foreach ($this->modules as $module) {
            foreach ($module->lessons as $lesson) {
                if ($lesson->questions->count() == 0) {
                    return false;
                }
            }
        }

        // Check Flashcards Count
        foreach ($this->modules as $module) {
            foreach ($module->lessons as $lesson) {
                if ($lesson->flashcards->count() == 0) {
                    return false;
                }
            }
        }

        // Otherwise, return true
        return true;
    }
}
