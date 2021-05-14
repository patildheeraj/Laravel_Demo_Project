@extends('layouts.master')
@section('content')
<div class="content-wrapper">
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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Configuration</h3>
                        </div>
                        <form action="{{ route('configuration.update') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{Session::get('success')}}
                                        <button type="button" class="close text-success" data-dismiss="alert">×</button>
                                    </div>
                                @endif
                                <div class="form-group mb-0">
                                    <label for="admin_email">Admin Email</label>
                                    {{-- <input type="hidden" name="id" value="{{ $data->id }}"> --}}
                                    <input type="text" name="admin_email" class="form-control mb-2" id="admin_email" value="{{ $data[0] }}">
                                    @error('admin_email')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label for="notification_email">Notification Email</label>
                                    <input type="text" name="notification_email" class="form-control mb-2" id="notification_email" value="{{ $data[1] }}">
                                    @error('notification_email')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection