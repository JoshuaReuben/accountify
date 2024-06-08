<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Accountify') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans antialiased">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative flex justify-center h-screen">
            <div class="relative w-full h-full">
                <header class="absolute top-0 left-0 right-0 ">
                    <div class="px-5 pt-10 mr-10">
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </div>
                </header>
                <main
                    class="justify-center items-center h-full w-full bg-center bg-no-repeat bg-[url('https://images.pexels.com/photos/159490/yale-university-landscape-universities-schools-159490.jpeg?cs=srgb&dl=pexels-pixabay-159490.jpg&fm=jpg')] bg-gray-700 bg-blend-multiply">
                    <div class="max-w-screen-xl px-4 py-24 mx-auto text-center lg:py-56">

                        <section class="mt-12">
                            <h1
                                class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">
                                Unlocking Opportunities: Your Path to Excellence</h1>
                            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Here at
                                Accountify, our learning platform leverages technology and innovation to provide
                                accounting students with tailored resources and courses, empowering them to hone their
                                skills and knowledge. We are dedicated to helping students achieve their academic and
                                professional goals, unlocking their full potential in the field of accounting.</p>
                            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                                <a href="/login"
                                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                    Sign In
                                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                                <a href="/register"
                                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-white rounded-lg hover:text-gray-900 sm:ms-4 hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                                    Get Started
                                </a>
                            </div>
                    </div>
                    </section>

                </main>

            </div>
        </div>
    </div>
</body>

</html>
