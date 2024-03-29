<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ ('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ ('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ ('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
                @if (Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::get('fail'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('fail') }}
                    </div>
                @endif
            <form action="{{ route('auth.save') }}" method="POST">
                @csrf
                <div class="input-group mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Full name" value="{{ old('name') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
                <div class="form-group">
                    <select name='role' class="custom-select rounded-0" id="exampleSelectRounded0">
                      <option value="">Select Role</option>
                      @foreach ($admins as $admin)
                      <option value="{{ $admin->role_id }}">{{ $admin->role_name }}</option>
                      @endforeach
                    </select>
                </div>
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
                <div class="input-group mb-2">
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
                <div class="input-group mb-2 mt-2">
                    <input type="password" name="conpass" class="form-control" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger">
                    @error('conpass')
                        {{ $message }}
                    @enderror
                </span>
                <div class="input-group mb-2">
                    <label for="status" class="mr-2">Status</label>

                    <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status">Active
                    </label>
                    </div>
                    <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status">Inactive
                    </label>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
            {{-- <a href="{{ url('adminlogin') }}" class="text-center">I already have a account, sign in</a> --}}
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ ('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ ('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ ('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
