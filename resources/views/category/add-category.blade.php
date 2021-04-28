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
                        <form action="{{ route('category.store') }}" method="POST">
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