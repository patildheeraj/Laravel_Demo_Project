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
                            Coupon List<a href="/admin/coupon-add" class="btn-sm btn-outline-primary float-right">Add</a>
                        </div>
                        <div class="card-body">
                            @if (Session::has('product_deleted'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    {{ session('product_deleted') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif

                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>Coupon Code</th>
                                    <th>Coupon Type</th>
                                    <th>Coupon Value</th>
                                    <th>Minimum Purchase Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($coupon as $item)
                                        <tr>
                                            <td>{{ $item->coupon_code }}</td>
                                            <td>{{ $item->coupon_type }}</td>
                                            <td>
                                                @if ($item->coupon_type == 'fixed_value')
                                                    {{ $item->coupon_value }} Rs.</td>
                                                @else
                                                    {{ $item->coupon_value }}%</td>
                                                @endif
                                            <td>{{ $item->minimum_purchase }} Rs.</td>
                                            <td> 
                                                @if ($item->status ==1)
                                                    <a href="{{ url('admin/coupon/status/0')}}/{{ $item->id }}" class="btn btn-sm btn-success">Active</a>
                                                @elseif ($item->status ==0)
                                                    <a href="{{ url('admin/coupon/status/1')}}/{{ $item->id }}" class="btn btn-sm btn-warning">Deactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/admin/edit-coupon/{{$item->id}}" class="btn btn-sm btn-info ">Edit</a>
                                                <a href="/admin/delete-coupon/{{$item->id}}" class="btn btn-sm btn-danger ">Delete</a>
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