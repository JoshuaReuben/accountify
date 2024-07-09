<div class="container mx-auto">

    <div class=" w-48 h-64 mx-auto [perspective:800px] cursor-pointer" x-data="{ flipped: false }" @click="flipped = !flipped">

        <div class="[transform-style:preserve-3d] w-full h-full relative transition-transform duration-1000 "
            :class="{ '[transform:rotateY(180deg)]': flipped }">

            <div
                class="[backface-visibility:hidden] w-full h-full bg-red-500  text-white text-6xl flex items-center justify-center absolute">
                1
            </div>

            <div
                class="[backface-visibility:hidden] [transform:rotateY(180deg)] w-full h-full bg-blue-500 text-white text-6xl flex items-center justify-center absolute">
                2
            </div>

        </div>

    </div>
</div>
