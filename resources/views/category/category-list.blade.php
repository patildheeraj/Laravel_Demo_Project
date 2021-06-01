@extends('layouts.master')
@section('category','active')
@section('menu','menu-open')
@section('category_list','active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category Management</a></li>
                    <li class="breadcrumb-item active">Category List</li>
                </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center text-purple text-bold text">
                            Category List<a href="/admin/add-category" class="btn-sm btn-outline-primary float-right">Add</a>
                        </div>
                        <div class="card-body">
                            @if (Session::has('category_deleted'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('category_deleted')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                             @if (Session::has('category_updated'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('category_updated')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                            <table id="example2" class="table table-bordered text-center">
                                <thead>
                                    <th>Category Name</th>
                                    <th>Parent Category</th>
                                    <th>Category Slug</th>
                                    <th>Category Image</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($category as $item)
                                        <tr>
                                            <td>{{ $item->cname }}</td>
                                            <td>{{ $item->parent_category_id }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>
                                                @if($item->category_image != '')
                                                    <img src="{{asset('category_images')}}/{{$item->category_image}}" style="max-width: 100px;"/></td>
                                                @else
                                                    -</td>
                                                @endif
                                            <td>
                                                <a href="/admin/edit-category/{{$item->cid}}" class="btn btn-info ">Edit</a>
                                                <a href="/admin/delete-category/{{$item->cid}}" class="btn btn-danger ">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3" align="center">
                                {!! $category->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
