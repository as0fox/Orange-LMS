<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orange LMS - {{ ucfirst($userType) }} Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-bg {
            background: linear-gradient(135deg, #000, #333, #666, #999, #000);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        .input-group {
            position: relative;
        }

        .input-group input {
            padding-left: 40px;
        }

        .input-group .icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff7900;
        }

        @keyframes upDownMotion {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .up-down-motion {
            animation: upDownMotion 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="login-bg min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md glass-card rounded-2xl overflow-hidden">
        <div class="p-8">
        <div class="text-center mb-8 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.46 283.46" class="mx-auto w-32 h-32 mb-4">
                    <defs>
                        <style>
                            #a { fill: #ff7900; }
                            #b, #c { fill: #fff; }
                        </style>
                    </defs>
                    <path d="M0 0h283.46v283.46H0z" id="a"/>
                    <path d="M111.2 256a23.23 23.23 0 0 1-13 3.92c-7.36 0-11.71-4.9-11.71-11.46 0-8.83 8.12-13.51 24.85-15.4v-2.19c0-2.87-2.18-4.53-6.2-4.53a11.76 11.76 0 0 0-9.61 4.53l-7-4q5.52-7.71 16.82-7.7c10.28 0 16 4.45 16 11.7v28.6h-9.2zm-14.55-8.3c0 2.65 1.67 5.13 4.68 5.13 3.27 0 6.44-1.36 9.62-4.16v-9.34c-9.7 1.23-14.3 3.72-14.3 8.39zM129.54 221.07l8.59-1.19.94 4.68c4.85-3.55 8.7-5.44 13.55-5.44 8.12 0 12.3 4.31 12.3 12.84v27.47h-10.37v-25.66c0-4.83-1.26-7-5-7-3.1 0-6.19 1.43-9.71 4.38v28.3h-10.3zM233.69 260.18c-11.63 0-18.57-7.47-18.57-20.45s7-20.61 18.4-20.61 18.15 7.25 18.15 20.08c0 .68-.08 1.36-.08 2h-26.27c.08 7.47 3.18 11.24 9.29 11.24 3.93 0 6.52-1.58 8.95-5l7.61 4.22c-3.35 5.58-9.37 8.52-17.48 8.52zm7.78-25.66c0-5.28-3-8.38-7.95-8.38-4.68 0-7.61 3-8 8.38zM34.89 260.61c-10.27 0-19.52-6.54-19.52-20.82S24.62 219 34.89 219s19.52 6.55 19.52 20.82-9.26 20.79-19.52 20.79zm0-32.86c-7.75 0-9.19 7-9.19 12s1.44 12.05 9.19 12.05 9.19-7 9.19-12.05-1.44-12-9.19-12zM61.53 220h9.87v4.64a15.29 15.29 0 0 1 10.87-5.45 8.6 8.6 0 0 1 1.34.07V229h-.5c-4.52 0-9.46.7-11 4.21v26.24H61.53zM190.34 251c7.88-.06 8.54-8.07 8.54-13.31 0-6.16-3-11.18-8.61-11.18-3.73 0-7.89 2.72-7.89 11.61 0 4.88.34 12.93 7.96 12.88zm18.52-31.12v37.35c0 6.6-.5 17.45-19.31 17.57-7.75 0-14.94-3.05-16.38-9.83l10.25-1.65c.43 1.94 1.61 3.88 7.42 3.88 5.39 0 8-2.58 8-8.75v-4.59l-.14-.14c-1.65 2.94-4.16 5.74-10.19 5.74-9.19 0-16.44-6.38-16.44-19.72 0-13.19 7.47-20.57 15.86-20.58 7.87 0 10.79 3.57 11.46 5.46h-.12l.85-4.72zM255.75 206.79h-4.08v11.3h-2.16v-11.3h-4.08v-1.74h10.32zm17 11.3h-2.15V207.2h-.07l-4.27 10.89h-1.36l-4.27-10.89h-.06v10.89h-2.15v-13h3.32l3.89 9.9 3.83-9.9h3.29z" id="b"/>
                </svg>
                <h1 class="text-3xl font-bold text-gray-800">Orange LMS</h1>
                <p class="text-gray-600 mt-2">Welcome Back! Please Login as {{ ucfirst($userType) }}</p>
            </div>



            <!-- Show errors if any -->
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt', ['userType' => $userType]) }}" class="space-y-6">
                @csrf
                
                <div class="input-group">
                    <i class="fas fa-envelope icon"></i>
                    <input 
                        type="email" 
                        name="email" 
                        required 
                        placeholder="Email Address" 
                        class="w-full px-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent transition duration-300"
                    >
                </div>

                <div class="input-group">
                    <i class="fas fa-lock icon"></i>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="Password" 
                        class="w-full px-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent transition duration-300"
                    >
                </div>


                <button 
                    type="submit" 
                    class="w-full bg-orange-600 text-white py-3 rounded-lg hover:bg-orange-700 transition duration-300 transform hover:scale-[1.02] shadow-lg"
                >
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-orange-700">Orange Coding Academy</p>
            </div>
        </div>
    </div>
</body>
</html>

<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>



## Schema : https://dbdiagram.io/d/6739bd24e9daa85acab6cca3
