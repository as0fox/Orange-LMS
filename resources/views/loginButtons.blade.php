<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Orange Coding Academy</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
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
    </style>
</head>
<body class="bg-[#121212] text-white">
    <!-- Sticky Header -->
    <header class="fixed top-0 left-0 right-0 bg-black py-4 px-6 shadow-lg z-40">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODMuNDYgMjgzLjQ2Ij48cGF0aCBkPSJNMCAwaDI4My40NnYyODMuNDZIMHoiIGZpbGw9IiNmZjc5MDAiLz48cGF0aCBkPSJNNDAuNTEgMjAyLjQ3aDIwMi40N3Y0MC41SDQwLjUxeiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==" width="50" class="me-4">
                <h1 class="text-2xl font-bold text-white">Orange Coding Academy</h1>
            </div>
        </nav>
    </header>

    <!-- Login Page Content -->
    <main class="container mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">
        <!-- Left Side - Image -->
        <div class="hidden md:block mt-16">
            <img src="{{asset('assets\images\Coding.png')}}" alt="Coding Illustration" class="rounded-xl shadow-2xl">
        </div>
        
        <!-- Right Side - Login Buttons -->
        <div class="space-y-8">
            <h2 class="text-4xl font-bold mb-8">
                Choose Your <span class="text-[var(--primary-orange)]">Role</span>
            </h2>
            
            <div class="grid grid-cols-1 gap-6">
                <a href="{{ route('login.show', ['userType' => 'admin']) }}" class="bg-gradient-orange text-white px-6 py-4 rounded-lg text-center text-xl hover:scale-105 transition flex items-center justify-center space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Login as Admin</span>
                </a>
                
                <a href="{{ route('login.show', ['userType' => 'manager']) }}" class="bg-gradient-orange text-white px-6 py-4 rounded-lg text-center text-xl hover:scale-105 transition flex items-center justify-center space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Login as Manager</span>
                </a>
                <a href="{{ route('login.show', ['userType' => 'trainer']) }}" class="bg-gradient-orange text-white px-6 py-4 rounded-lg text-center text-xl hover:scale-105 transition flex items-center justify-center space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Login as Trainer</span>
                </a>
                
                <!-- <a href="{{ route('login.show', ['userType' => 'trainee']) }}" class="bg-gradient-orange text-white px-6 py-4 rounded-lg text-center text-xl hover:scale-105 transition flex items-center justify-center space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Login as Student</span>
                </a> -->
                
                <a href="{{ route('login.show', ['userType' => 'job-coach']) }}" class="bg-gradient-orange text-white px-6 py-4 rounded-lg text-center text-xl hover:scale-105 transition flex items-center justify-center space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Login as Job Coach</span>
                </a>
            </div>
        </div>
    </main>
</body>
</html>