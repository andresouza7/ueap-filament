{{-- resources/views/layouts/main.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>@yield('title', 'Universidade')</title>
    @vite(['resources/css/app.css', 'resources/css/carousel.css'])
</head>

<body class="container mx-auto p-10 bg-black/80">
    <div class="bg-black min-h-screen flex items-center justify-center overflow-hidden p-4 sm:p-8">
        <!-- Background effects -->
        <div class="fixed inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-br from-violet-900/20 via-purple-900/20 to-fuchsia-900/20"></div>
            <div
                class="absolute top-1/4 left-1/4 w-48 h-48 sm:w-96 sm:h-96 bg-violet-500/10 rounded-full filter blur-3xl">
            </div>
            <div
                class="absolute bottom-1/4 right-1/4 w-48 h-48 sm:w-96 sm:h-96 bg-fuchsia-500/10 rounded-full filter blur-3xl">
            </div>
        </div>

        <!-- Main container -->
        <div class="w-full max-w-6xl mx-auto">
            <!-- Carousel container -->
            <div class="carousel-container relative">
                <!-- Progress bar -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-white/10 rounded-full overflow-hidden z-20">
                    <div
                        class="progress-bar absolute top-0 left-0 h-full w-1/3 bg-gradient-to-r from-blue-500 to-green-500">
                    </div>
                </div>

                <!-- Navigation buttons -->
                <button
                    class="nav-button absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center z-20 text-white touch-manipulation"
                    title="Previous slide">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>

                <button
                    class="nav-button absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center z-20 text-white touch-manipulation"
                    title="Next slide">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Carousel track -->
                <div class="carousel-track relative h-[400px] sm:h-[500px] md:h-[600px] overflow-hidden">
                    @php
                        $banners = \App\Models\WebBanner::latest('id')->take(3)->get();

                       
                    @endphp

                    @foreach ($banners as $banner)
                        <div class="carousel-item active absolute top-0 left-0 w-full h-full">
                            <div class="w-full h-full p-4 sm:p-8">
                                <div class="w-full h-full rounded-xl sm:rounded-2xl overflow-hidden relative group">
                                    <img src="{{ $banner->image_url }}" alt="Geometric art installation"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                   
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Carousel items -->
                    <div class="carousel-item active absolute top-0 left-0 w-full h-full">
                        <div class="w-full h-full p-4 sm:p-8">
                            <div class="w-full h-full rounded-xl sm:rounded-2xl overflow-hidden relative group">
                                <img src="https://images.unsplash.com/photo-1515462277126-2dd0c162007a?auto=format&fit=crop&q=80"
                                    alt="Geometric art installation"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-violet-500/40 to-purple-500/40 mix-blend-overlay">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 p-4 sm:p-8 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                    <h3 class="text-white text-xl sm:text-2xl md:text-3xl font-bold mb-2 sm:mb-3">
                                        Digital Prism</h3>
                                    <p class="text-gray-200 text-sm sm:text-base md:text-lg max-w-2xl">Where geometry
                                        meets art in a stunning display of light and form.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item next absolute top-0 left-0 w-full h-full">
                        <div class="w-full h-full p-4 sm:p-8">
                            <div class="w-full h-full rounded-xl sm:rounded-2xl overflow-hidden relative group">
                                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80"
                                    alt="Futuristic tech setup"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-fuchsia-500/40 to-pink-500/40 mix-blend-overlay">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 p-4 sm:p-8 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                    <h3 class="text-white text-xl sm:text-2xl md:text-3xl font-bold mb-2 sm:mb-3">Tech
                                        Haven</h3>
                                    <p class="text-gray-200 text-sm sm:text-base md:text-lg max-w-2xl">Immerse yourself
                                        in the cutting edge of technology and innovation.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item hidden absolute top-0 left-0 w-full h-full">
                        <div class="w-full h-full p-4 sm:p-8">
                            <div class="w-full h-full rounded-xl sm:rounded-2xl overflow-hidden relative group">
                                <img src="https://images.unsplash.com/photo-1614850523459-c2f4c699c52e?auto=format&fit=crop&q=80"
                                    alt="Abstract digital art"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-pink-500/40 to-rose-500/40 mix-blend-overlay">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 p-4 sm:p-8 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                    <h3 class="text-white text-xl sm:text-2xl md:text-3xl font-bold mb-2 sm:mb-3">Neural
                                        Dreams</h3>
                                    <p class="text-gray-200 text-sm sm:text-base md:text-lg max-w-2xl">AI-generated
                                        masterpieces that blur the line between human and machine creativity.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indicators -->
                <div class="absolute bottom-2 sm:bottom-4 left-1/2 -translate-x-1/2 flex gap-1 sm:gap-2 z-20">
                    <button
                        class="w-8 sm:w-12 h-1 sm:h-1.5 rounded-full bg-white/40 hover:bg-white/60 transition-colors"
                        title="Go to slide 1"></button>
                    <button
                        class="w-8 sm:w-12 h-1 sm:h-1.5 rounded-full bg-white/20 hover:bg-white/60 transition-colors"
                        title="Go to slide 2"></button>
                    <button
                        class="w-8 sm:w-12 h-1 sm:h-1.5 rounded-full bg-white/20 hover:bg-white/60 transition-colors"
                        title="Go to slide 3"></button>
                </div>
            </div>
        </div>


    </div>

    <div class="relative overflow-hidden bg-white">
        <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
            <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
                <div class="sm:max-w-lg">
                    <h1 class="font text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Svelte signals are
                        finally here</h1>
                    <p class="mt-4 text-xl text-gray-500">This year, our new svelte signals will shelter you from the
                        harsh
                        elements of a world that doesn't care if you develop or die.</p>
                </div>
                <div>
                    <div class="mt-10">
                        <!-- Decorative image grid -->
                        <div aria-hidden="true"
                            class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                            <div
                                class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                                <div class="flex items-center space-x-6 lg:space-x-8">
                                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                                            <img src="https://placekitten.com/g/200/300"
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img src="https://placekeanu.com/200/300" alt=""
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                    </div>
                                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img src="https://placekeanu.com/684/350/" alt=""
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img src="https://placekeanu.com/250/350/y" alt=""
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img src="https://placekitten.com/g/200/300" alt=""
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                    </div>
                                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img src="https://placekeanu.com/684/350/y" alt=""
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img src="https://placebear.com/684/350" alt=""
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#"
                            class="inline-block rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-center font-medium text-white hover:bg-indigo-700">Svelte
                            Signals</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="text-3xl text-white font-medium max-w-[350px] leading-relaxed"><span
            class="text-blue-600">Scaling</span>
        your business was never <span class="text-blue-600">so easy.</span></p>
    <p class="text-gray-300 font-thin text-sm leading-loose max-w-[350px]">Lorem ipsum dolor sit amet, consectetur
        adipisicing elit. Enim sit veniam a expedita saepe labore recusandae veritatis nam repellendus dicta! Quaerat
        ipsa magni praesentium, repudiandae nihil ullam blanditiis. Expedita, earum.</p>
    <button class="border-2 border-blue-600 hover:border-white text-white hover:text-blue-600 py-2 px-4 mt-10">Get
        Started</button>

    <nav>
        <ul class="flex flex-col gap-0 md:flex-row md:gap-10 text-white text-2xl">
            <li class=" text-violet-700   hover:animate-spin">Home</li>
            <li>About</li>
            <li>Contact</li>
        </ul>
    </nav>


    <a href="#"
        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-36 md:rounded-none md:rounded-s-lg"
            src="https://picsum.photos/200/300" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology
                acquisitions 2021</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology
                acquisitions of 2021 so far, in reverse chronological order.</p>
        </div>
    </a>


    <div
        class="group peer grid gap-2 place-items-center h-20 w-20 bg-blue-400 hover:bg-purple-400 transition-colors duration-700 ">
        <div class="h-5 w-5 bg-black group-hover:bg-yellow-400"></div>
        <div class="h-5 w-5 bg-black group-hover:bg-green-500"></div>
    </div>
    <div class="h-20 w-20 bg-blue-400 peer-hover:bg-orange-500 shadow-neon rounded-xl"></div>

    @vite(['resources/js/app.js', 'resources/js/carousel.js'])
</body>

</html>
