@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center text-purple text-bold text">
                            User List
                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('success')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                       <tr>
                                            <td>{{ $user->firstname }}</td>
                                            <td>{{ $user->lastname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->password }}</td>
                                            <td>{{ $user->status }}</td>
                                            <td>{{ $user->role_name }}</td>
                                            <td>
                                                <a href="/admin/edit-user/{{ $user->uid }}" class="btn btn-outline-info">Edit</a>
                                                <a href="/admin/delete-user/{{ $user->uid }}" class="btn btn-outline-danger ml-2">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


