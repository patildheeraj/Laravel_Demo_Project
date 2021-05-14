@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Category</h1>
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
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @if (Session::has('category_added'))
                                    <div class="alert alert-success" role="alert">
                                        {{Session::get('category_added')}}
                                        <button type="button" class="close text-success" data-dismiss="alert">×</button>
                                    </div>
                                @endif
                                <div class="form-group mb-0">
                                    <label for="cname">Category Name</label>
                                    <input type="text" name="cname" class="form-control mb-2" id="cname" placeholder="Enter Category Name">
                                    @error('cname')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label for="parent_category_id">Select Parent Category</label>
                                    <select name="parent_category_id" class="form-control mb-2" id="parent_category_id">
                                        <option value="0">Parent Category</option>
                                        @foreach ($data as $item)
                                            <option value="{{ $item->cid }}">{{ $item->cname }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_category_id')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label for="cname">Slug Name</label>
                                    <input type="text" name="slug" class="form-control mb-2" id="slug" placeholder="Enter Category Slug">
                                    @error('slug')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="file">Category Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" name="file" id="file">                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('file')
                                        <span class="text-danger font-weight-light">{{$message}}</span>        
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection