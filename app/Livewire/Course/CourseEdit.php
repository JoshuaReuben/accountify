<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class CourseEdit extends Component
{
    public $course;

    public function mount($courseID)
    {
        $this->course = Course::find($courseID);
    }

    public function render()
    {
        return view('livewire.course.course-edit');
    }
}
