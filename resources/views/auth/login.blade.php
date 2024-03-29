<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin E-Shopper | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ ('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ ('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ ('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="/adminlogin" class="h1"><b>Admin</b> E-Shopper</a>
        </div>
  <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::get('fail'))
                <div class="alert alert-danger alert-dismissible fade-in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('fail') }}
                </div>
            @endif
            <form action="{{ route('auth.check') }}" method="POST">
            {{ csrf_field() }}
                <div class="input-group mb-2">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
                <div class="input-group mt-2">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
                <div class="row mb-2">
                <div class="col-4 mt-2">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                </div>
            </form>
            {{-- <p class="mb-0">
                <a href="{{ url('/adminregister') }}" class="text-center">Register a new membership</a>
            </p> --}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ ('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ ('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ ('dist/js/adminlte.min.js') }}"></script>

</body>
</html>
