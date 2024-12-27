<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orange LMS</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Custom Styles -->
    <style>
    :root {
        --primary-orange: #FF6B35;
        --secondary-orange: #FF9F1C;
        --primary-green: #008000;
        --primary-red: #880000;
        --primary-lightblue: blue;
        --primary-purple: purple;
        --primary-yellow: yellow;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #121212;
        color: #ffffff;
    }

    .bg-gradient-orange {
        background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
    }

    .swiper-slide {
        height: auto;
        background: #1a1a1a;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .swiper-slide:hover {
        transform: scale(1.05);
    }

    .swiper-pagination-bullet {
        background: var(--primary-orange);
    }

    .swiper-pagination-bullet-active {
        background: var(--primary-orange);
    }

    .mobile-menu {
        position: fixed;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: #121212;
        transition: left 0.3s ease;
        z-index: 50;
    }

    .mobile-menu.active {
        left: 0;
    }

    .hero-animation {
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    @keyframes attention {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255, 107, 53, 0.7);
        }

        70% {
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(255, 107, 53, 0);
        }

        100% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }
    }

    .animate-attention {
        animation: attention 2s infinite cubic-bezier(0.66, 0, 0, 1);
    }
    </style>
</head>

<body class="bg-[#121212] text-white">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-black py-4 px-6 shadow-lg z-40">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODMuNDYgMjgzLjQ2Ij48cGF0aCBkPSJNMCAwaDI4My40NnYyODMuNDZIMHoiIGZpbGw9IiNmZjc5MDAiLz48cGF0aCBkPSJNNDAuNTEgMjAyLjQ3aDIwMi40N3Y0MC41SDQwLjUxeiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg=="
                    alt="Logo" width="50" class="me-4">
                <h1 class="text-2xl font-bold text-white">Orange LMS</h1>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="/" class="text-white hover:text-[var(--primary-orange)] transition">Home</a>
                <a href="/" class="text-white hover:text-[var(--primary-orange)] transition">Technologies</a>
                <a href="/about" class="text-white hover:text-[var(--primary-orange)] transition">About Us</a>
                <a href="/" class="text-white hover:text-[var(--primary-orange)] transition">Contact</a>
            </div>
            <div class="md:hidden">
                <button class="text-white" onclick="toggleMobileMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu flex flex-col justify-center items-center md:hidden">
        <button class="absolute top-6 right-6 text-white" onclick="toggleMobileMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="flex flex-col space-y-6 text-center">
            <div class=" md:block">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.46 283.46" class="mx-auto w-16 h-16 mb-4">
                    <defs>
                        <style>
                        #a {
                            fill: #ff7900;
                        }

                        #b,
                        #c {
                            fill: #fff;
                        }
                        </style>
                    </defs>
                    <path d="M0 0h283.46v283.46H0z" id="a" />
                    <path
                        d="M111.2 256a23.23 23.23 0 0 1-13 3.92c-7.36 0-11.71-4.9-11.71-11.46 0-8.83 8.12-13.51 24.85-15.4v-2.19c0-2.87-2.18-4.53-6.2-4.53a11.76 11.76 0 0 0-9.61 4.53l-7-4q5.52-7.71 16.82-7.7c10.28 0 16 4.45 16 11.7v28.6h-9.2zm-14.55-8.3c0 2.65 1.67 5.13 4.68 5.13 3.27 0 6.44-1.36 9.62-4.16v-9.34c-9.7 1.23-14.3 3.72-14.3 8.39zM129.54 221.07l8.59-1.19.94 4.68c4.85-3.55 8.7-5.44 13.55-5.44 8.12 0 12.3 4.31 12.3 12.84v27.47h-10.37v-25.66c0-4.83-1.26-7-5-7-3.1 0-6.19 1.43-9.71 4.38v28.3h-10.3zM233.69 260.18c-11.63 0-18.57-7.47-18.57-20.45s7-20.61 18.4-20.61 18.15 7.25 18.15 20.08c0 .68-.08 1.36-.08 2h-26.27c.08 7.47 3.18 11.24 9.29 11.24 3.93 0 6.52-1.58 8.95-5l7.61 4.22c-3.35 5.58-9.37 8.52-17.48 8.52zm7.78-25.66c0-5.28-3-8.38-7.95-8.38-4.68 0-7.61 3-8 8.38zM34.89 260.61c-10.27 0-19.52-6.54-19.52-20.82S24.62 219 34.89 219s19.52 6.55 19.52 20.82-9.26 20.79-19.52 20.79zm0-32.86c-7.75 0-9.19 7-9.19 12s1.44 12.05 9.19 12.05 9.19-7 9.19-12.05-1.44-12-9.19-12zM61.53 220h9.87v4.64a15.29 15.29 0 0 1 10.87-5.45 8.6 8.6 0 0 1 1.34.07V229h-.5c-4.52 0-9.46.7-11 4.21v26.24H61.53zM190.34 251c7.88-.06 8.54-8.07 8.54-13.31 0-6.16-3-11.18-8.61-11.18-3.73 0-7.89 2.72-7.89 11.61 0 4.88.34 12.93 7.96 12.88zm18.52-31.12v37.35c0 6.6-.5 17.45-19.31 17.57-7.75 0-14.94-3.05-16.38-9.83l10.25-1.65c.43 1.94 1.61 3.88 7.42 3.88 5.39 0 8-2.58 8-8.75v-4.59l-.14-.14c-1.65 2.94-4.16 5.74-10.19 5.74-9.19 0-16.44-6.38-16.44-19.72 0-13.19 7.47-20.57 15.86-20.58 7.87 0 10.79 3.57 11.46 5.46h-.12l.85-4.72zM255.75 206.79h-4.08v11.3h-2.16v-11.3h-4.08v-1.74h10.32zm17 11.3h-2.15V207.2h-.07l-4.27 10.89h-1.36l-4.27-10.89h-.06v10.89h-2.15v-13h3.32l3.89 9.9 3.83-9.9h3.29z"
                        id="b" />
                </svg>
            </div>
            <a href="/" class="text-2xl text-white hover:text-[var(--primary-orange)] transition">Home</a>
            <a href="/" class="text-2xl text-white hover:text-[var(--primary-orange)] transition">Technologies</a>
            <a href="/" class="text-2xl text-white hover:text-[var(--primary-orange)] transition">About Us</a>
            <a href="/" class="text-2xl text-white hover:text-[var(--primary-orange)] transition">Contact</a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="pt-24 container mx-auto px-6 py-16 grid md:grid-cols-2 gap-12 items-center ">
        <div class="space-y-8 mt-16">
            <h2 class="text-5xl font-bold leading-tight">
                Transform Your <span class="text-[var(--primary-orange)]">Coding Journey</span>
            </h2>
            <p class="text-xl text-gray-300">
                Become a Full Stack Developer with cutting-edge skills and real-world project experience.
            </p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="{{route('login.show', ['userType' => 'trainee'])}}"
                    class="animate-attention bg-gradient-orange text-white px-4 py-2 rounded-lg text-center">
                    Start Your Journey
                </a>
                <!-- <a href="#"
                    class="bg-transparent border border-[var(--primary-orange)] text-[var(--primary-orange)] px-4 py-2 rounded-lg text-center hover:bg-[var(--primary-orange)] hover:text-white transition">
                    Academies Location
                </a> -->
            </div>
        </div>
        <div class="hidden md:block ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.46 283.46" class="mx-auto w-32 h-32 mb-4">
                <defs>
                    <style>
                    #a {
                        fill: #ff7900;
                    }

                    #b,
                    #c {
                        fill: #fff;
                    }
                    </style>
                </defs>
                <path d="M0 0h283.46v283.46H0z" id="a" />
                <path
                    d="M111.2 256a23.23 23.23 0 0 1-13 3.92c-7.36 0-11.71-4.9-11.71-11.46 0-8.83 8.12-13.51 24.85-15.4v-2.19c0-2.87-2.18-4.53-6.2-4.53a11.76 11.76 0 0 0-9.61 4.53l-7-4q5.52-7.71 16.82-7.7c10.28 0 16 4.45 16 11.7v28.6h-9.2zm-14.55-8.3c0 2.65 1.67 5.13 4.68 5.13 3.27 0 6.44-1.36 9.62-4.16v-9.34c-9.7 1.23-14.3 3.72-14.3 8.39zM129.54 221.07l8.59-1.19.94 4.68c4.85-3.55 8.7-5.44 13.55-5.44 8.12 0 12.3 4.31 12.3 12.84v27.47h-10.37v-25.66c0-4.83-1.26-7-5-7-3.1 0-6.19 1.43-9.71 4.38v28.3h-10.3zM233.69 260.18c-11.63 0-18.57-7.47-18.57-20.45s7-20.61 18.4-20.61 18.15 7.25 18.15 20.08c0 .68-.08 1.36-.08 2h-26.27c.08 7.47 3.18 11.24 9.29 11.24 3.93 0 6.52-1.58 8.95-5l7.61 4.22c-3.35 5.58-9.37 8.52-17.48 8.52zm7.78-25.66c0-5.28-3-8.38-7.95-8.38-4.68 0-7.61 3-8 8.38zM34.89 260.61c-10.27 0-19.52-6.54-19.52-20.82S24.62 219 34.89 219s19.52 6.55 19.52 20.82-9.26 20.79-19.52 20.79zm0-32.86c-7.75 0-9.19 7-9.19 12s1.44 12.05 9.19 12.05 9.19-7 9.19-12.05-1.44-12-9.19-12zM61.53 220h9.87v4.64a15.29 15.29 0 0 1 10.87-5.45 8.6 8.6 0 0 1 1.34.07V229h-.5c-4.52 0-9.46.7-11 4.21v26.24H61.53zM190.34 251c7.88-.06 8.54-8.07 8.54-13.31 0-6.16-3-11.18-8.61-11.18-3.73 0-7.89 2.72-7.89 11.61 0 4.88.34 12.93 7.96 12.88zm18.52-31.12v37.35c0 6.6-.5 17.45-19.31 17.57-7.75 0-14.94-3.05-16.38-9.83l10.25-1.65c.43 1.94 1.61 3.88 7.42 3.88 5.39 0 8-2.58 8-8.75v-4.59l-.14-.14c-1.65 2.94-4.16 5.74-10.19 5.74-9.19 0-16.44-6.38-16.44-19.72 0-13.19 7.47-20.57 15.86-20.58 7.87 0 10.79 3.57 11.46 5.46h-.12l.85-4.72zM255.75 206.79h-4.08v11.3h-2.16v-11.3h-4.08v-1.74h10.32zm17 11.3h-2.15V207.2h-.07l-4.27 10.89h-1.36l-4.27-10.89h-.06v10.89h-2.15v-13h3.32l3.89 9.9 3.83-9.9h3.29z"
                    id="b" />
            </svg>

        </div>

    </main>

    <!-- Technologies Slider Section -->
    <section class="container mx-auto px-6 py-16">
        <div class="text-center mb-12">

            <h2 class="text-3xl font-bold">Full Stack <span class="text-[var(--primary-orange)]">Technologies</span>
            </h2>
        </div>

        <div class="swiper technology-swiper">
            <div class="swiper-wrapper">
                <!-- Technology Cards -->

                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[var(--primary-orange)] shadow-lg mb-6">
                            <img src="{{asset('assets/technologies/6764386e40b9c_11.jpg')}}" alt="Node.js"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">HTML5</h3>
                            <p class="text-gray-300">Master web structure and content creation fundamentals</p>
                            <br>
                            <a href="https://developer.mozilla.org/en-US/docs/Web/HTML" target="_blank"
                                class="text-[var(--primary-orange)] hover:underline">Documentation</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[var(--primary-lightblue)] shadow-lg mb-6">
                            <img src="{{asset('assets/technologies/6764388a793b8_12.jpg')}}" alt="Node.js"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">CSS3</h3>
                            <p class="text-gray-300">Design responsive and visually appealing layouts</p>
                            <br>
                            <a href="https://developer.mozilla.org/en-US/docs/Web/CSS" target="_blank"
                                class="text-[var(--primary-orange)] hover:underline">Documentation</a>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[var(--primary-yellow)] shadow-lg mb-6">
                            <img src="{{asset('assets/technologies/676438a61d631_09.jpg')}}" alt="Node.js"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">JS</h3>
                            <p class="text-gray-300">Create dynamic and interactive web experiences</p>
                            <br>
                            <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank"
                                class="text-[var(--primary-orange)] hover:underline">Documentation</a>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[var(--primary-purple)] shadow-lg mb-6">
                            <img src="{{asset('assets/technologies/67643c43a7600_10.jpg')}}" alt="Node.js"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">Bootstrap</h3>
                            <p class="text-gray-300">Leverage pre-built components for rapid development</p>
                            <br>
                            <a href="https://getbootstrap.com/docs/4.1/getting-started/introduction/" target="_blank"
                                class="text-[var(--primary-orange)] hover:underline">Documentation</a>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[var(--primary-purple)] shadow-lg mb-6">
                            <img src="{{asset('assets/technologies/67643c778ce73_13.jpg')}}" alt="PHP"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">PHP</h3>
                            <p class="text-gray-300">Build server-side functionality and backend logic</p>
                            <br>
                            <a href="https://www.w3schools.com/php/" target="_blank"
                                class="text-[var(--primary-orange)] hover:underline">Documentation</a>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[var(--primary-lightblue)] shadow-lg mb-6">
                            <img src="{{asset('assets/technologies/asp.png')}}" alt="PHP"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">ASP.net</h3>
                            <p class="text-gray-300">Build server-side functionality and backend logic</p>
                            <br>
                            <a href="https://www.w3schools.com/asp/default.ASP" target="_blank"
                                class="text-[var(--primary-orange)] hover:underline">Documentation</a>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[var(--primary-red)] shadow-lg mb-6">
                            <img src="{{asset('assets/technologies/67643d6be74ef_laravel.jpg')}}" alt="PHP"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">Laravel</h3>
                            <p class="text-gray-300">Develop robust web applications with modern PHP framework</p>
                            <br>
                            <a href="https://laravel.com/docs/11.x/readme" target="_blank"
                                class="text-[var(--primary-orange)] hover:underline">Documentation</a>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <div
                            class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[var(--primary-lightblue)] shadow-lg mb-6">
                            <img src="{{asset('assets/technologies/67643d9edaa9c_07.jpg')}}" alt="PHP"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">React</h3>
                            <p class="text-gray-300">Create powerful and efficient front-end applications</p>
                            <br>
                            <a href="https://react.dev/learn" target="_blank"
                                class="text-[var(--primary-orange)] hover:underline">Documentation</a>

                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Orange Coding Academy Slider -->
    <section class="container mx-auto px-6 py-16">
        <div class="text-center mb-12">

            <h2 class="text-3xl font-bold">Our <span class="text-[var(--primary-orange)]">Academy</span></h2>
        </div>

        <div class="swiper academy-swiper">
            <div class="swiper-wrapper">
                @foreach(range(1, 6) as $index)
                <div class="swiper-slide bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                    <div class="h-64 overflow-hidden">
                        <img src="{{asset('assets/images/Coding.png')}}" alt="Coding Illustration"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white mb-3">Learning Environment</h3>
                        <p class="text-gray-300">State-of-the-art facilities for optimal learning experience</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- About Us -->
    <section class="pt-24 container mx-auto px-6 py-16 ">
        <div class="text-center mb-12">

            <h2 class="text-3xl font-bold">About<span class="text-[var(--primary-orange)]"> Us</span></h2>
        </div>
        <div class="grid md:grid-cols-2 gap-12 items-center mb-20">
            <div class="rounded-lg overflow-hidden">
                <img src="{{asset('assets/images/Ahmad.jpg')}}" alt="Profile Picture"
                    class="w-48 h-48 md:w-96 md:h-96 object-cover mx-auto rounded-lg  shadow-[0_0_20px_rgba(1,1,1,0.3)]">
            </div>
            <div class="space-y-6">
                <h2 class="text-4xl font-bold">Ahmad Alfararjeh</h2>
                <p class="text-xl text-gray-300">Full Stack Web Developer</p>
                <p class="text-gray-300">
                    It is a great honor for me to create this platform, Orange LMS, after completing my training with
                    Orange in the fifth cohort. I extend my heartfelt gratitude to everyone who supported me and thank
                    my trainers for giving me this incredible opportunity.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i
                            class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i
                            class="fab fa-facebook"></i></a>
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i
                            class="fab fa-github"></i></a>
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i
                            class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-center mb-12">Our <span class="text-[var(--primary-orange)]">Trainers</span>
        </h2>
        <div class="grid md:grid-cols-3 gap-8 ">
            <div class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg w-80 h-66">
                <img src="{{asset('assets/images/salamah.jpg')}}" alt="Trainer 1" class="w-full  h-66 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Salameh Yasin</h3>
                    <p class="text-gray-300">
                        As Manager of Orange Coding Academy, I oversee operations in
                        Amman and Aqaba, driving strategic growth, partnerships, and innovation while
                        ensuring top-quality education. With expertise in digital transformation, project
                        management, and coding, I lead a dedicated team to optimize processes and foster
                        student success.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="https://www.linkedin.com/in/salamehyasin/"
                            class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-linkedin"></i></a>
                        <!-- <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i
                                class="fab fa-facebook"></i></a> -->
                    </div>
                </div>
            </div>
            <div class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg w-80  h-66">
                <img src="{{asset('assets/images/alaa.png')}}" alt="Trainer 3" class="w-full h-66 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Ala' Mohammad </h3>
                    <p class="text-gray-300">
                    I am a skilled web developer and backend expert with extensive experience in PHP, Laravel, and backend technologies. Certified in Google Career and IBM Data Science programs, I excel in solving complex challenges and delivering impactful digital solutions. Let’s connect to innovate together!</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="https://www.linkedin.com/in/alaamohammadhb/"
                            class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-linkedin"></i></a>
                        <!-- <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i
                        class="fab fa-facebook"></i></a> -->
                    </div>
                </div>
            </div>
            <div class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg w-80  h-66">
                <img src="{{asset('assets/images/ayham.jpg')}}" alt="Trainer 2" class="w-full h-66 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Ayham Zaid</h3>
                    <p class="text-gray-300">
                    I am a certified Full Stack Developer with expertise in AWS, skilled in building scalable web applications, implementing RESTful APIs, and integrating databases. Passionate about cloud computing and innovation, I thrive in collaborative environments and embrace new challenges. Let’s connect to drive innovation together!</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="https://www.linkedin.com/in/ayham-zaid-113837159/"
                            class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-linkedin"></i></a>
                        <!-- <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i
                                class="fab fa-facebook"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-black py-12">
        <div class="container mx-auto px-6 grid md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 text-[var(--primary-orange)]">Orange LMS</h3>
                <p class="text-gray-400">
                    Empowering the next generation of technology professionals through innovative education.
                </p>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Courses</a></li>
                    <li><a href="/about" class="text-gray-400 hover:text-white">About Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                <p class="text-gray-400">
                    Email: support@orangeacademy.com<br>
                    Phone: +1 (555) 123-4567
                </p>
            </div>
        </div>

        <div class="container mx-auto px-6 mt-8 pt-6 border-t border-gray-800 text-center">
            <p class="text-gray-500">&copy; 2024 Orange Coding Academy. All Rights Reserved.</p>
        </div>
    </footer>
    <style>
    /* Updated Swiper Styles */
    .swiper-slide {
        height: auto;
        background: #1a1a1a;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.1s ease;
    }

    .swiper-slide:hover {
        transform: scale(1.05);
    }

    .swiper-pagination-bullet {
        background: var(--primary-orange);
    }

    .swiper-pagination-bullet-active {
        background: var(--primary-orange);
    }

    /* Additional styles for technology cards */
    .technology-swiper .swiper-slide {
        padding: 0;
        background: #1a1a1a;
    }

    .academy-swiper .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    </style>

    <script>
    // Initialize Swiper for Technologies
    const techSwiper = new Swiper(".technology-swiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 4,
            },
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        }
    });

    // Initialize Swiper for Academy Images
    const academySwiper = new Swiper(".academy-swiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        }
    });


    function toggleMobileMenu() {
        const menu = document.querySelector('.md\\:flex');
        menu.classList.toggle('hidden');
    }
    </script>

    <script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('active');
    }

    // Add event listener to close mobile menu when a link is clicked
    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', toggleMobileMenu);
    });
    </script>
</body>

</html>