@props(['question' => '', 'answer' => ''])


<div class="container mx-auto">

    {{--  Flashcard --}}
    <div x-data="{ flipped: false }" @click="flipped = !flipped"
        class="[perspective:800px] mx-auto h-full w-11/12  cursor-pointer flex justify-center items-center">

        <div class="[transform-style:preserve-3d]  relative transition-transform duration-1000 "
            :class="{ '[transform:rotateX(180deg)]': flipped }">

            {{-- Add Absoulute after --}}
            <div class="[backface-visibility:hidden] w-full h-full absolute">
                {{-- Start of Front --}}

                <div
                    class="flex justify-center flex-col items-center w-full  md:min-w-[420px] md:max-w-[1100px] min-h-[300px] md:min-h-[500px]  mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow  dark:bg-gray-800 dark:border-gray-700 ">

                    <div class="mb-2 text-2xl font-bold tracking-tight text-center text-gray-900 dark:text-white">
                        Question
                    </div>
                    <div
                        class="flex items-center flex-grow h-full font-normal text-center text-gray-700 dark:text-gray-400">
                        {{ $question }}
                    </div>
                </div>

                {{-- End of Front --}}
            </div>

            <div class="[backface-visibility:hidden] [transform:rotateX(180deg)] w-full h-full">
                {{-- Start of Back --}}


                <div
                    class="flex justify-center flex-col items-center w-full  md:min-w-[420px] md:max-w-[1100px] min-h-[300px] md:min-h-[500px]  mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">

                    <div class="mb-2 text-2xl font-bold tracking-tight text-center text-gray-900 dark:text-white">
                        Answer
                    </div>
                    <div
                        class="flex items-center flex-grow h-full font-normal text-center text-gray-700 dark:text-gray-400">

                        {{ $answer }}
                    </div>
                </div>


                {{-- End of Back --}}
            </div>

        </div>
    </div>

</div>
