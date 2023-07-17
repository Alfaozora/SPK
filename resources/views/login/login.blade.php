<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SPK BLT-DD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset ('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset ('css/login.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="my-login-page">
    <style>
        body {
            background-image: url("gambar/BG.PNG");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{asset ('gambar/logo.jpg')}}" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h3 class="card-title">Login</h3>
                            <form action="/login/action" method="POST" class="my-login-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Masukan Username" required autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password
                                        <!-- <a href="#" class="float-right">
                                            Lupa Kata Sandi?
                                        </a> -->
                                    </label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Masukan Password" required data-eye>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <!-- <div class="custom-checkbox custom-control">
                                            <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                            <label for="remember" class="custom-control-label">Ingat Saya</label>
                                        </div> -->
                                    </div>

                                    <div class="form-group m-0">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Login
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="footer">
                    Copyright &copy; 2023 &mdash; SPK GEDONGBOYOUNTUNG
                </div>
            </div>
        </div>
        <script src="{{asset ('js/jquery-1.11.1.min.js')}}"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="{{asset ('js/custom.js')}}"></script>
        <script src="{{asset ('js/my-login.js')}}"></script>
</body>

</html>