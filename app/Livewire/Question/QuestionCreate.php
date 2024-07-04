<?php

namespace App\Livewire\Question;

use Livewire\Component;
use App\Models\Question;
use App\Models\Lesson;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;


// Logs
// trailing spaces should not be treated as value
// long text on question don't wrap - but not responsive (fixed on previous commit)
// auto re-fetch (fixed on previous commit)
// trailing spaces fixed
// validation rules on edit mode done
// 


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

    protected $EDIT_rules = [
        'EDIT_question_asked.*' => 'required|min:5|max:500',
        'EDIT_correct_answer.*' => 'required|not_in:Choose correct answer|min:1|max:255',
        'EDIT_choices.*.*.choice' => 'required|min:1|max:255',
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

    protected $EDIT_messages = [
        'EDIT_question_asked.*.required' => 'Editing Question is required',
        'EDIT_question_asked.*.min' => 'Editing Question must be at least 5 characters',
        'EDIT_question_asked.*.max' => 'Editing Question may not be greater than 500 characters',
        'EDIT_correct_answer.*.required' => 'Correct Answer must be chosen while Editing.',
        'EDIT_correct_answer.*.not_in' => 'You must select a valid correct answer while Editing.',
        'EDIT_correct_answer.*.min' => 'Correct Answer must be at least 1 character while Editing',
        'EDIT_choices.*.*.choice.required' => 'Choice is required while Editing',
        'EDIT_choices.*.*.choice.min' => 'Choice must be at least 1 characters while Editing.',
        'EDIT_choices.*.*.choice.max' => 'Choice may not be greater than 255 characters while Editing.',
    ];


    //////////////////////////////////////////////////////////////
    // Variables for the Edit Mode of Question
    public $EDIT_question_asked = [];
    public $EDIT_COPY_question_asked = [];

    public $EDIT_correct_answer = [];
    public $EDIT_COPY_correct_answer = [];

    public $EDIT_choices = [];

    public $EDIT_COPY_choices = [];




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
            $this->EDIT_question_asked[$question->id] = $question->question;
            // $this->EDIT_correct_answer[$question->id] = $question->correct_answer;
            $this->EDIT_correct_answer[$question->id] = [];
            $this->EDIT_choices[$question->id] = $question->choices;
        }



        //Backup Variables
        $this->EDIT_COPY_question_asked = $this->EDIT_question_asked;
        $this->EDIT_COPY_correct_answer = $this->EDIT_correct_answer;
        $this->EDIT_COPY_choices = $this->EDIT_choices;

        // dump($this->EDIT_correct_answer[29]);
        // dump($this->choices);
        // dump($this->EDIT_choices);
        // dump($this->EDIT_choices[26]);
        // dump($this->EDIT_choices[6][0]['choice']);
    }

    private function trimChoices()
    {
        foreach ($this->choices as $index => $choice) {
            $this->choices[$index]['choice'] = trim($choice['choice']);
        }
    }

    private function EDIT_trimChoices($questionID)
    {
        foreach ($this->EDIT_choices[$questionID] as $index => $choice) {
            $this->EDIT_choices[$questionID][$index]['choice'] = trim($choice['choice']);
        }
    }


    #[On('question-added')]
    public function remountingVars()
    {
        $this->fetched_questions = $this->passed_lesson->questions()->get();
        //////////

        foreach ($this->fetched_questions as $question) {
            $this->EDIT_question_asked[$question->id] = $question->question;
            // $this->EDIT_correct_answer[$question->id] = $question->correct_answer;
            $this->EDIT_correct_answer[$question->id] = [];
            $this->EDIT_choices[$question->id] = $question->choices;
        }



        //Backup Variables
        $this->EDIT_COPY_question_asked = $this->EDIT_question_asked;
        $this->EDIT_COPY_correct_answer = $this->EDIT_correct_answer;
        $this->EDIT_COPY_choices = $this->EDIT_choices;
    }



    public function hasAtLeastTwoChoices()
    {
        $nonEmptyChoices = array_filter($this->choices, fn ($choice) => !empty($choice['choice']));
        return count($nonEmptyChoices) >= 2;
    }

    public function hasAtLeastTwoEDIT_choices($questionID)
    {
        $nonEmptyChoices = array_filter($this->EDIT_choices[$questionID], fn ($choice) => !empty($choice['choice']));
        return count($nonEmptyChoices) >= 2;
    }



    public function addChoice()
    {
        $this->choices[] = ['choice' => ''];
    }

    public function addChoice_Edit_Mode($questionID)
    {
        $this->EDIT_choices[$questionID][] = ['choice' => ''];
        // dump($this->EDIT_choices[26]);

    }

    public function removeChoice($index)
    {
        array_splice($this->choices, $index, 1);
    }

    public function removeChoice_Edit_Mode($questionID, $index)
    {
        array_splice($this->EDIT_choices[$questionID], $index, 1);
    }

    public function cancelEditQuestion()
    {
        // Reset The Variables Only
        $this->EDIT_question_asked = $this->EDIT_COPY_question_asked;
        $this->EDIT_correct_answer = $this->EDIT_COPY_correct_answer;
        $this->EDIT_choices = $this->EDIT_COPY_choices;
    }






    public function updated($propertyName)
    {
        // $this->validateOnly($propertyName);
        // dd($propertyName);

        // Check if the updated property is one of the choices array elements
        // if (strpos($propertyName, 'EDIT_choices.') === 0) {
        //     // Find the index of the updated choice
        //     $questionID = explode('.', $propertyName)[1];
        //     $index = explode('.', $propertyName)[2];


        //     // Update mychoice if it matches the previous choice

        //     $this->EDIT_correct_answer[$questionID] = $this->EDIT_choices[$questionID][$index]['choice'];
        //     // dd($this->EDIT_correct_answer[$questionID]);

        //     // dd($this->EDIT_correct_answer[$questionID], $this->EDIT_choices[$questionID][$index]['choice']);
        // }

        // Return true to the function if start of the string begins with EDIT_ and case sensitive
        if (strpos($propertyName, 'EDIT_') === 0) {
            // dd('true');
            $this->validateOnly($propertyName, $this->EDIT_rules, $this->EDIT_messages);
        } else {
            // dd($propertyName);
            $this->validateOnly($propertyName, $this->rules, $this->messages);
            // dd('false');
        }

        // dd(strpos($propertyName, 'EDIT_') === 0);
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

    public function EDIT_lookForDuplicateChoices($questionID)
    {
        // Extract the choices into a simple array
        $choiceValues = array_map(function ($item) {
            return $item['choice'];
        }, $this->EDIT_choices[$questionID]);

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
        $this->trimChoices();
        $this->validate();

        $hasDuplicate = $this->lookForDuplicateChoices();

        if ($hasDuplicate) {
            // Add an error message to the component
            $this->addError('choices', 'Each choice must be unique. Duplicate choices are not allowed.');
            return;
        }

        // $this->choices 


        Question::create([
            'lesson_id' => $this->lessonID,
            'question' => $this->question_asked,
            'choices' => $this->choices,
            'correct_answer' => $this->correct_answer,
        ]);

        $this->reset(['question_asked', 'correct_answer', 'choices']);
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

        $this->EDIT_trimChoices($questionID);
        if (empty($this->EDIT_correct_answer[$questionID])) {
            // Add an error message to the component
            $this->addError('EDIT_answer', 'Please choose an answer.');
            return;
        }

        $hasDuplicate = $this->EDIT_lookForDuplicateChoices($questionID);
        if ($hasDuplicate) {
            // Add an error message to the component
            $this->addError('EDIT_answer', 'Each choice must be unique. Duplicate choices are not allowed.');
            return;
        }

        // Validation 
        // $this->validate($this->EDIT_rules, $this->EDIT_messages);
        $this->validateOnly('question', $this->EDIT_rules, $this->EDIT_messages);
        $this->validateOnly('choices', $this->EDIT_rules, $this->EDIT_messages);
        $this->validateOnly('correct_answer', $this->EDIT_rules, $this->EDIT_messages);
        // dd('here');

        // dd($this->EDIT_correct_answer[$questionID]);

        $question->update([
            'question' => $this->EDIT_question_asked[$questionID],
            'choices' => $this->EDIT_choices[$questionID],
            'correct_answer' => $this->EDIT_correct_answer[$questionID],
        ]);

        $this->dispatch('question-updated');
    }




    #[On('question-updated')]
    public function refreshQuestions()
    {
        $this->fetched_questions = $this->passed_lesson->questions()->get();
        // $this->dispatch('re-render_questions');
    }

    #[On('question-added')]
    public function refetchEditVariables()
    {
        $this->fetched_questions = $this->passed_lesson->questions()->get();

        foreach ($this->fetched_questions as $question) {
            $this->EDIT_question_asked[$question->id] = $question->question;
            // $this->EDIT_correct_answer[$question->id] = $question->correct_answer;
            $this->EDIT_correct_answer[$question->id] = [];
            $this->EDIT_choices[$question->id] = $question->choices;
        }


        //Backup Variables
        $this->EDIT_COPY_question_asked = $this->EDIT_question_asked;
        $this->EDIT_COPY_correct_answer = $this->EDIT_correct_answer;
        $this->EDIT_COPY_choices = $this->EDIT_choices;
    }



    // #[On('re-render_questions')]
    #[On('question-deleted')]
    public function render()
    {
        return view('livewire.question.question-create');
    }
}
