<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class UserCourseTable extends Component
{

    public $title = 'Available Courses';
    public $courses;
    public function mount()
    {
        $this->courses = Course::all();
    }


    public function render()
    {
        return view('livewire.course.user-course-table');
    }
}
