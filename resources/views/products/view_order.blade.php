@extends('layouts.master')
@section('viewOrder', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Order Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">View Orders</li>
                </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                      <div class="card-header text-center">
                        <strong>Customer Orders Detail</strong>
                      </div>
                        <div class="card-body">
                          <table id="example2" class="table table-bordered data-table"  style="width: 100%;">
                              <thead>
                                  <th>Order ID</th>
                                  <th>Order Date</th>
                                  <th>Customer Name</th>
                                  <th>Ordered Products</th>
                                  <th>Order Amount</th>
                                  <th>Order Status</th>
                                  <th>Payment Method</th>
                                  <th>Action</th>
                              </thead>
                              <tbody>
                                @foreach ($orders as $order)
                                  <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>
                                         @foreach ($order->orders as $product)
                                            Product Code: <a data-toggle="modal" data-target="#model{{ $product->product_code }}" style="cursor: pointer; color:blueviolet;">
                                             #{{ $product->product_code }} <br>
                                            </a>
                                        @endforeach
                                    </td>
                                    <td>{{ $order->grand_total }} Rs.</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td align="center">
                                      <a href="{{ url('/admin/view-order/'.$order->id) }}" target="_blank" class="btn-sm btn-info">View</a><br><br>
                                      {{-- <a href="{{ url('/admin/order-invoice/'.$order->id) }}" target="_blank" class="btn-sm btn-success">Invoice</a> --}}
                                    </td>
                                  </tr>
                                @endforeach

                              </tbody>

                          </table>
                          <div class="d-flex justify-content-center mt-3" align="center">
                                        {!! $orders->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@foreach ($orders as $order)
    @foreach ($order->orders as $product)
        <div class="modal fade" id="model{{ $product->product_code }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Product Detail</strong></h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="product-details"><!--product-details-->
                                    <div class="col-sm-5">
                                        <div class="view-product">
                                            <img src="{{asset('product_images')}}/{{$product->product_image}}" alt="" width="200px" height="150px;"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="product-information"><!--/product-information-->
                                            <img src="{{ asset('frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                                            <h2>{{ $product->product_name }}</h2>
                                            <p><b>Product Code: #{{ $product->product_code }}</b></p>
                                            <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" /><br>
                                            <span>
                                                <strong style="font-size: 35px;">{{ $product->product_price }} Rs.</strong><br>
                                                <label>Quantity:</label>
                                                <input type="text" class="text-center" value="{{ $product->product_qyt }}" name="quantity" readonly size="1px;"/>
                                            </span>
                                            <p><b>Condition:</b> New</p>
                                            <a href=""><img src="{{ asset('frontend/images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a>
                                        </div>
                                    </div>
                                </div><!--/product-details-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach
@endsection

