<?php

namespace App\Models;

use App\Models\Course;
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
}
