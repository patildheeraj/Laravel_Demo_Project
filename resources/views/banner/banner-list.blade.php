@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Banner</h1>
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
                            Banner List <a href="/admin/banner-add" class="btn-sm btn-outline-primary float-right">Add</a>
                        </div>
                        <div class="card-body">
                            @if (Session::has('product_deleted'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('product_deleted')}}
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                </div>
                            @endif
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>Banner Title</th>
                                    <th>Banner Subtitle</th>
                                    <th>Banner link</th>
                                    <th>Banner Image</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->sub_title }}</td>
                                            <td>{{ $item->link }}</td>
                                            <td><img src="{{asset('banner_images')}}/{{$item->bimage}}" style="max-width: 100px;"/></td>
                                            <td>
                                                <a href="/admin/edit-banner/{{$item->bid}}" class="btn btn-info ">Edit</a>
                                                <a href="/admin/delete-banner/{{$item->bid}}" class="btn btn-danger ">Delete</a>
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