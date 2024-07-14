<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithFileUploads;

class CourseCreate extends Component
{

    use WithFileUploads;


    public $course_name;
    public $course_description;
    public $course_difficulty;
    public $course_overview;
    public $course_cover_photo;
    public $course_duration;
    public $course_publish_date;


    public function storeNewCourse()
    {
        $this->validate(
            [
                'course_name' => 'required|string|min:3|max:150',
                'course_description' => 'required|string|min:5|max:255',
                'course_difficulty' => 'required|string|min:3|max:50',
                'course_overview' => 'required|string|min:5',
                'course_cover_photo' => 'required|image|max:4096',
                'course_duration' => 'required|numeric',
            ],
            [
                'course_name.required' => 'Course Name is required',
                'course_name.min' => 'Course Name must be at least 5 characters',
                'course_name.max' => 'Course Name may not be greater than 150 characters',
                'course_description.required' => 'Course Description is required',
                'course_description.min' => 'Course Description must be at least 5 characters',
                'course_description.max' => 'Course Description may not be greater than 255 characters',
                'course_difficulty.required' => 'Course Difficulty is required',
                'course_overview.min' => 'Course Overview must be at least 5 characters',
                'course_cover_photo.max' => 'Course Cover Photo may not be greater than 4 MB',
                'course_overview.required' => 'Course Overview is required',
                'course_cover_photo.required' => 'Course Cover Photo is required',
                'course_cover_photo.mimes' => 'Course Cover Photo must be a file of type: jpeg, jpg, png, webp',
                'course_cover_photo.max' => 'Course Cover Photo may not be greater than 4 MB',
                'course_duration.required' => 'Course Duration is required',
            ]
        );



        //Get The File Name and Extension then Sanitize
        $coverphoto_filename = $this->course_cover_photo->getClientOriginalName();

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

        ////////////////////////// STORING THE COURSE TO DATABASE //////////////////////////

        //Store the song in the database
        Course::create([
            'course_name' => $this->course_name,
            'course_description' => $this->course_description,
            'course_difficulty' => $this->course_difficulty,
            'course_overview' => $this->course_overview,

            // TODO: Delete Images after Delete Course
            'course_cover_photo' => $this->course_cover_photo->storeAs('courses_cover_photos', $coverphoto_filename, 'public'),
            'course_duration' => $this->course_duration,
            'course_publish_date' => $this->course_publish_date,
        ]);

        ////////////////////////// Get the File Size and File Duration //////////////////////////

        $this->reset(['course_name', 'course_description', 'course_difficulty', 'course_overview', 'course_cover_photo', 'course_duration', 'course_publish_date']);
        // session()->flash('message', 'Music Added Successfully!');
        // $this->dispatch('reload-page');
        // return redirect()->route('pages.admin.course')->with('message', 'Course Added Successfully!');
        $this->dispatch('course-created');
    }

    public function render()
    {
        return view('livewire.course.course-create');
    }
}
