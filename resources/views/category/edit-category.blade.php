@extends('layouts.master')
@section('category','active')
@section('menu','menu-open')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Category Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category Management</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
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
                    <h3 class="card-title">Update Category</h3>
                    </div>
                    <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @if (Session::has('category_updated'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('category_updated')}}
                                    <button type="button" class="close text-success" data-dismiss="alert">×</button>
                                </div>
                            @endif
                            <div class="form-group mb-0">
                                <label for="cname">Category Name</label>
                                <input type="hidden" name="cid" value="{{ $category->cid }}">
                                <input type="text" name="cname" class="form-control mb-2" id="cname" value="{{ $category->cname }}">
                                @error('cname')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="parent_category_id">Select Parent Category</label>
                                <select name="parent_category_id" class="form-control mb-2" id="parent_category_id">
                                     @foreach($parent_category as $item)
                                        <option value="{{ $item->cid }}" {{$category->parent_category_id == $item->cid ? 'selected' : '' }}>{{ $item->cname }}</option>
                                    @endforeach
                                </select>
                                @error('parent_category_id')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="slug">Category Slug</label>
                                <input type="text" name="slug" class="form-control mb-2" id="slug" value="{{ $category->slug }}">
                                @error('slug')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                    <label for="file">Category Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" name="file" />
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @if($category->category_image)
                                        <img id="original" src="{{asset('category_images')}}/{{$category->category_image}}" height="100" width="120">
                                    @endif
                                    @error('file')
                                        <span class="text-danger font-weight-light">{{$message}}</span>
                                    @enderror
                                </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection
