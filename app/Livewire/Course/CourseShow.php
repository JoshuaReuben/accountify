<?php


namespace App\Livewire\Course;

use App\Models\Course;
use App\Models\Module;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CourseShow extends Component
{

    public $course;

    public $courseID;
    public $module_name = '';


    public $moduleNameToEdit = [];
    public $CopyModuleNameToEdit = [];

    public function mount($courseID)
    {
        $this->courseID = $courseID;
        $this->course = Course::find($courseID);

        $modules = Module::where('course_id', $courseID)->get();
        foreach ($modules as $module) {
            $this->moduleNameToEdit[$module->id] = $module->module_name;
        }

        $this->CopyModuleNameToEdit = $this->moduleNameToEdit;
    }



    public function createModule()
    {
        Module::create([
            'course_id' => $this->courseID,
            'module_name' => $this->module_name
        ]);

        $this->reset(['module_name']);
        $this->dispatch('module-created');
        $this->dispatch('sendEvent');
    }



    public function cancelEditModule()
    {
        $this->moduleNameToEdit = $this->CopyModuleNameToEdit;
    }

    public function saveModuleName(Module $module)
    {
        // $module = Module::find($moduleID);
        $module->update([
            'module_name' => $this->moduleNameToEdit[$module->id]
        ]);

        // $this->CopyModuleNameToEdit = $this->moduleNameToEdit[$module->id];
        $this->moduleNameToEdit = $this->CopyModuleNameToEdit;


        $this->dispatch('module-name-updated');
    }

    public function deleteModule($moduleID)
    {
        $module = Module::find($moduleID);
        $module->delete();
        $this->dispatch('module-deleted');
    }

    public function deleteACourse(Course $course)
    {
        $course->delete();
        return redirect()->route('pages.admin.course')->with('message', 'Course Deleted Successfully');
    }

    public function render()
    {
        return view('livewire.course.course-show');
    }
}
