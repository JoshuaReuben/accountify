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

    public $currentEditModuleID = null;

    public $moduleNameToEdit = [];

    public function mount($courseID)
    {
        $this->courseID = $courseID;
        $this->course = Course::find($courseID);

        $modules = Module::where('course_id', $courseID)->get();
        foreach ($modules as $module) {
            $this->moduleNameToEdit[$module->id] = $module->module_name;
        }

        // dd($this->moduleNameToEdit, $this->moduleNameToEdit[5]);
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

    public function editModule($moduleID)
    {
        $module = Module::find($moduleID);
        $this->currentEditModuleID = $module->id;
        $this->moduleNameToEdit = $module->module_name;
    }

    public function cancelEditModule()
    {
        $this->reset(['currentEditModuleID', 'moduleNameToEdit']);
    }

    public function saveCurrentModuleName($moduleID)
    {
        $module = Module::find($moduleID);
        $module->update([
            'module_name' => $this->moduleNameToEdit
        ]);

        $this->reset(['currentEditModuleID', 'moduleNameToEdit']);
    }

    public function render()
    {
        return view('livewire.course.course-show');
    }
}
