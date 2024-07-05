<div x-data="{
    open: true,
    theme: localStorage.getItem('theme') || 'light',
    setDarkMode() {
        this.theme = 'dark';
        localStorage.setItem('theme', 'dark');
        document.documentElement.classList.add('dark');
    },
    setLightMode() {
        this.theme = 'light';
        localStorage.setItem('theme', 'light');
        document.documentElement.classList.remove('dark');
    },

}">


    {{-- GO LIGHT MODE --}}
    <div class="relative">
        {{-- START - MOON ICON --}}
        <button @click="setLightMode()" x-show="theme === 'dark'" class="peer cursor-pointer ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" id="moon" class="w-5 h-5 md:h-6 md:w-6">
                <path fill="#ffac33" stroke="#ffac33" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.63 20a9 9 0 0 1-9.12-8.78A8.61 8.61 0 0 1 14.17 5 10.17 10.17 0 0 0 5 15a10.23 10.23 0 0 0 10.42 10A10.43 10.43 0 0 0 25 18.9a9.3 9.3 0 0 1-4.37 1.1Z">
                </path>
            </svg>
        </button>

        <div
            class="absolute top-9 left-1/2 -translate-x-1/2 z-50 whitespace-nowrap rounded bg-slate-900 px-2 py-1 text-center text-sm text-white hidden peer-hover:block transition-all ease-out dark:bg-gray-700 dark:text-gray-200">
            Switch To Light Mode
        </div>
        {{-- END - MOON ICON --}}
    </div>





    {{-- GO DARK MODE --}}
    <div class="relative">
        {{-- START - SUN ICON  --}}
        <button @click="setDarkMode()" x-show="theme!== 'dark'" class="peer cursor-pointer ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47.5 47.5" id="sun"class="w-5 h-5 md:h-6 md:w-6">
                <defs>
                    <clipPath id="a">
                        <path d="M0 38h38V0H0v38Z"></path>
                    </clipPath>
                </defs>
                <g fill="black" clip-path="url(#a)" transform="matrix(1.25 0 0 -1.25 0 47.5)">
                    <path
                        d="M17 35s0 2 2 2 2-2 2-2v-2s0-2-2-2-2 2-2 2v2zM35 21s2 0 2-2-2-2-2-2h-2s-2 0-2 2 2 2 2 2h2zM5 21s2 0 2-2-2-2-2-2H3s-2 0-2 2 2 2 2 2h2zM10.121 29.706s1.414-1.414 0-2.828-2.828 0-2.828 0l-1.415 1.414s-1.414 1.414 0 2.829c1.415 1.414 2.829 0 2.829 0l1.414-1.415ZM31.121 8.707s1.414-1.414 0-2.828-2.828 0-2.828 0l-1.414 1.414s-1.414 1.414 0 2.828 2.828 0 2.828 0l1.414-1.414ZM30.708 26.879s-1.414-1.414-2.828 0 0 2.828 0 2.828l1.414 1.414s1.414 1.414 2.828 0 0-2.828 0-2.828l-1.414-1.414ZM9.708 5.879s-1.414-1.414-2.828 0 0 2.828 0 2.828l1.414 1.414s1.414 1.414 2.828 0 0-2.828 0-2.828L9.708 5.879ZM17 5s0 2 2 2 2-2 2-2V3s0-2-2-2-2 2-2 2v2zM29 19c0 5.523-4.478 10-10 10-5.523 0-10-4.477-10-10 0-5.522 4.477-10 10-10 5.522 0 10 4.478 10 10">
                    </path>
                </g>
            </svg>

        </button>
        <div
            class="absolute top-9 left-1/2 -translate-x-1/2 z-50 whitespace-nowrap rounded bg-slate-900 px-2 py-1 text-center text-sm text-white hidden peer-hover:block transition-all ease-out  dark:bg-white dark:text-black">
            Switch To Dark Mode
        </div>
        {{-- END - SUN ICON --}}
    </div>
</div>
