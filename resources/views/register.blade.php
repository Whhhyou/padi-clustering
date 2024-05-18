<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <style>
        body {
            background-color: #88ddd9;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .panel {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #ffffff;
        }

        .panel-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            color: #000000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
            border-color: #ced4da;
        }

        .btn-register {
            background-color: #4caf50;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }

        .btn-register:hover {
            background-color: #0056b3;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel">
                <h2 class="panel-title">REGISTER</h2>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <form action="{{ route('actionregister') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><i class="fa fa-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-user"></i> Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Username" required="">
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-key"></i> Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password"
                            required="">
                    </div>
                    <button type="submit" class="btn btn-register btn-block"><i class="fa fa-user"></i>
                        Register</button>
                    <div class="login-link">
                        <p>Sudah punya akun? Silahkan <a href="{{ route('login') }}">Login Disini!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
