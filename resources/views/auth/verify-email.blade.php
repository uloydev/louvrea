<!DOCTYPE html>
<html>

<head>
    <title>Register - E-commerce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(img/background.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .background-image {
            /* ... */
            opacity: 0.5;
        }

        .container {
            width: 500px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 486px;
            padding: 10px;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #f3db00;
            color: #000;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #f3db00;
        }

        .error-message {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Verify Email</h2>
        <p class="text-center">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
            we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </p>

        @if (session('status') == 'verification-link-sent')
            <p>
                A new verification link has been sent to the email address you provided during registration.
            </p>
        @endif
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button type="submit">
                        Resend Verification Email
                    </button>
                </div>
            </form>
    </div>
</body>

</html>


{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}
