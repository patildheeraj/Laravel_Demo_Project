@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Banner</h1>
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
                    <h3 class="card-title">Add New Banner</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if (Session::has('product_added'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('product_added')}}
                        <button type="button" class="close text-success" data-dismiss="alert">×</button>
                    </div>
                @endif
                    <form action="{{ route('Banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Banner Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter Banner Title">
                                @error('title')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sub_title">Banner Subtitle</label>
                                <input type="text" name="sub_title" class="form-control" value="{{ old('sub_title') }}" placeholder="Enter Banner Subtitle">
                                @error('sub_title')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Banner Link</label>
                                <input type="link" name="link" class="form-control" value="{{ old('link') }}" placeholder="Enter Banner Link">
                                @error('link')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Banner Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" name="file" id="file">
                                        {{-- <label class="custom-file-label" for="file">Choose file</label> --}}
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
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