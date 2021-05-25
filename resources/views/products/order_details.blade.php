@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Orders Details Number: #{{ $order->id }}</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            @if (Session::get('success'))
					<div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{ Session::get('success') }}
					</div>
				@endif
            <div class="row">
                <div class="col-6">
                    <div class="card-info shadow mb-5 bg-white rounded">
                        <div class="card-header text-center">
                            <strong>Order Detail</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Order Date</th>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Order Status</th>
                                    <td>{{ $order->order_status }}</td>
                                </tr>  
                                <tr>
                                    <form action="{{ route('order.status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <th><select name="order_status" class="form-control">
                                            <option value="New" @if ($order->order_status == "New")
                                                selected
                                            @endif>New</option> 
                                            <option value="Accepted" @if ($order->order_status == "Accepted")
                                                selected
                                            @endif>Accepted</option> 
                                            <option value="Shipped" @if ($order->order_status == "Shipped")
                                                selected
                                            @endif>Shipped</option>  
                                            <option value="On the way" @if ($order->order_status == "On the way")
                                                selected
                                            @endif>On the way</option>  
                                            <option value="Delivered" @if ($order->order_status == "Delivered")
                                                selected
                                            @endif>Delivered</option> 

                                            <option value="Cancelled" @if ($order->order_status == "Cancelled")
                                                selected
                                            @endif>Cancelled</option> 
                                        </select></th>
                                        <td><input type="submit" value="Update Status"></td>
                                    </form>
                                </tr>          
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-info shadow mb-5 bg-white rounded">
                        <div class="card-header text-center">
                            <strong>Coustomer Detail</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Customer Name</th>
                                    <td>{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <th>Customer Email</th>
                                    <td>{{ $order->user_email }}</td>
                                </tr>
                                <tr>
                                    <th>Customer Mobile</th>
                                    <td>{{ $order->mobile }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-info shadow mb-5 bg-white rounded">
                        <div class="card-header text-center">
                            <strong>Order Payment Details</strong>
                        </div>
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Grand Total</th>
                                            <td>{{ $order->grand_total }} Rs.</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Charges</th>
                                            <td>{{ $order->shipping_charges }} Rs.</td>
                                        </tr>
                                        <tr>
                                            <th>Total Product Buy</th>
                                            <td>{{ $total_product_buy }}</td>
                                        </tr>
                                    </table>
                                </div>    
                                <div class="col-6">
                                     <table class="table table-bordered">
                                        <tr>
                                            <th>Coupon Code</th>
                                            <td>{{ $order->coupon_code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Coupon Amount</th>
                                            <td>{{ $order->coupon_amount }} Rs.</td>
                                        </tr>
                                         <tr>
                                            <th>Payment Method</th>
                                            <td>{{ $order->payment_method }}    </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card-info shadow mb-5 bg-white rounded">
                        <div class="card-header text-center">
                            <strong>Billing Address</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $order->address }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $order->city }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $order->state }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $order->country }}</td>
                                </tr>
                                <tr>
                                    <th>Pincode</th>
                                    <td>{{ $order->pincode }}</td>
                                </tr>  
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-info shadow mb-5 bg-white rounded">
                        <div class="card-header text-center">
                            <strong>Delivery Address</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $shippingDetail->address }}</td>
                                </tr>
                                    <tr>
                                    <th>City</th>
                                    <td>{{ $shippingDetail->city }}</td>
                                </tr>
                                    <tr>
                                    <th>State</th>
                                    <td>{{ $shippingDetail->state }}</td>
                                </tr>
                                    <tr>
                                    <th>Country</th>
                                    <td>{{ $shippingDetail->country }}</td>
                                </tr>
                                    <tr>
                                    <th>Pincode</th>
                                    <td>{{ $shippingDetail->pincode }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-primary shadow mb-5 bg-white rounded">
                <div class="card-header text-center">
                    <strong>Products Detail</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Product Image</th>
                        </thead>
                        <tbody>
                            @foreach ($order->orders as $item)
                                <tr>
                                    <td>#{{ $item->product_code }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_price }} Rs.</td>
                                    <td>{{ $item->product_qyt }}</td>
                                    <td><img src="{{asset('product_images')}}/{{$item->product_image}}" style="max-width: 100px;"/></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection