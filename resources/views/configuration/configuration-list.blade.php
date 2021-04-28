@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Configuration Management</h1>
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
                            Configuration List
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
                                    <th>Admin Email</th>
                                    <th>Notification Email</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            {{-- <td>{{ $item->admin_email }}</td>
                                            <td>{{ $item->notification_email }}</td> --}}
                                            <td>{{ Config::get('constants.admin_email') }}</td>
                                            <td>{{ Config::get('constants.notification_email') }}</td>
                                            <td>
                                                <a href="/admin/edit-configuration/{{$item->id}}" class="btn btn-info ">Edit</a>
                                                <a href="/admin/delete-configuration/{{$item->id}}" class="btn btn-danger ">Delete</a>
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