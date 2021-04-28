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
                            <h3 class="card-title">Edit User</h3>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close text-success" data-dismiss="alert">×</button>
                            </div>
                        @endif
                        <form action="{{ route('user.update') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="hidden" name="uid" value="{{ $users->uid }}">
                                    <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{ $users->firstname }}">
                                    @error('firstname')
                                        <div class="invalid-feeedback text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname" value="{{ $users->lastname }}">
                                    @error('lastname')
                                    <div class="invalid-feeedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control @error('firstname') is-invalid @enderror" id="email" value="{{ $users->email }}">
                                    @error('email')
                                    <div class="invalid-feeedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" class="form-control @error('firstname') is-invalid @enderror" id="password" value="{{ $users->password }}">
                                    @error('password')
                                    <div class="invalid-feeedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="conpass">Confirm Password</label>
                                    <input type="text" name="conpass" class="form-control @error('firstname') is-invalid @enderror" id="conpass" value="{{ $users->password }}">
                                    @error('conpass')
                                    <div class="invalid-feeedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <label for="status">Status</label>
                                <br>
                                <div class="form-group form-check-inline">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input @error('status') is-invalid @enderror" id="Radio1" name="status" value="active"  {{ $users->status == 'active' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Radio1">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input @error('status') is-invalid @enderror" id="Radio2" name="status" value="inactive" {{ $users->status == 'inactive' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Radio2">Inactive</label>
                                    </div>
                                    @error('status')
                                    <div class="invalid-feeedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role">Product Category</label>
                                    <select name='role' class="custom-select rounded-0 @error('role') is-invalid @enderror" >
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_id }}" {{$users->role  == $role->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option> 
                                    @endforeach                      
                                    </select>
                                    @error('role')
                                    <div class="invalid-feeedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Update User</button>
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