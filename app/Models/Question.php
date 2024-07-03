<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;


class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'question',
        'choices',
        'correct_answer'
    ];

    protected $casts = [
        'choices' => 'array', // Automatically casts the choices attribute to an array
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
