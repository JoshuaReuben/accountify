<?php

namespace App\Livewire\Question;

use App\Models\Module;
use App\Models\ModuleQuestion;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;


#[Layout('layouts.resource')]
class ModuleQuestionCreate extends Component
{

    public $courseID;
    public $moduleID;

    public $question_asked;
    public $correct_answer;

    public $choices = [
        ['choice' => ''],
        ['choice' => ''],
    ];

    // For Determing the Module Position
    public $passed_module;
    public $fetched_modules;
    public $module_position;

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
    public $EDIT_question_asked = [];
    public $EDIT_COPY_question_asked = [];

    public $EDIT_correct_answer = [];
    public $EDIT_COPY_correct_answer = [];

    public $EDIT_choices = [];

    public $EDIT_COPY_choices = [];

    protected $EDIT_rules = [
        'EDIT_question_asked.*' => 'required|min:5|max:500',
        'EDIT_correct_answer.*' => 'required|not_in:Choose correct answer|min:1|max:255',
        'EDIT_choices.*.*.choice' => 'required|min:1|max:255',
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


    public function mount($moduleID)
    {
        // Create
        $this->passed_module = Module::find($moduleID);

        // Can't use chaining on this way - thus will not work
        // $this->fetched_modules = $this->passed_module->course()->modules()->get();

        $fetched_course = $this->passed_module->course;
        $this->fetched_modules = $fetched_course->modules;



        //Get the Position Count of passed_lesson
        $position = $this->fetched_modules->search(function ($module) {
            return $module->id === $this->passed_module->id;
        });

        $this->module_position = $position !== false ? $position + 1  : null;



        // Display Questions 
        $this->fetched_questions = $this->passed_module->moduleQuestions()->get();

        foreach ($this->fetched_questions as $question) {
            $this->EDIT_question_asked[$question->id] = $question->question;
            $this->EDIT_correct_answer[$question->id] = [];
            $this->EDIT_choices[$question->id] = $question->choices;
        }


        //Backup Variables
        $this->EDIT_COPY_question_asked = $this->EDIT_question_asked;
        $this->EDIT_COPY_correct_answer = $this->EDIT_correct_answer;
        $this->EDIT_COPY_choices = $this->EDIT_choices;
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


    #[On('module-question-added')]
    public function remountingVars()
    {
        $this->fetched_questions = $this->passed_module->moduleQuestions()->get();
        //////////

        foreach ($this->fetched_questions as $question) {
            $this->EDIT_question_asked[$question->id] = $question->question;
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

        // Check if the updated property is one of the choices array elements
        if (strpos($propertyName, 'EDIT_choices.') === 0) {
            // Find the index of the updated choice
            $questionID = explode('.', $propertyName)[1];
            $index = explode('.', $propertyName)[2];

            // Update mychoice if it matches the previous choice
            $this->EDIT_correct_answer[$questionID] = $this->EDIT_choices[$questionID][$index]['choice'];
        }

        // Return true to the function if start of the string begins with EDIT_ and case sensitive
        if (strpos($propertyName, 'EDIT_') === 0) {

            $this->validateOnly($propertyName, $this->EDIT_rules, $this->EDIT_messages);
        } else {

            $this->validateOnly($propertyName, $this->rules, $this->messages);
        }
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


        ModuleQuestion::create([
            'module_id' => $this->moduleID,
            'question' => $this->question_asked,
            'choices' => $this->choices,
            'correct_answer' => $this->correct_answer,
        ]);

        $this->reset(['question_asked', 'correct_answer', 'choices']);
        $this->dispatch('module-question-added');
    }

    public function deleteQuestion($questionID)
    {
        try {
            $question = ModuleQuestion::find($questionID);
            if ($question) {
                $question->delete();
                // Dispatch an event to notify that the question has been deleted
                $this->dispatch('module-question-deleted');
            } else {
                // Dispatch an event if the question was not found
                $this->dispatch('reload-page');
            }
        } catch (\Exception $e) {
            $this->dispatch('reload-page');
        }
    }

    public function updateAQuestion($questionID)
    {
        $question = ModuleQuestion::find($questionID);

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
        // $this->validateOnly('EDIT_question_asked', $this->EDIT_rules, $this->EDIT_messages);
        // $this->validateOnly('EDIT_choices', $this->EDIT_rules, $this->EDIT_messages);
        // $this->validateOnly('EDIT_correct_answer', $this->EDIT_rules, $this->EDIT_messages);
        $this->validate($this->EDIT_rules, $this->EDIT_messages);



        $question->update([
            'question' => $this->EDIT_question_asked[$questionID],
            'choices' => $this->EDIT_choices[$questionID],
            'correct_answer' => $this->EDIT_correct_answer[$questionID],
        ]);

        $this->dispatch('module-question-updated');
    }




    #[On('module-question-updated')]
    public function refreshQuestions()
    {
        $this->fetched_questions = $this->passed_module->moduleQuestions()->get();
    }

    #[On('module-question-added')]
    public function refetchEditVariables()
    {
        $this->fetched_questions = $this->passed_module->moduleQuestions()->get();

        foreach ($this->fetched_questions as $question) {
            $this->EDIT_question_asked[$question->id] = $question->question;
            $this->EDIT_correct_answer[$question->id] = [];
            $this->EDIT_choices[$question->id] = $question->choices;
        }


        //Backup Variables
        $this->EDIT_COPY_question_asked = $this->EDIT_question_asked;
        $this->EDIT_COPY_correct_answer = $this->EDIT_correct_answer;
        $this->EDIT_COPY_choices = $this->EDIT_choices;
    }






    #[On('module-question-deleted')]
    public function render()
    {
        return view('livewire.question.module-question-create');
    }
}
