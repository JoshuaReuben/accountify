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
                'course_name' => 'required|string|min:5|max:150',
                'course_description' => 'required|string|min:5|max:255',
                'course_difficulty' => 'required|string',
                'course_overview' => 'required|string|min:5',
                'course_cover_photo' => 'required|image|max:4096',
                'course_duration' => 'required',
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
        $coverphoto_filename = $this->songcoverimage->getClientOriginalName();
        $music_filename = $this->songaudiofile->getClientOriginalName();

        //Get The Base Name
        $coverphoto_basename = pathinfo($coverphoto_filename, PATHINFO_FILENAME);
        $music_basename = pathinfo($music_filename, PATHINFO_FILENAME);

        //Get The Extension
        $coverphoto_ext = pathinfo($coverphoto_filename, PATHINFO_EXTENSION);
        $music_ext = pathinfo($music_filename, PATHINFO_EXTENSION);

        //Sanitize the Base Name using Filter Var of FILTER_SANITIZE_STRING then assign back value to orig var
        $coverphoto_filename = filter_var($coverphoto_basename, FILTER_SANITIZE_STRING);
        $music_filename = filter_var($music_basename, FILTER_SANITIZE_STRING);

        //Add Unique Identifiers to the Base Name
        $coverphoto_filename = $coverphoto_filename . '-' . uniqid();
        $music_filename = $music_filename . '-' . uniqid();

        //Merge Back the Extension for the Final File Name
        $coverphoto_filename = $coverphoto_filename . '.' . $coverphoto_ext;
        $music_filename = $music_filename . '.' . $music_ext;

        ////////////////////////// STORING THE MUSIC TO DATABASE

        $music_saved_file_path = $this->songaudiofile->storeAs('musics', $music_filename, 'public');

        //Get the metadata of the song

        //Get the audio path
        $fullUrl = 'storage/' . $music_saved_file_path;
        $audio = Audio::get($fullUrl);

        $audio_filesize = $audio->getAudio()->getFilesize();
        //convert the filesize into mb
        $audio_filesize_in_MB = round($audio_filesize / 1024 / 1024, 2);
        $audio_filesize_in_MB = $audio_filesize_in_MB . ' MB';

        $audio_duration = $audio->getDuration();
        // convert the duration into minutes and seconds
        $audio_duration = gmdate('i:s', $audio_duration);

        //Store the song in the database
        Music::create([
            'song_title' => $this->songtitle,
            'song_artist' => $this->songartist,
            'song_cover_photo' => $this->songcoverimage->storeAs('musics_cover_photos', $coverphoto_filename, 'public'),
            'song_file_path' => $music_saved_file_path,
            'song_duration' => $audio_duration,
            'song_filesize' => $audio_filesize_in_MB,
        ]);

        ////////////////////////// Get the File Size and File Duration //////////////////////////

        $this->reset(['songtitle', 'songartist', 'songcoverimage', 'songaudiofile']);
        session()->flash('message', 'Music Added Successfully!');
        $this->dispatch('reload-page');
    }

    public function render()
    {
        return view('livewire.course.course-create');
    }
}
