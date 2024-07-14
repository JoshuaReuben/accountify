<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class CourseTable extends Component
{

    public $title = 'Created Courses';
    public $isCreateCoursePage = false;
    public $courses;
    public function mount()
    {
        $this->courses = Course::all();
    }

    public function deleteACourse(Course $course)
    {
        //Delete the Old Course Photo before Deleting
        $fileExists = Storage::exists('public/' . $course->course_cover_photo);
        if ($fileExists) {
            Storage::delete('public/' . $course->course_cover_photo);
        } else {
            //reload the browser because you are trying to delete a file that somehow doesn't exist
            return redirect()->back();
            exit();
        }


        $course->delete();
        $this->dispatch('course-deleted');
        // return redirect()->route('pages.admin.course')->with('message', 'Course Deleted Successfully');
    }


    // remount vars 
    #[On('course-deleted')]
    #[On('course-created')]
    public function remount_vars()
    {
        $this->courses = Course::all();
    }

    public function render()
    {
        return view('livewire.course.course-table');
    }
}
