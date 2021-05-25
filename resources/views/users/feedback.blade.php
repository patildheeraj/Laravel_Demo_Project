@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">User Feedback Table</h1>
            </div>
          </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (Session::get('fail'))
                                <div class="alert alert-danger alert-dismissible" style="background-color: #ff8e8;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" style="background-color: #fca4a7;">&times;</a>
                                    {{ Session::get('fail') }}
                                </div>
                            @endif
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title text-center">User Feedback</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($feedback as $list)
                                        <tr>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->email }}</td>
                                            <td>{{ $list->mobile }}</td>
                                            <td>{{ $list->subject }}</td>
                                            <td>{{ $list->message }}</td>
                                            <td>{{ $list->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="/admin/delete-feedback/{{ $list->id }}" class="btn-sm btn-outline-danger ml-2">Delete</a>
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