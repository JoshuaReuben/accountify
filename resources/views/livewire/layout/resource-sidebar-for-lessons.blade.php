<?php

use Livewire\Volt\Component;
use App\Models\Module;

new class extends Component {
    public $courseID;
    public $moduleID;
    public $passed_module;
    public $fetched_lessons;

    public function mount($moduleID)
    {
        $this->passed_module = Module::find($moduleID);

        $this->fetched_lessons = $this->passed_module->lessons()->get();
    }
}; ?>

<div>
    <div class="text-xl font-bold uppercase border-b-4 pb-3 dark:text-white dark:border-gray-700 mb-4 border-gray-200">
        MODULES
    </div>

    <div class="flex w-full flex-col gap-4 text-slate-700 dark:text-slate-300">

        <ul class="space-y-2 font-medium w-full">



            @if (Route::currentRouteName() != 'pages.admin.lesson')
                @if ($this->fetched_lessons->count() >= 0 && Route::currentRouteName() != 'pages.admin.question.module')
                    <li class="border-b boder-gray-200 dark:border-gray-700 pb-4">
                        <a href="{{ route('pages.admin.question.module', ['courseID' => $courseID, 'moduleID' => $moduleID]) }}"
                            class="flex items-center justify-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">

                            <i
                                class="fa-solid fa-file-lines  transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                            <span class="ms-3"> Module Examination </span>
                        </a>
                    </li>
                @endif



                <li class="border-b boder-gray-200 dark:border-gray-700 pb-4">
                    <a href="{{ route('pages.admin.lesson', ['courseID' => $courseID, 'moduleID' => $moduleID]) }}"
                        class="flex items-center justify-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">

                        <i
                            class="fa-solid fa-plus  transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3"> Add New Lesson </span>
                    </a>
                </li>
            @endif

            @forelse($this->fetched_lessons as $lesson)
                <li class="border-b boder-gray-200 dark:border-gray-700">
                    <a href="{{ route('pages.admin.lesson.show', ['courseID' => $this->courseID, 'moduleID' => $this->moduleID, 'lessonID' => $lesson->id]) }}"
                        class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">

                        <i
                            class="fa-solid fa-book  transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3"> Lesson {{ $loop->iteration }}: {{ $lesson->lesson_title }}</span>
                    </a>
                </li>
            @empty
                <div class="p-6 italic text-center text-gray-900 dark:text-gray-100">
                    <p>No Lessons Added.</p>
                </div>
            @endforelse
        </ul>
    </div>




</div>
