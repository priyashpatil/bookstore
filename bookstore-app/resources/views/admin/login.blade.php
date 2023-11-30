<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Signin Template · Bootstrap v5.3</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto">
    <form method="post">
        @csrf

        <h1 class="h3 fw-normal mb-1">BookStore Login</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

        <div class="form-floating">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   id="floatingInput"
                   placeholder="name@example.com" required value="{{old('email')}}">
            <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control @error('email') is-invalid @enderror"
                   id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        @if ($errors->any())
            <div class="text-danger mb-3">
                {{$errors->first()}}
            </div>
        @endif

        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    </form>
</main>
</body>
</html>
