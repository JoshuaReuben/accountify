<?php

namespace App\Livewire\Lesson;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

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

    public function storeNewlesson()
    {
        $this->validate(
            [
                'lesson_name' => 'required|string|min:3|max:150',
                'lesson_description' => 'required|string|min:5|max:255',
                'lesson_difficulty' => 'required|string|min:3|max:50',
                'lesson_overview' => 'required|string|min:5',
                'lesson_cover_photo' => 'required|image|max:4096',
                'lesson_duration' => 'required|numeric',
            ],
            [
                'lesson_name.required' => 'lesson Name is required',
                'lesson_name.min' => 'lesson Name must be at least 5 characters',
                'lesson_name.max' => 'lesson Name may not be greater than 150 characters',
                'lesson_description.required' => 'lesson Description is required',
                'lesson_description.min' => 'lesson Description must be at least 5 characters',
                'lesson_description.max' => 'lesson Description may not be greater than 255 characters',
                'lesson_difficulty.required' => 'lesson Difficulty is required',
                'lesson_overview.min' => 'lesson Overview must be at least 5 characters',
                'lesson_cover_photo.max' => 'lesson Cover Photo may not be greater than 4 MB',
                'lesson_overview.required' => 'lesson Overview is required',
                'lesson_cover_photo.required' => 'lesson Cover Photo is required',
                'lesson_cover_photo.mimes' => 'lesson Cover Photo must be a file of type: jpeg, jpg, png, webp',
                'lesson_cover_photo.max' => 'lesson Cover Photo may not be greater than 4 MB',
                'lesson_duration.required' => 'lesson Duration is required',
            ]
        );



        //Get The File Name and Extension then Sanitize
        $coverphoto_filename = $this->lesson_cover_photo->getClientOriginalName();

        //Get The Base Name
        $coverphoto_basename = pathinfo($coverphoto_filename, PATHINFO_FILENAME);

        //Get The Extension
        $coverphoto_ext = pathinfo($coverphoto_filename, PATHINFO_EXTENSION);

        //Sanitize the Base Name using Filter Var of FILTER_SANITIZE_STRING then assign back value to orig var
        $coverphoto_filename = filter_var($coverphoto_basename, FILTER_SANITIZE_STRING);

        //Add Unique Identifiers to the Base Name
        $coverphoto_filename = $coverphoto_filename . '-' . uniqid();

        //Merge Back the Extension for the Final File Name
        $coverphoto_filename = $coverphoto_filename . '.' . $coverphoto_ext;

        ////////////////////////// STORING THE LESSON TO DATABASE //////////////////////////

        //Store the song in the database
        Lesson::create([
            'lesson_name' => $this->lesson_name,
            'lesson_description' => $this->lesson_description,
            'lesson_difficulty' => $this->lesson_difficulty,
            'lesson_overview' => $this->lesson_overview,
            'lesson_cover_photo' => $this->lesson_cover_photo->storeAs('lessons_cover_photos', $coverphoto_filename, 'public'),
            'lesson_duration' => $this->lesson_duration,
            'lesson_publish_date' => $this->lesson_publish_date,
        ]);

        ////////////////////////// Get the File Size and File Duration //////////////////////////

        $this->reset(['lesson_name', 'lesson_description', 'lesson_difficulty', 'lesson_overview', 'lesson_cover_photo', 'lesson_duration', 'lesson_publish_date']);
        // session()->flash('message', 'Music Added Successfully!');
        // $this->dispatch('reload-page');
        return redirect()->route('pages.admin.lesson')->with('message', 'lesson Added Successfully!');
    }

    public function storeNewLesson2()
    {
        Lesson::create([
            'module_id' => $this->moduleID,
            'lesson_title' => $this->lesson_title
        ]);
    }




    public function render()
    {
        return view('livewire.lesson.lesson-create');
    }
}
