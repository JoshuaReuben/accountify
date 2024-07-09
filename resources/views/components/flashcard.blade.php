<div class="container mx-auto">

    {{--  Flashcard --}}
    <div x-data="{ flipped: false }" @click="flipped = !flipped"
        class="[perspective:800px] mx-auto h-full w-11/12  cursor-pointer flex justify-center items-center">

        <div class="[transform-style:preserve-3d]  relative transition-transform duration-1000 "
            :class="{ '[transform:rotateY(180deg)]': flipped }">

            {{-- Add Absoulute after --}}
            <div class="[backface-visibility:hidden] w-full h-full absolute">
                {{-- Start of Front --}}

                <div
                    class="flex justify-center flex-col items-center w-full md:min-w-[420px] md:max-w-[800px] md:w-11/12 min-h-[300px]  mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                    <div class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                        Noteworthy
                        technology acquisitions 2021</div>
                    <div
                        class="flex-grow flex items-center font-normal text-gray-700 dark:text-gray-400 h-full text-center">
                        Here are the
                        biggest
                        enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order. Here are the biggest enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order Here are the biggest enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order. Here are the biggest enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order</div>
                </div>

                {{-- End of Front --}}
            </div>

            <div class="[backface-visibility:hidden] [transform:rotateY(180deg)] w-full h-full">
                {{-- Start of Back --}}


                <div
                    class="flex justify-center flex-col items-center w-full md:min-w-[420px] md:max-w-[800px] md:w-11/12 min-h-[300px]  mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                    <div class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                        Noteworthy
                        technology acquisitions 2021</div>
                    <div
                        class="flex-grow flex items-center font-normal text-gray-700 dark:text-gray-400 h-full text-center">
                        Here are the
                        biggest
                        enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order. Here are the biggest enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order Here are the biggest enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order. Here are the biggest enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order</div>
                </div>


                {{-- End of Back --}}
            </div>

        </div>
    </div>

</div>
