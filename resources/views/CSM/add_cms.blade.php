@extends('layouts.master')
@section('cms_menu','menu-open')
@section('cms', 'active')
@section('cms_add', 'active')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">CMS Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">CMS Management</a></li>
                    <li class="breadcrumb-item active">Add CMS</li>
                </ol>
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
                            <h3 class="card-title">Add New CMS Page</h3>
                        </div>
                        <form action="{{ url('/admin/store-cms-page') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @if (Session::has('category_added'))
                                    <div class="alert alert-success" role="alert">
                                        {{Session::get('category_added')}}
                                        <button type="button" class="close text-success" data-dismiss="alert">×</button>
                                    </div>
                                @endif
                                <div class="form-group mb-0">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control mb-2" id="title" placeholder="CMS Page Title">
                                    @error('title')
                                        <span class="text-danger font-weight-light">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" placeholder="CMS Page Description"></textarea>
                                    @error('description')
                                        <span class="text-danger font-weight-light">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label for="url">URL</label>
                                    <input type="text" name="url" class="form-control mb-2" id="url" placeholder="CMS Page URL">
                                    @error('url')
                                        <span class="text-danger font-weight-light">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input position-static" type="checkbox" name="status" id="status" value="1">
                                    <label class="form-check-label" for="status">Enable</label>
                                </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add CMS Page</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
