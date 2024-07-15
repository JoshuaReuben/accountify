<?php

namespace App\Livewire\Flashcard;

use App\Models\Flashcard;
use App\Models\Lesson;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;


#[Layout('layouts.resource')]
class FlashcardCreate extends Component
{
    public $courseID;
    public $moduleID;
    public $lessonID;


    // For Determing the Lesson Position
    public $passed_lesson;
    public $fetched_lessons;
    public $lesson_position;


    public $flashcard_question;
    public $flashcard_answer;


    public $EDIT_flashcard_question;
    public $EDIT_flashcard_answer;
    public $EDIT_COPY_flashcard_question;
    public $EDIT_COPY_flashcard_answer;

    public $fetched_flashcards;
    public $ARR_fetched_flashcards;



    protected $rules = [
        'flashcard_question' => 'required|min:3|max:500',
        'flashcard_answer' => 'required|min:3|max:500',
    ];

    protected $messages = [
        'flashcard_question.required' => 'Question is required',
        'flashcard_question.min' => 'Question must be at least 5 characters',
        'flashcard_question.max' => 'Question may not be greater than 500 characters',
        'flashcard_answer.required' => 'Answer is required',
        'flashcard_answer.min' => 'Answer must be at least 5 characters',
        'flashcard_answer.max' => 'Answer may not be greater than 500 characters',
    ];

    protected $EDIT_rules = [
        'EDIT_flashcard_question.*' => 'required|min:3|max:500',
        'EDIT_flashcard_answer.*' => 'required|min:3|max:500',
    ];

    protected $EDIT_messages = [
        'EDIT_flashcard_question.*.required' => 'Question is required',
        'EDIT_flashcard_question.*.min' => 'Question must be at least 3 characters',
        'EDIT_flashcard_question.max' => 'Question may not be greater than 500 characters',
        'EDIT_flashcard_answer.*.required' => 'Answer is required',
        'EDIT_flashcard_answer.*.min' => 'Answer must be at least 3 characters',
        'EDIT_flashcard_answer.*.max' => 'Answer may not be greater than 500 characters',
    ];




    public function mount()
    {
        // Create
        $this->passed_lesson = Lesson::find($this->lessonID);
        $this->fetched_lessons = $this->passed_lesson->module->lessons()->get();

        //Get the Position Count of passed_lesson
        $position = $this->fetched_lessons->search(function ($lesson) {
            return $lesson->id === $this->passed_lesson->id;
        });
        $this->lesson_position = $position !== false ? $position + 1  : null;


        // Display Created Flashcards 
        $this->fetched_flashcards = $this->passed_lesson->flashcards()->get();
        $this->ARR_fetched_flashcards = $this->fetched_flashcards->toArray();



        // For Edit Variables
        foreach ($this->fetched_flashcards as $flashcard) {
            $this->EDIT_flashcard_question[$flashcard->id] = $flashcard->flashcard_question;
            $this->EDIT_flashcard_answer[$flashcard->id] = $flashcard->flashcard_answer;
        }


        //Backup Variables
        $this->EDIT_COPY_flashcard_question = $this->EDIT_flashcard_question;
        $this->EDIT_COPY_flashcard_answer = $this->EDIT_flashcard_answer;


        //
    }

    private function trimInputFields()
    {
        $this->flashcard_question = trim($this->flashcard_question);
        $this->flashcard_answer = trim($this->flashcard_answer);
    }


    public function storeFlashcard()
    {
        $this->trimInputFields();
        $this->validate();



        Flashcard::create([
            'lesson_id' => $this->lessonID,
            'flashcard_question' => $this->flashcard_question,
            'flashcard_answer' => $this->flashcard_answer,
        ]);

        $this->reset(['flashcard_question', 'flashcard_answer']);
        $this->dispatch('flashcard-added');
    }

    #[On('flashcard-added')]
    #[On('flashcard-updated')]
    #[On('flashcard-deleted')]
    public function refetchEditVariables()
    {
        $this->fetched_flashcards = $this->passed_lesson->flashcards()->get();
        $this->ARR_fetched_flashcards = $this->fetched_flashcards->toArray();


        // For Edit Variables
        foreach ($this->fetched_flashcards as $flashcard) {
            $this->EDIT_flashcard_question[$flashcard->id] = $flashcard->flashcard_question;
            $this->EDIT_flashcard_answer[$flashcard->id] = $flashcard->flashcard_answer;
        }


        //Backup Variables
        $this->EDIT_COPY_flashcard_question = $this->EDIT_flashcard_question;
        $this->EDIT_COPY_flashcard_answer = $this->EDIT_flashcard_answer;
    }


    public function deleteFlashcard($flashcardID)
    {
        try {
            $flashcard = Flashcard::find($flashcardID);
            if ($flashcard) {
                $flashcard->delete();
                // Dispatch an event to notify that the flashcard has been deleted
                $this->dispatch('flashcard-deleted');
            } else {
                // Dispatch an event if the flashcard was not found
                $this->dispatch('reload-page');
            }
        } catch (\Exception $e) {
            $this->dispatch('reload-page');
        }
    }


    public function cancel_EDIT_Flashcard()
    {
        // Reset The Variables Only
        $this->EDIT_flashcard_question = $this->EDIT_COPY_flashcard_question;
        $this->EDIT_flashcard_answer = $this->EDIT_COPY_flashcard_answer;
    }


    public function updateAFlashcard($flashcardID)
    {
        $flashcard = Flashcard::find($flashcardID);

        // Trim Edit Input Fields
        $this->EDIT_flashcard_question[$flashcardID] = trim($this->EDIT_flashcard_question[$flashcardID]);
        $this->EDIT_flashcard_answer[$flashcardID] = trim($this->EDIT_flashcard_answer[$flashcardID]);


        // Validation 
        $this->validate($this->EDIT_rules, $this->EDIT_messages);

        $flashcard->update([
            'flashcard_question' => $this->EDIT_flashcard_question[$flashcardID],
            'flashcard_answer' => $this->EDIT_flashcard_answer[$flashcardID],
        ]);

        $this->dispatch('flashcard-updated');
    }


    public function render()
    {
        return view('livewire.flashcard.flashcard-create');
    }
}
