<?php

namespace App\Livewire\Question;

use Livewire\Component;
use App\Models\Question;
use App\Models\Lesson;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;


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

    // For Determing the Lesson Position
    public $passed_lesson;
    public $fetched_lessons;
    public $lesson_position;

    // For Displaying the Created Quesitions
    public $fetched_questions;


    protected $rules = [
        'question_asked' => 'required|min:5|max:500',
        'correct_answer' => 'required|not_in:Choose correct answer|min:1|max:255',
        'choices.*.choice' => 'required|min:1|max:255',
    ];

    protected $messages = [
        'question_asked.required' => 'Question is required',
        'question_asked.min' => 'Question must be at least 5 characters',
        'question_asked.max' => 'Question may not be greater than 500 characters',
        'correct_answer.required' => 'Correct Answer must be chosen.',
        'correct_answer.not_in' => 'You must select a valid correct answer.',
        'correct_answer.min' => 'Correct Answer must be at least 1 character',
        'choices.*.choice.required' => 'Choice is required',
        'choices.*.choice.min' => 'Choice must be at least 1 characters',
        'choices.*.choice.max' => 'Choice may not be greater than 255 characters',
    ];

    //////////////////////////////////////////////////////////////
    // Variables for the Edit Mode of Question
    public $question_asked_Mode_Edit = [];
    public $question_asked_Mode_Edit_Copy = [];

    public $correct_answer_Mode_Edit = [];
    public $correct_answer_Mode_Edit_Copy = [];

    public $choices_Mode_Edit = [];

    public $choices_Mode_Edit_Copy = [];




    /////////////////////////////////////////////////////////////////
    public function mount($lessonID)
    {
        // Create
        $this->passed_lesson = Lesson::find($lessonID);
        $this->fetched_lessons = $this->passed_lesson->module->lessons()->get();
        //Get the Position Count of passed_lesson
        $position = $this->fetched_lessons->search(function ($lesson) {
            return $lesson->id === $this->passed_lesson->id;
        });
        $this->lesson_position = $position !== false ? $position + 1  : null;

        ///////////////////////////////////////////
        // Display Questions 

        $this->fetched_questions = $this->passed_lesson->questions()->get();
        //////////

        foreach ($this->fetched_questions as $question) {
            $this->question_asked_Mode_Edit[$question->id] = $question->question;
            $this->correct_answer_Mode_Edit[$question->id] = $question->correct_answer;
            $this->choices_Mode_Edit[$question->id] = $question->choices;
        }



        //Backup Variables
        $this->question_asked_Mode_Edit_Copy = $this->question_asked_Mode_Edit;
        $this->correct_answer_Mode_Edit_Copy = $this->correct_answer_Mode_Edit;
        $this->choices_Mode_Edit_Copy = $this->choices_Mode_Edit;

        // dump($this->correct_answer_Mode_Edit[29]);
        // dump($this->choices);
        // dump($this->choices_Mode_Edit);
        // dump($this->choices_Mode_Edit[26]);
    }


    #[On('question-added')]
    public function remountingVars()
    {
        $this->fetched_questions = $this->passed_lesson->questions()->get();
        //////////

        foreach ($this->fetched_questions as $question) {
            $this->question_asked_Mode_Edit[$question->id] = $question->question;
            $this->correct_answer_Mode_Edit[$question->id] = $question->correct_answer;
            $this->choices_Mode_Edit[$question->id] = $question->choices;
        }



        //Backup Variables
        $this->question_asked_Mode_Edit_Copy = $this->question_asked_Mode_Edit;
        $this->correct_answer_Mode_Edit_Copy = $this->correct_answer_Mode_Edit;
        $this->choices_Mode_Edit_Copy = $this->choices_Mode_Edit;
    }



    public function hasAtLeastTwoChoices()
    {
        $nonEmptyChoices = array_filter($this->choices, fn ($choice) => !empty($choice['choice']));
        return count($nonEmptyChoices) >= 2;
    }

    public function hasAtLeastTwoChoices_Mode_Edit($questionID)
    {
        $nonEmptyChoices = array_filter($this->choices_Mode_Edit[$questionID], fn ($choice) => !empty($choice['choice']));
        return count($nonEmptyChoices) >= 2;
    }



    public function addChoice()
    {
        $this->choices[] = ['choice' => ''];
    }

    public function addChoice_Edit_Mode($questionID)
    {
        $this->choices_Mode_Edit[$questionID][] = ['choice' => ''];
        // dump($this->choices_Mode_Edit[26]);

    }

    public function removeChoice($index)
    {
        array_splice($this->choices, $index, 1);
    }

    public function removeChoice_Edit_Mode($questionID, $index)
    {
        array_splice($this->choices_Mode_Edit[$questionID], $index, 1);
    }

    public function cancelEditQuestion()
    {
        // Reset The Variables Only
        $this->question_asked_Mode_Edit = $this->question_asked_Mode_Edit_Copy;
        $this->correct_answer_Mode_Edit = $this->correct_answer_Mode_Edit_Copy;
        $this->choices_Mode_Edit = $this->choices_Mode_Edit_Copy;
    }






    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function lookForDuplicateChoices()
    {
        // Extract the choices into a simple array
        $choiceValues = array_map(function ($item) {
            return $item['choice'];
        }, $this->choices);

        // Count the occurrences of each choice
        $choiceCounts = array_count_values($choiceValues);

        // Find the duplicates
        $hasDuplicates = false;
        foreach ($choiceCounts as $count) {
            if ($count > 1) {
                $hasDuplicates = true;
                break;
            }
        }

        // Return whether there are duplicates
        return $hasDuplicates;
    }



    public function storeQuestion()
    {
        $this->validate();

        $hasDuplicate = $this->lookForDuplicateChoices();

        if ($hasDuplicate) {
            // Add an error message to the component
            $this->addError('choices', 'Each choice must be unique. Duplicate choices are not allowed.');
            return;
        }



        Question::create([
            'lesson_id' => $this->lessonID,
            'question' => $this->question_asked,
            'choices' => $this->choices,
            'correct_answer' => $this->correct_answer,
        ]);

        $this->reset(['question_asked', 'correct_answer', 'choices']);

        // session()->flash('message', 'Question added successfully!');
        // return redirect()->route('pages.admin.question', ['courseID' => $this->courseID, 'moduleID' => $this->moduleID, 'lessonID' => $this->lessonID]);
        $this->dispatch('question-added');
    }

    public function deleteQuestion($questionID)
    {
        $question = Question::find($questionID);
        $question->delete();

        $this->dispatch('question-deleted');
    }

    public function updateAQuestion($questionID)
    {
        $question = Question::find($questionID);
        $question->update([
            'question' => $this->question_asked_Mode_Edit[$questionID],
            'choices' => $this->choices_Mode_Edit[$questionID],
            'correct_answer' => $this->correct_answer_Mode_Edit[$questionID],
        ]);
        $this->dispatch('question-updated');
    }


    #[On('question-updated')]
    #[On('question-added')]
    public function refreshQuestions()
    {
        $this->fetched_questions = $this->passed_lesson->questions()->get();
    }






    #[On('question-deleted')]
    public function render()
    {
        return view('livewire.question.question-create');
    }
}
