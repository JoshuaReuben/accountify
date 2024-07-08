<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'question',
        'choices',
        'correct_answer'
    ];

    protected $casts = [
        'choices' => 'array', // Automatically casts the choices attribute to an array
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
