<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Me - Orange Coding Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        :root {
            --primary-orange: #FF6B35;
            --secondary-orange: #FF9F1C;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            color: #ffffff;
        }
        .bg-gradient-orange {
            background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
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
    </style>
</head>
<body class="bg-[#121212] text-white">
    <header class="fixed top-0 left-0 right-0 bg-black py-4 px-6 shadow-lg z-40">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODMuNDYgMjgzLjQ2Ij48cGF0aCBkPSJNMCAwaDI4My40NnYyODMuNDZIMHoiIGZpbGw9IiNmZjc5MDAiLz48cGF0aCBkPSJNNDAuNTEgMjAyLjQ3aDIwMi40N3Y0MC41SDQwLjUxeiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==" alt="Logo" width="50" class="me-4">
                <h1 class="text-2xl font-bold text-white">Orange Coding Academy</h1>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="/" class="text-white hover:text-[var(--primary-orange)] transition">Home</a>
                <a href="/" class="text-white hover:text-[var(--primary-orange)] transition">Technologies</a>
                <a href="/about" class="text-white hover:text-[var(--primary-orange)] transition">About Us</a>
                <a href="/" class="text-white hover:text-[var(--primary-orange)] transition">Contact</a>
            </div>
            <button class="md:hidden text-white" onclick="toggleMobileMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>
    </header>

    <div id="mobileMenu" class="mobile-menu flex flex-col justify-center items-center md:hidden">
        <button class="absolute top-6 right-6 text-white" onclick="toggleMobileMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="flex flex-col space-y-6 text-center">
            <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)] transition">Home</a>
            <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)] transition">Technologies</a>
            <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)] transition">Contact</a>
        </div>
    </div>

    <main class="pt-24 container mx-auto px-6 py-16 mt-16">
        <div class="grid md:grid-cols-2 gap-12 items-center mb-20">
            <div class="rounded-lg overflow-hidden">
                <img src="{{asset('assets/images/Ahmad.jpg')}}" alt="Profile Picture" 
                    class="w-48 h-48 md:w-96 md:h-96 object-cover mx-auto rounded-lg border-2 border-[var(--primary-orange)] shadow-[0_0_20px_rgba(255,107,53,0.3)]">
            </div>
            <div class="space-y-6">
                <h2 class="text-4xl font-bold">Ahmad Alfararjeh</h2>
                <p class="text-xl text-gray-300">Full Stack Web Developer</p>
                <p class="text-gray-300">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i class="fab fa-github"></i></a>
                    <a href="#" class="text-2xl text-white hover:text-[var(--primary-orange)]"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-center mb-12">Our <span class="text-[var(--primary-orange)]">Trainers</span></h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                <img src="/api/placeholder/400/300" alt="Trainer 1" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Trainer Name</h3>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
            </div>
            <div class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                <img src="/api/placeholder/400/300" alt="Trainer 2" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Trainer Name</h3>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
            </div>
            <div class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-lg">
                <img src="/api/placeholder/400/300" alt="Trainer 3" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Trainer Name</h3>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white hover:text-[var(--primary-orange)]"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-black py-12">
        <div class="container mx-auto px-6 grid md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 text-[var(--primary-orange)]">Orange Coding Academy</h3>
                <p class="text-gray-400">Empowering the next generation of technology professionals through innovative education.</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="/" class="text-gray-400 hover:text-white">Home</a></li>
                    <li><a href="/" class="text-gray-400 hover:text-white">Courses</a></li>
                    <li><a href="/about" class="text-gray-400 hover:text-white">About</a></li>
                    
                    <li><a href="/" class="text-gray-400 hover:text-white">Contact</a></li>
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

    <script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('active');
    }

    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', toggleMobileMenu);
    });
    </script>
</body>
</html> 