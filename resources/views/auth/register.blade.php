<!-- Add Orange Boosted CSS and JS -->
<link href="https://cdn.jsdelivr.net" rel="preconnect" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet" integrity="sha384-laZ3JUZ5Ln2YqhfBvadDpNyBo7w5qmWaRnnXuRwNhJeTEFuSdGbzl4ZGHAEnTozR" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/js/boosted.bundle.min.js" integrity="sha384-3RoJImQ+Yz4jAyP6xW29kJhqJOE3rdjuu9wkNycjCuDnGAtC/crm79mLcwj1w2o/" crossorigin="anonymous"></script>

<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Arial', sans-serif;
    }

    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 20px;
    }

    .register-form {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .register-form h2 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #ff7900;
    }

    .form-label {
        position: absolute;
        top: 10px;
        left: 20px;
        font-weight: bold;
        color: #333;
        pointer-events: none;
        transition: 0.3s ease;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
        padding: 12px 20px;
        width: 100%;
        background: #fff;
        transition: 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #ff7900;
        box-shadow: 0 0 10px rgba(255, 121, 0, 0.2);
    }

    .form-control:focus + .form-label,
    .form-control:not(:placeholder-shown) + .form-label {
        top: -20px;
        font-size: 12px;
        color: #ff7900;
    }

    .btn-primary {
        background-color: #ff7900;
        border: none;
        border-radius: 8px;
        color: #fff;
        font-weight: bold;
        width: 100%;
        padding: 12px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #e66d00;
    }

    .forgot-password {
        color: #ff7900;
        font-size: 0.9rem;
        text-align: center;
    }

    .forgot-password a {
        text-decoration: none;
        color: #ff7900;
    }

    .forgot-password a:hover {
        color: #e66d00;
    }

    .logo {
        width: 80px; /* Adjust the size of the logo */
        margin: 0 auto 20px; /* Centers the logo horizontally */
        display: block; /* Makes the logo a block element */
    }

</style>

<!-- Registration Form -->
<div class="register-container">
    <div class="register-form">
        <!-- Logo -->
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.46 283.46">
                <defs>
                    <style>
                        #a {
                            fill: #ff7900;
                        }
                        #b, #c {
                            fill: #fff;
                        }
                    </style>
                </defs>
                <path d="M0 0h283.46v283.46H0z" id="a"/>
                <path d="M111.2 256a23.23 23.23 0 0 1-13 3.92c-7.36 0-11.71-4.9-11.71-11.46 0-8.83 8.12-13.51 24.85-15.4v-2.19c0-2.87-2.18-4.53-6.2-4.53a11.76 11.76 0 0 0-9.61 4.53l-7-4q5.52-7.71 16.82-7.7c10.28 0 16 4.45 16 11.7v28.6h-9.2zm-14.55-8.3c0 2.65 1.67 5.13 4.68 5.13 3.27 0 6.44-1.36 9.62-4.16v-9.34c-9.7 1.23-14.3 3.72-14.3 8.39zM129.54 221.07l8.59-1.19.94 4.68c4.85-3.55 8.7-5.44 13.55-5.44 8.12 0 12.3 4.31 12.3 12.84v27.47h-10.37v-25.66c0-4.83-1.26-7-5-7-3.1 0-6.19 1.43-9.71 4.38v28.3h-10.3zM233.69 260.18c-11.63 0-18.57-7.47-18.57-20.45s7-20.61 18.4-20.61 18.15 7.25 18.15 20.08c0 .68-.08 1.36-.08 2h-26.27c.08 7.47 3.18 11.24 9.29 11.24 3.93 0 6.52-1.58 8.95-5l7.61 4.22c-3.35 5.58-9.37 8.52-17.48 8.52zm7.78-25.66c0-5.28-3-8.38-7.95-8.38-4.68 0-7.61 3-8 8.38zM34.89 260.61c-10.27 0-19.52-6.54-19.52-20.82S24.62 219 34.89 219s19.52 6.55 19.52 20.82-9.26 20.79-19.52 20.79zm0-32.86c-7.75 0-9.19 7-9.19 12s1.44 12.05 9.19 12.05 9.19-7 9.19-12.05-1.44-12-9.19-12zM61.53 220h9.87v4.64a15.29 15.29 0 0 1 10.87-5.45 8.6 8.6 0 0 1 1.34.07V229h-.5c-4.52 0-9.46.7-11 4.21v26.24H61.53zM190.34 251c7.88-.06 8.54-8.07 8.54-13.31 0-6.16-3-11.18-8.61-11.18-3.73 0-7.89 2.72-7.89 11.61 0 4.88.34 12.93 7.96 12.88zm18.52-31.12v37.35c0 6.6-.5 17.45-19.31 17.57-7.75 0-14.94-3.05-16.38-9.83l10.25-1.65c.43 1.94 1.61 3.88 7.42 3.88 5.39 0 8-2.58 8-8.75v-4.59l-.14-.14c-1.65 2.94-4.16 5.74-10.19 5.74-9.19 0-16.44-6.38-16.44-19.72 0-13.19 7.47-20.57 15.86-20.58 7.87 0 10.79 3.57 11.46 5.46h-.12l.85-4.72zM255.75 206.79h-4.08v11.3h-2.16v-11.3h-4.08v-1.74h10.32zm17 11.3h-2.15V207.2h-.07l-4.27 10.89h-1.36l-4.27-10.89h-.06v10.89h-2.15v-13h3.32l3.89 9.9 3.83-9.9h3.29z" id="b"/>
            </svg>
        </div>

        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <br>
            <!-- Name -->
            <div class="form-group">
                <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder=" ">
                <label for="name" class="form-label">Full Name</label>
                @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <!-- Email Address -->
            <div class="form-group">
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder=" ">
                <label for="email" class="form-label">Email</label>
                @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <!-- Password -->
            <div class="form-group">
                <input id="password" type="password" name="password" class="form-control" required placeholder=" ">
                <label for="password" class="form-label">Password</label>
                @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <!-- Confirm Password -->
            <div class="form-group">
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required placeholder=" ">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>

            <!-- Login Link -->
            <div class="forgot-password mt-3">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>
    </div>
</div>
