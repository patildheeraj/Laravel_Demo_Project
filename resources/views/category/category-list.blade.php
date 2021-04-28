@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center text-purple text-bold text">
                            Category List
                        </div>
                        <div class="card-body">
                            @if (Session::has('category_deleted'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('category_deleted')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>No.</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($category as $item)
                                        <tr>
                                            <td>{{ $num++ }}</td>
                                            <td>{{ $item->cname }}</td>
                                            <td>
                                                <a href="/admin/edit-category/{{$item->cid}}" class="btn btn-info ">Edit</a>
                                                <a href="/admin/delete-category/{{$item->cid}}" class="btn btn-danger ">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection