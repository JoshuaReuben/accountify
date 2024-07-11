<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Module;
use App\Models\Question;
use App\Models\Flashcard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'lesson_title',
        'lesson_content',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function flashcards()
    {
        return $this->hasMany(Flashcard::class);
    }
}
