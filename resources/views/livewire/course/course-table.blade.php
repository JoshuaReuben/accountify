<div>
    <h1 class="my-4 text-xl font-bold uppercase">Created Courses</h1>
    <hr class="mb-4">

    {{-- <a href="{{ route('pages.admin.course.show', $course->id) }}"> --}}
    <div
        class="max-w-[370px] group bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:scale-[1.01] duration-250 transition-all ease-in hover:shadow-2xl cursor-pointer">
        {{-- Course Image but on DIV --}}
        <div
            class="h-[150px] w-[370px] relative border-b-2 dark:border-gray-700 bg-[url('https://images.squarespace-cdn.com/content/v1/5e10bdc20efb8f0d169f85f9/09943d85-b8c7-4d64-af31-1a27d1b76698/arrow.png')] bg-cover">
            {{-- Badge --}}
            <span
                class="bg-blue-100 absolute top-3 left-3 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Beginner</span>

            {{-- Actions --}}
            <div class="absolute items-center justify-between hidden top-3 right-1 group-hover:flex">
                {{-- Edit Button --}}
                <div
                    class="flex items-center justify-center w-8 h-8 mr-2 rounded-full ring-2 ring-blue-300 dark:ring-blue-500 hover:bg-blue-100">
                    <i class="text-blue-500 fa-solid fa-pen-to-square"></i>
                </div>

                {{-- Delete Button --}}
                <div
                    class="flex items-center justify-center w-8 h-8 mr-2 rounded-full ring-2 ring-red-300 dark:ring-red-500 hover:bg-red-100">
                    <i class="text-red-500 fa-regular fa-trash-can"></i>
                </div>
            </div>
        </div>

        <div class="p-5">
            {{-- Course Name --}}
            <h5
                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2 group-hover:line-clamp-none group-hover:h-min">
                Noteworthy technology
                acquisitions 20dfasdf sdfasdfasd sdfasdfasdf asdfasdf21</h5>
            {{-- Course Short Description --}}
            <p
                class="mb-3 font-normal text-gray-700  dark:text-gray-400 mt-4 h-[100px] line-clamp-4 group-hover:line-clamp-none group-hover:h-min">
                Here are the
                biggest
                enterprise technology
                acquisitions of 2021 so far, in reverse chronological order.

                Here are the
                biggest
                enterprise technology
                acquisitions of 202sdda1 sddao far, in reverse chronological order.
            </p>
            <div class="flex items-center justify-between">
                <div><i class="fa-solid fa-clock-rotate-left"></i><span class="text-sm"> 10 hrs. read</span></div>
                <div><i class="fa-solid fa-calendar-days"></i><span class="text-sm"> 10/10/2021</span></div>
            </div>

        </div>
    </div>
    {{-- </a> --}}



</div>
