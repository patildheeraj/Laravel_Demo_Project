@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">CMS Pages List</h1>
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
                            CMS Page List<a href="{{ url('/admin/add-cms-page') }}" class="btn-sm btn-outline-primary float-right">Add</a>
                        </div>
                        <div class="card-body">
                            @if (Session::has('category_deleted'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('category_deleted')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                             @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('success')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($cms as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->url }}</td>
                                            <td>{{ $item->status }}</td>  
                                            <td>
                                                <a href="/admin/edit-cms-page/{{$item->id}}" class="btn-sm btn-info ">Edit</a>
                                                <a href="/admin/delete-cms-page/{{$item->id}}" class="btn-sm btn-danger ">Delete</a>
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