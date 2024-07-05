<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class CourseEdit extends Component
{
    use WithFileUploads;

    public $course_name;
    public $course_description;
    public $course_difficulty;
    public $course_overview;
    public $course_cover_photo;
    public $course_duration;
    public $course_publish_date;



    public $passed_course;

    public function mount($courseID)
    {
        $this->passed_course = Course::find($courseID);
        $this->course_name = $this->passed_course->course_name;
        $this->course_description = $this->passed_course->course_description;
        $this->course_difficulty = $this->passed_course->course_difficulty;
        $this->course_overview = $this->passed_course->course_overview;
        $this->course_duration = $this->passed_course->course_duration;
        $this->course_publish_date = $this->passed_course->course_publish_date;
    }

    public function updateACourse()
    {
        $this->validate(
            [
                'course_name' => 'required|string|min:3|max:150',
                'course_description' => 'required|string|min:5|max:255',
                'course_difficulty' => 'required|string|min:3|max:50',
                'course_overview' => 'required|string|min:5',
                'course_cover_photo' => 'sometimes|nullable|image|max:4096',
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
                'course_overview.required' => 'Course Overview is required',
                'course_cover_photo.max' => 'Course Cover Photo may not be greater than 4 MB',
                'course_cover_photo.required' => 'Course Cover Photo is required',
                'course_duration.required' => 'Course Duration is required',
            ]
        );

        //check if course cover photo is empty
        if (empty($this->course_cover_photo)) {
            $this->passed_course->update([
                'course_name' => $this->course_name,
                'course_description' => $this->course_description,
                'course_difficulty' => $this->course_difficulty,
                'course_overview' => $this->course_overview,
                'course_duration' => $this->course_duration,
            ]);
        } else {
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

            //delete the original cover photo from passedmusic
            $fileExists = Storage::exists('public/' . $this->passed_course->course_cover_photo);

            if ($fileExists) {
                Storage::delete('public/' . $this->passed_course->course_cover_photo);
            } else {
                //reload the browser
                return redirect()->back();
                exit();
            }

            //Store the updated course in the database
            $this->passed_course->update([
                'course_name' => $this->course_name,
                'course_description' => $this->course_description,
                'course_difficulty' => $this->course_difficulty,
                'course_overview' => $this->course_overview,
                'course_cover_photo' => $this->course_cover_photo->storeAs('courses_cover_photos', $coverphoto_filename, 'public'),
                'course_duration' => $this->course_duration,
            ]);
        }

        return redirect()->route('pages.admin.course.show', $this->passed_course->id)->with('message', 'Course Updated Successfully!');
        $this->dispatch('course-updated');
    }

    public function render()
    {
        return view('livewire.course.course-edit');
    }
}
