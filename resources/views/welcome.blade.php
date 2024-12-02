<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-5">
            <!-- Add cards and descriptions here -->

            <!-- Example Cards -->
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/example1.jpg') }}" class="card-img-top" alt="Example Image">
                <div class="card-body">
                    <h5 class="card-title">Card Title 1</h5>
                    <p class="card-text">This is a brief description for card 1.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/example2.jpg') }}" class="card-img-top" alt="Example Image">
                <div class="card-body">
                    <h5 class="card-title">Card Title 2</h5>
                    <p class="card-text">This is a brief description for card 2.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/example3.jpg') }}" class="card-img-top" alt="Example Image">
                <div class="card-body">
                    <h5 class="card-title">Card Title 3</h5>
                    <p class="card-text">This is a brief description for card 3.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/example4.jpg') }}" class="card-img-top" alt="Example Image">
                <div class="card-body">
                    <h5 class="card-title">Card Title 4</h5>
                    <p class="card-text">This is a brief description for card 4.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>

        <!-- Add any additional description or content about Orange Coding Academy here -->
        <div class="mt-5">
            <h2>About Orange Coding Academy</h2>
            <p>Orange Coding Academy is a leading institution for full-stack web development training, empowering students with cutting-edge skills to build dynamic web applications.</p>
        </div>
    </div>

    </x-app-layout>
