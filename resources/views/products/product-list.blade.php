@extends('layouts.master')
@section('product_menu','menu-open')
@section('product','active')
@section('product_list', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Product Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Product Management</a></li>
                    <li class="breadcrumb-item active">Product List</li>
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
                            Product List<a href="/admin/add-product" class="btn-sm btn-outline-primary float-right">Add</a>
                        </div>
                        <div class="card-body">
                            @if (Session::has('product_deleted'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('product_deleted')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                             @if (Session::has('pass'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('pass')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Product Price</th>
                                    <th>Product Stock</th>
                                    <th>Product Description</th>
                                    <th>Material & Care</th>
                                    <th>Product category</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>#{{ $item->product_code }}</td>
                                            <td>{{ $item->pname }}</td>
                                            <td><img src="{{asset('product_images')}}/{{$item->pimage}}" style="max-width: 100px;"/></td>
                                            <td>{{ $item->pprice }} Rs.</td>
                                            <td>{{ $item->pstock }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->care }}</td>
                                            <td>{{ $item->cname }}</td>
                                            <td>
                                                <a href="/admin/edit-product/{{$item->pid}}" class="btn-sm btn-info">Edit</a>
                                                <a href="/admin/delete-product/{{$item->pid}}" class="btn-sm btn-danger ">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3" align="center">
                                {!! $products->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
