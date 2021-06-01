@extends('layouts.master')
@section('viewRegister', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Registered User List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">View Register User</li>
                </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-info shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center text-bold text">
                            Front End Registered User List
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>Register on</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                       <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->city }}</td>
                                            <td>{{ $user->state }}</td>
                                            <td>{{ $user->country }}</td>
                                            <td>{{ $user->mobile }}</td>
                                            <td>
                                                @if ($user->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Inctive</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at }}</td>
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


