@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">User Management</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New User</h3>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close text-success" data-dismiss="alert">×</button>
                            </div>
                        @endif
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{ old('firstname') }}" placeholder="First Name">
                                    @error('firstname')
                                        <div class="invalid-feeedback text-danger font-weight-light">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname" value="{{ old('lastname') }}" placeholder="Last Name">
                                    @error('lastname')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control @error('firstname') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Enter email">
                                    @error('email')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control @error('firstname') is-invalid @enderror" id="password" placeholder="Password">
                                    @error('password')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="conpass">Confirm Password</label>
                                    <input type="password" name="conpass" class="form-control @error('firstname') is-invalid @enderror" id="conpass" placeholder="Confirm Password">
                                    @error('conpass')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <label for="status">Status</label>
                                <br>
                                <div class="form-group form-check-inline">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input @error('status') is-invalid @enderror" id="Radio1" name="status" value="active" {{ old('status')=='active' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Radio1">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input @error('status') is-invalid @enderror" id="Radio2" name="status" value="inactive" {{ old('status')=='inactive' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Radio2">Inactive</label>
                                    </div>
                                    @error('status')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role">Product Category</label>
                                    <select name='role' class="custom-select rounded-0 @error('role') is-invalid @enderror" >
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_id }}" {{ $role->role_id == 5 ? 'selected' : '' }}>{{ $role->role_name }}</option> 
                                    @endforeach                      
                                    </select>
                                    @error('role')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Add User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection