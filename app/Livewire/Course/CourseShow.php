<?php


namespace App\Livewire\Course;

use App\Models\Course;
use App\Models\Module;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.app')]
class CourseShow extends Component
{

    public $course;

    public $courseID;
    public $module_name = '';

    public $lessonsCount = 0;


    public $EDIT_module_name = [];
    public $EDIT_COPY_module_name = [];



    public function mount($courseID)
    {
        // Find Course
        $this->course = Course::find($courseID);

        // Get Modules of the Course
        $modules = $this->course->modules()->get();

        foreach ($modules as $module) {
            $this->EDIT_module_name[$module->id] = $module->module_name;
        }

        $this->EDIT_COPY_module_name = $this->EDIT_module_name;
        $this->checkLessonsCount();
    }


    // If will use wire:navigate in the future, remember to use events for the lesson created and deleted
    #[On('module-created')]
    #[On('module-deleted')]
    public function checkLessonsCount()
    {
        $this->lessonsCount = 0;
        foreach ($this->course->modules as $module) {
            $this->lessonsCount += $module->lessons->count();
        }
    }



    public function createModule()
    {
        Module::create([
            'course_id' => $this->courseID,
            'module_name' => $this->module_name
        ]);

        $this->reset(['module_name']);
        $this->dispatch('module-created');
    }




    public function cancelEditModule()
    {
        $this->EDIT_module_name = $this->EDIT_COPY_module_name;
    }

    public function saveModuleName(Module $module)
    {
        // $module = Module::find($moduleID);
        $module->update([
            'module_name' => $this->EDIT_module_name[$module->id]
        ]);

        $this->dispatch('module-name-updated');
    }

    public function deleteModule(Module $module)
    {
        $module->delete();
        $this->dispatch('module-deleted');
    }

    public function deleteACourse(Course $course)
    {
        $course->delete();
        return redirect()->route('pages.admin.course')->with('message', 'Course Deleted Successfully');
    }



    #[On('module-created')]
    #[On('module-name-updated')]
    public function refetchModules()
    {
        $modules = $this->course->modules()->get();
        foreach ($modules as $module) {
            $this->EDIT_module_name[$module->id] = $module->module_name;
        }
        $this->EDIT_COPY_module_name = $this->EDIT_module_name;
    }

    public function render()
    {
        return view('livewire.course.course-show');
    }
}
