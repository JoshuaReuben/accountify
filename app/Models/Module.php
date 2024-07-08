<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;


    protected $fillable = [
        'course_id', 'module_name'
    ];



    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function moduleQuestions()
    {
        return $this->hasOne(ModuleQuestion::class);
    }
}
