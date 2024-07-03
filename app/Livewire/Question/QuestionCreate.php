<?php

namespace App\Livewire\Question;

use Livewire\Component;
use App\Models\Question;
use App\Models\Lesson;
use Livewire\Attributes\Layout;

#[Layout('layouts.resource')]
class QuestionCreate extends Component
{
    public $courseID;
    public $moduleID;
    public $lessonID;

    public $question_asked;

    public $choices = [
        ['choice' => ''],
        ['choice' => ''],
    ];

    protected $rules = [
        'choices.*.choice' => 'required|min:3|max:150',
    ];

    public function hasAtLeastTwoChoices()
    {
        $nonEmptyChoices = array_filter($this->choices, fn ($choice) => !empty($choice['choice']));
        return count($nonEmptyChoices) >= 2;
    }



    public function addChoice()
    {
        $this->choices[] = ['choice' => ''];
    }

    public function removeChoice($index)
    {
        array_splice($this->choices, $index, 1);
    }



    // For Determing the Lesson Position
    public $passed_lesson;
    public $fetched_lessons;
    public $lesson_position;

    public function mount($lessonID)
    {
        // $arr = ['one', 'two', 'three', 'four', 'five'];
        // $arr[1] = 'six';
        // dd($arr[1]);

        $this->passed_lesson = Lesson::find($lessonID);
        $this->fetched_lessons = $this->passed_lesson->module->lessons()->get();
        //Get the Position Count of passed_lesson
        $position = $this->fetched_lessons->search(function ($lesson) {
            return $lesson->id === $this->passed_lesson->id;
        });
        $this->lesson_position = $position !== false ? $position + 1  : null;
    }

    public function storeQuestion()
    {
        Question::create([
            'lesson_id' => $this->lessonID,
        ]);
    }

    public function render()
    {
        return view('livewire.question.question-create');
    }
}
