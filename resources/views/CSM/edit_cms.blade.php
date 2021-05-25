@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">CMS Management</h1>
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
                    <h3 class="card-title">Edit CMS Page</h3>
                    </div>
                    <form action="{{ url('/admin/update-cms-page') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (Session::has('category_updated'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('category_updated')}}
                                    <button type="button" class="close text-success" data-dismiss="alert">×</button>
                                </div>
                            @endif
                            <div class="form-group mb-0">
                                <label for="title">Title</label>
                                <input type="hidden" name="id" value="{{ $cms->id }}">
                                <input type="text" name="title" class="form-control mb-2" id="title" value="{{ $cms->title }}">
                                @error('title')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" placeholder="CMS Page Description">{{ $cms->description }}</textarea>
                                @error('description')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="url">URL</label>
                                <input type="text" name="url" class="form-control mb-2" id="url" value="{{ $cms->url }}">
                                @error('url')
                                    <span class="text-danger font-weight-light">{{$message}}</span>        
                                @enderror
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" name="status" id="status" value="1" @if ($cms->status == 1) checked @endif>
                                <label class="form-check-label" for="status">Enable</label>
                            </div>
                        </div>
                        

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update CMS Page</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection