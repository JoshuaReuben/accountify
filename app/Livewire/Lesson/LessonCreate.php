<?php

namespace App\Livewire\Lesson;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[Layout('layouts.resource')]
class LessonCreate extends Component
{


    use WithFileUploads;



    public $lesson_title;

    public $courseID;
    public $moduleID;
    public $passed_course;
    public $passed_module;
    public $module_position;

    public $fetched_modules;
    public $fetched_lessons;

    public function mount($courseID, $moduleID)
    {
        $this->passed_course = Course::find($courseID);
        $this->passed_module = Module::find($moduleID);

        $this->fetched_modules = $this->passed_course->modules()->get();
        $this->fetched_lessons = $this->passed_module->lessons()->get();

        // Find the position of the passed_module in the fetched_modules collection
        $position = $this->fetched_modules->search(function ($module) {
            return $module->id === $this->passed_module->id;
        });

        // dd($position + 1);

        // Set the position to a property for easy access
        $this->module_position = $position !== false ? $position + 1  : null;
    }



    public function render()
    {
        return view('livewire.lesson.lesson-create');
    }
}
