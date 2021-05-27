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
                    @if (Session::get('success'))
                        <div class="alert alert-success alert-dismissible" style="background-color: #ff8e8;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" style="background-color: #fca4a7;">&times;</a>
                            {{ Session::get('success') }}
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
                                               <button type="button" class="btn-sm btn-outline-info ml-2" data-toggle="modal" data-target="#Modal{{ $list->id }}">
                                                Reply
                                                </button>
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

 @foreach ($feedback as $list)
    <div class="modal fade" id="Modal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ route('feedback.reply') }}" method="POST">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reply to {{ $list->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="id" value="{{ $list->id }}">
                            {{-- <div class="form-group mb-0">
                                <label for="name">Name</label>
                                <input type="hidden" name="id" value="{{ $list->id }}">
                                <input type="text" name="name" class="form-control mb-2" readonly id="cname" value="{{ $list->name }}">
                                @error('name')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control mb-2" readonly id="email" value="{{ $list->email }}">
                                @error('email')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div> --}}
                            <div class="form-group mb-0">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control mb-2" readonly id="subject" value="{{ $list->subject }}">
                                @error('subject')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control mb-2" readonly >{{ $list->message }}</textarea>
                                @error('name')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="reply">Reply to feedback</label>
                                <textarea name="reply" class="form-control mb-2" required focus></textarea>
                                @error('reply')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Reply</button>
                </div>
                </div>
            </div>
        </form>
    </div>
@endforeach
@endsection
