<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('adminApp.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net" rel="preconnect" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet"
          integrity="sha384-laZ3JUZ5Ln2YqhfBvadDpNyBo7w5qmWaRnnXuRwNhJeTEFuSdGbzl4ZGHAEnTozR" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/js/boosted.bundle.min.js"
            integrity="sha384-3RoJImQ+Yz4jAyP6xW29kJhqJOE3rdjuu9wkNycjCuDnGAtC/crm79mLcwj1w2o/"
            crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    {{-- resources/views/layouts/navigation.blade.php --}}
    <nav x-data="{ sidebarOpen: false, profileOpen: false }" class="min-h-screen">
        <!-- Sidebar -->
        <aside
            class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform duration-300"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
            @click.away="sidebarOpen = false">
            <div class="h-full px-3 py-4 overflow-y-auto bg-white border-r">

                <!-- Logo -->
                <div class="flex items-center mb-5 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.46 283.46" class="h-8 w-auto">
                        <defs>
                            <style>
                                #a { fill: #ff7900; }
                                #b, #c { fill: #fff; }
                                @media (max-width: 49.98px) {
                                    #b { display: none; }
                                }
                                @media (min-width: 50px) {
                                    #c { display: none; }
                                }
                            </style>
                        </defs>
                        <path d="M0 0h283.46v283.46H0z" id="a"/>
                        <path d="M40.51 202.47h202.47v40.5H40.51z" id="c"/>
                        <path d="M111.2 256a23.23 23.23 0 0 1-13 3.92c-7.36 0-11.71-4.9-11.71-11.46 0-8.83 8.12-13.51 24.85-15.4v-2.19c0-2.87-2.18-4.53-6.2-4.53a11.76 11.76 0 0 0-9.61 4.53l-7-4q5.52-7.71 16.82-7.7c10.28 0 16 4.45 16 11.7v28.6h-9.2zm-14.55-8.3c0 2.65 1.67 5.13 4.68 5.13 3.27 0 6.44-1.36 9.62-4.16v-9.34c-9.7 1.23-14.3 3.72-14.3 8.39zM129.54 221.07l8.59-1.19.94 4.68c4.85-3.55 8.7-5.44 13.55-5.44 8.12 0 12.3 4.31 12.3 12.84v27.47h-10.37v-25.66c0-4.83-1.26-7-5-7-3.1 0-6.19 1.43-9.71 4.38v28.3h-10.3zM233.69 260.18c-11.63 0-18.57-7.47-18.57-20.45s7-20.61 18.4-20.61 18.15 7.25 18.15 20.08c0 .68-.08 1.36-.08 2h-26.27c.08 7.47 3.18 11.24 9.29 11.24 3.93 0 6.52-1.58 8.95-5l7.61 4.22c-3.35 5.58-9.37 8.52-17.48 8.52zm7.78-25.66c0-5.28-3-8.38-7.95-8.38-4.68 0-7.61 3-8 8.38zM34.89 260.61c-10.27 0-19.52-6.54-19.52-20.82S24.62 219 34.89 219s19.52 6.55 19.52 20.82-9.26 20.79-19.52 20.79zm0-32.86c-7.75 0-9.19 7-9.19 12s1.44 12.05 9.19 12.05 9.19-7 9.19-12.05-1.44-12-9.19-12zM61.53 220h9.87v4.64a15.29 15.29 0 0 1 10.87-5.45 8.6 8.6 0 0 1 1.34.07V229h-.5c-4.52 0-9.46.7-11 4.21v26.24H61.53zM190.34 251c7.88-.06 8.54-8.07 8.54-13.31 0-6.16-3-11.18-8.61-11.18-3.73 0-7.89 2.72-7.89 11.61 0 4.88.34 12.93 7.96 12.88zm18.52-31.12v37.35c0 6.6-.5 17.45-19.31 17.57-7.75 0-14.94-3.05-16.38-9.83l10.25-1.65c.43 1.94 1.61 3.88 7.42 3.88 5.39 0 8-2.58 8-8.75v-4.59l-.14-.14c-1.65 2.94-4.16 5.74-10.19 5.74-9.19 0-16.44-6.38-16.44-19.72 0-13.19 7.47-20.57 15.86-20.58 7.87 0 10.79 3.57 11.46 5.46h-.12l.85-4.72zM255.75 206.79h-4.08v11.3h-2.16v-11.3h-4.08v-1.74h10.32zm17 11.3h-2.15V207.2h-.07l-4.27 10.89h-1.36l-4.27-10.89h-.06v10.89h-2.15v-13h3.32l3.89 9.9 3.83-9.9h3.29z" id="b"/>
                    </svg>
                    <span class="ml-3 text-xl font-semibold">Dashboard</span>
                </div>


                <!-- Navigation Items -->
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('users.*') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="ml-3">Users</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('categories.*') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="ml-3">Categories</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('products.*') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span class="ml-3">Products</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('reviews.*') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            <span class="ml-3">Reviews</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('coupons.*') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                            <span class="ml-3">Coupons</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 {{ request()->routeIs('orders.*') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="ml-3">Orders</span>
                        </a>
                    </li>
                </ul>

                <!-- Account Section -->
                <div class="pt-4 mt-4 border-t">
                    <div class="px-2 text-xs font-semibold text-gray-400 uppercase">
                        Account pages
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center p-2 mt-2 text-gray-600 rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="ml-3">Sign out</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Top Navigation -->
        <div class="lg:ml-64">
            <nav class="bg-white border-b px-4 py-2.5">
                <div class="flex justify-between items-center">

                    <!-- Profile Dropdown -->
                    <div class="relative ml-auto" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="flex items-center p-2 text-gray-600 hover:bg-gray-100 rounded-lg"
                        >
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open"
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95">
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <hr class="my-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>


        </div>
    </nav>



    <!-- Page Content -->
    <main>


        <div class="container">
            <div class="d-flex justify-content-between align-items-center my-5">
                <!—flex-direction view with Margin 5-->
                <div class="h2">All Todos</div>
                <a href="{{route("todo.create")}}" class="btn btn-primary btn-lg">Add Todo</a>
            </div>
            <!-- {{print_r($todos)}} -->
            <table class="table table-stripped table-dark">
                <tr>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Due date</th>
                    <th>Action</th>
                </tr>
                @foreach($todos as $todo)
                    <tr valign="middle">
                        <td>{{$todo->name}}</td>
                        <td>{{$todo->work}}</td>
                        <td>{{$todo->duedate}}</td>
                        <td>
                            <a href="{{route("todo.edit",$todo->id)}}" class="btn btn-success btn-sm">Update</a>
                            <a href="{{route("todo.delete",$todo->id)}}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </main>
</div>
</body>
</html>

