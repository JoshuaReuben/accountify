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
    public $correct_answer;

    public $choices = [
        ['choice' => ''],
        ['choice' => ''],
    ];

    protected $rules = [
        'question_asked' => 'required|min:5|max:500',
        'correct_answer' => 'required|not_in:Choose correct answer|min:3|max:255',
        'choices.*.choice' => 'required|min:3|max:255',
    ];

    protected $messages = [
        'question_asked.required' => 'Question is required',
        'question_asked.min' => 'Question must be at least 5 characters',
        'question_asked.max' => 'Question may not be greater than 500 characters',
        'correct_answer.required' => 'Correct Answer must be chosen.',
        'correct_answer.not_in' => 'You must select a valid correct answer.',
        'choices.*.choice.required' => 'Choice is required',
        'choices.*.choice.min' => 'Choice must be at least 3 characters',
        'choices.*.choice.max' => 'Choice may not be greater than 255 characters',
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function storeQuestion()
    {


        $this->validate();

        Question::create([
            'lesson_id' => $this->lessonID,
            'question' => $this->question_asked,
            'choices' => $this->choices,
            'correct_answer' => $this->correct_answer,
        ]);

        session()->flash('message', 'Question added successfully!');
    }

    public function render()
    {
        return view('livewire.question.question-create');
    }
}
