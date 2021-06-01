@extends('layouts.master')
@section('banner_menu','menu-open')
@section('banner', 'active')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Banner Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Banner Management</a></li>
                    <li class="breadcrumb-item active">Edit Banner</li>
                </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Update Banner</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if (Session::has('product_added'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('product_added')}}
                        <button type="button" class="close text-success" data-dismiss="alert">×</button>
                    </div>
                @endif
                    <form action="{{ route('Banner.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Banner Title</label>
                                <input type="hidden" name="bid" value="{{ $data->bid }}">
                                <input type="text" name="title" class="form-control" value="{{ $data->title }}">
                                @error('title')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sub_title">Banner Subtitle</label>
                                <input type="text" name="sub_title" class="form-control" value="{{ $data->sub_title }}">
                                @error('sub_title')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Banner Link</label>
                                <input type="link" name="link" class="form-control" value="{{ $data->link }}">
                                @error('link')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Banner Image</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" name="file" id="file" value="{{asset('banner_images')}}/{{$data->bimage}}">
                                        {{-- <label class="custom-file-label" for="file">Choose file</label> --}}
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                @if($data->bimage)
                                        <img id="original" src="{{asset('banner_images')}}/{{$data->bimage}}" height="100" width="120">
                                    @endif
                                @error('file')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection
