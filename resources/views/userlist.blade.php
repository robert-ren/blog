<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .register-form {
            text-align: left;
            line-height: 2;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > label {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            User List
        </div>

        <form method="get">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
        <div class="container">
            <div class="card-header">{{ __('Register') }}</div>
            <form action="/user/add" method="post">
                {{ csrf_field() }}
                <div class="register-form">
                    <div class="row">
                        <label>Title:</label>
                        <select name="title">
                            <option value="Mr">Mr</option>
                            <option value="Ms">Ms</option>
                            <option value="Dr">Dr</option>
                            <option value="Miss">Miss</option>
                        </select>
                    </div>
                    <div class="row">
                        <label class="col-md-4 col-form-label text-md-right">First Name:</label>
                        <input class="col-md-8" name="first_name" required autofocus>
                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <label>Last Name:</label>
                        <input name="last_name" required autofocus>
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <label>Email:</label>
                        <input name="email" type="email" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <label>Password:</label>
                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               type="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <label>Re-type Password:</label>
                        <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                               name="password_confirmation" type="password" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <label>Gender:</label>
                        <input name="gender" type="radio" value="1" checked>Male
                        <input name="gender" type="radio" value="0">Female
                    </div>
                    <input name="Add" value="Add" type="submit" class="btn-blue">
                </div>
            </form>
        </div>
        <div class="links row">
            <ul>
                @foreach($users as $user)
                    <li>
                        <a href="{{ route('profile',$user->id) }}">Name: {{ucfirst(sprintf('%s %s',$user->first_name, $user->last_name)) }}</a>
                    </li>
                    <li>{{ number_format(10,2) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</body>
<script>

</script>
</html>
