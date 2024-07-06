<?php

namespace App\Livewire\Lesson;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.resource')]
class LessonShow extends Component
{
    //Route Params
    public $courseID;
    public $moduleID;
    public $lessonID;

    public $passed_lesson;
    public $fetched_lessons;
    public $lesson_position;

    public function mount($lessonID)
    {
        $this->passed_lesson = Lesson::find($lessonID);
        $this->fetched_lessons = $this->passed_lesson->module->lessons()->get();
        //Get the Position Count of passed_lesson
        $position = $this->fetched_lessons->search(function ($lesson) {
            return $lesson->id === $this->passed_lesson->id;
        });
        $this->lesson_position = $position !== false ? $position + 1  : null;
    }

    public function deleteLesson($lessonID)
    {

        $lesson = Lesson::find($lessonID);
        $lesson->delete();

        session(['message' => 'You have successfully deleted a Lesson.']);
        return redirect()->route('pages.admin.course.show', ['courseID' => $this->courseID]);
    }

    public function render()
    {
        return view('livewire.lesson.lesson-show');
    }
}
