<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;

        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .background-image {
            /* ... */
            opacity: 0.5;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            position: relative;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
        }

        .container label {
            display: block;
            font-weight: bold;
            color: #888;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .container input[type="submit"] {
            width: 100%;
            background-color: #ffde22;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .container input[type="submit"]:hover {
            background-color: #ffdb0f;
        }

        .container .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .container .register-link a {
            color: #888;
            text-decoration: none;
        }

        .container .register-link a:hover {
            text-decoration: underline;
        }

        .container .password-wrapper {
            position: relative;
        }

        .container .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .container .password-toggle img {
            width: 20px;
            height: 20px;
        }

        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url("img/background.jpg");
            background-size: cover;
            background-position: center;
            opacity: 0.5;
        }

        .login-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form .form-group {
            margin-bottom: 20px;
        }

        .login-form label {
            font-weight: bold;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .login-form .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var toggleImg = document.getElementById("toggle-img");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleImg.src = "img/hide-password.png";
            } else {
                passwordInput.type = "password";
                toggleImg.src = "img/show-password.png";
            }
        }
    </script>
</head>

<body>
    <div class="background-image"></div>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="{{old('email')}}" required>
            @foreach ($errors->get('email') as $item)
                <p>{{ $item }}</p>
            @endforeach

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" required>
                <div class="password-toggle" onclick="togglePasswordVisibility()">
                    <img id="toggle-img" src="img/show-password.png" alt="Toggle Password">
                </div>
            </div>
            @foreach ($errors->get('password') as $item)
                <p>{{ $item }}</p>
            @endforeach

            <input type="submit">

            <div class="register-link">
                Don't have an account? <a href="{{route('register')}}">Register here</a>.
            </div>
        </form>
    </div>
</body>

</html>
