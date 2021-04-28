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
                    <h3 class="card-title">Update Category</h3>
                    </div>
                    <form action="{{ route('category.update') }}" method="POST">
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