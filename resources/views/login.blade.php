<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #88ddd9; /* Warna latar belakang untuk tampilan desktop */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #edf0f2; /* Warna latar belakang untuk bagian dalam kontainer */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: rgb(254, 254, 254);
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .register {
            text-align: center;
            margin-top: 20px;
        }

        .register a {
            color: #4caf50;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }

        label {
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
            width: 100%;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Login</h1>
        @if ($errors->has('loginError'))
            <div class="error">
                {{ $errors->first('loginError') }}
            </div>
        @endif
        <form id="loginForm" action="{{ route('actionlogin') }}" method="post" onsubmit="return validateForm()">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required="">
            <input type="submit" value="Log In">
        </form>
        <div class="register">
            <p>Belum punya akun? <a href="/register">Register</a> sekarang!</p>
        </div>
    </div>

    <script>
        function validateForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Email atau password salah');
            }

            return true; // Tetap mengirimkan form ke server
        }
    </script>

</body>

</html>
