<div>
    <h1 class="my-4 text-xl font-bold uppercase">Created Courses</h1>
    <hr class="mb-4">


    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($courses as $course)
            @php
                $backgroundUrl = asset('storage/' . $course->course_cover_photo);
            @endphp

            <a href="{{ route('pages.admin.course.show', $course->id) }}">
                <div
                    class="max-w-[370px] group bg-white border overflow-hidden border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:scale-[1.01] duration-250 transition-all ease-in hover:shadow-2xl cursor-pointer">
                    {{-- Course Image but on DIV --}}
                    <div class="h-[150px] w-[370px] relative dark:border-gray-700 overflow-hidden "
                        style="background-image: url('{{ $backgroundUrl }}'); background-size: cover; background-position: center;">
                        {{-- Badge --}}
                        <span
                            class="bg-blue-100 absolute top-3 left-3 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $course->course_difficulty }}</span>

                        {{-- Actions --}}
                        <div class="absolute items-center justify-between hidden top-3 right-2 group-hover:flex">
                            {{-- Edit Button --}}
                            <div
                                class="flex items-center justify-center w-8 h-8 mr-2 bg-blue-100 rounded-full ring-2 ring-blue-300 dark:ring-blue-500 hover:bg-blue-200">
                                <i class="text-blue-500 fa-solid fa-pen-to-square"></i>
                            </div>

                            {{-- Delete Button --}}
                            <div
                                class="flex items-center justify-center w-8 h-8 mr-2 bg-red-100 rounded-full ring-2 ring-red-300 dark:ring-red-500 hover:bg-red-200">
                                <i class="text-red-500 fa-regular fa-trash-can"></i>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        {{-- Course Name --}}
                        <h5
                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2 group-hover:line-clamp-none group-hover:h-min">
                            {{ $course->course_name }}</h5>
                        {{-- Course Short Description --}}
                        <p
                            class="mb-3 font-normal text-gray-700  dark:text-gray-400 mt-4 h-[100px] line-clamp-4 group-hover:line-clamp-none group-hover:h-min-h-[100px]">
                            {{ $course->course_description }}
                        </p>
                        <div class="flex items-center justify-between">
                            <div><i class="fa-solid fa-clock-rotate-left"></i><span class="text-sm">
                                    {{ $course->course_duration }} hrs. read</span>
                            </div>
                            <div><i class="fa-solid fa-calendar-days"></i><span class="text-sm">
                                    {{ $course->course_publish_date ? $course->course_publish_date : 'Not Published' }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        @endforeach
    </div>





</div>
