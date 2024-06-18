<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class CourseTable extends Component
{

    public $courses;
    public function mount()
    {
        $this->courses = Course::all();
    }


    public function render()
    {
        return view('livewire.course.course-table');
    }
}
