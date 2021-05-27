<!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> --}}
<style>
.title {
    color: rgb(252, 103, 49);
    font-weight: 600;
    margin-bottom: 2vh;
    padding: 0 8%;
    font-size: initial
}


#progressbar {
    margin-bottom: 3vh;
    overflow: hidden;
    color: rgb(252, 103, 49);
    padding-left: 0px;
    margin-top: 3vh
}

#progressbar li {
    list-style-type: none;
    font-size: x-small;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400;
    color: rgb(160, 159, 159)
}

#progressbar #step1:before {
    content: "";
    color: rgb(252, 103, 49);
    width: 5px;
    height: 5px;
    margin-left: 0px !important
}

#progressbar #step2:before {
    content: "";
    color: #fff;
    width: 5px;
    height: 5px;
    margin-left: 32%
}

#progressbar #step3:before {
    content: "";
    color: #fff;
    width: 5px;
    height: 5px;
    margin-right: 32%
}

#progressbar #step4:before {
    content: "";
    color: #fff;
    width: 5px;
    height: 5px;
    margin-right: 0px !important
}

#progressbar li:before {
    line-height: 29px;
    display: block;
    font-size: 12px;
    background: #ddd;
    border-radius: 50%;
    margin: auto;
    z-index: -1;
    margin-bottom: 1vh
}

#progressbar li:after {
    content: '';
    height: 2px;
    background: #ddd;
    position: absolute;
    left: 0%;
    right: 0%;
    margin-bottom: 2vh;
    top: 1px;
    z-index: 1
}

.progress-track {
    padding: 0 8%
}

#progressbar li:nth-child(2):after {
    margin-right: auto
}

#progressbar li:nth-child(1):after {
    margin: auto
}

#progressbar li:nth-child(3):after {
    float: left;
    width: 68%
}

#progressbar li:nth-child(4):after {
    margin-left: auto;
    width: 132%
}

#progressbar li.active {
    color: black
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: rgb(252, 103, 49)
}
</style>
@extends('front_end.layout')
@section('content')
      	<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">My Order</li>
          </ol>
        </div>
	</section>
	<section id="do_action">
		<div class="container">
            <div class="step-one">
				<h2 class="heading">User Information</h2>
			</div>
			<div class="row">
                <div class="col-md-4">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center">
                           <strong>Persnal Detail</strong>
                        </div><br>
                        <div class="card-body">
                            <table class="table text-center table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $userDetails->name }}</td>
                                    </tr>
                                     <tr>
                                        <th>Email</th>
                                        <td>{{ $userDetails->email }}</td>
                                    </tr>
                                     <tr>
                                        <th>Mobile</th>
                                        <td>{{ $userDetails->mobile }}</td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card  shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center">
                            <strong>Billing Address</strong>
                        </div><br>
                        <div class="card-body">
                            <table class="table text-center table-bordered">
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $userDetails->address }}</td>
                                </tr>
                                 <tr>
                                    <th>City</th>
                                    <td>{{ $userDetails->city }}</td>
                                </tr>
                                 <tr>
                                    <th>State</th>
                                    <td>{{ $userDetails->state }}</td>
                                </tr>
                                 <tr>
                                    <th>Country</th>
                                    <td>{{ $userDetails->country }}</td>
                                </tr>
                                 <tr>
                                    <th>Pincode</th>
                                    <td>{{ $userDetails->pincode }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card  shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center">
                            <strong>Delivery Address</strong>
                        </div><br>
                        <div class="card-body">
                            <table class="table text-center table-bordered">
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
			</div><hr><br>
            <div class="step-one">
				<h2 class="heading">Order Details</h2>
			</div>
            <table id="example" class="table table-striped table-bordered nowrap shadow p-3 mb-5 bg-white rounded text-center" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Order Id</th>
                        <th class="text-center">Order Product</th>
                        <th class="text-center">Payment Method</th>
                        <th class="text-center">Coupon</th>
                        <th class="text-center">Coupon Amount</th>
                        <th class="text-center">Shipping Charges</th>
                        <th class="text-center">Grand Total</th>
                        <th class="text-center">Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @foreach ($order->orders as $product)
                                <a data-toggle="modal" data-target="#{{ $product->product_code }}" style="cursor: pointer; color:blueviolet;">
                                 Product Code: #{{ $product->product_code }} <br>
                                </a>
                            @endforeach
                        </td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->coupon_code }} </td>
                        <td>{{ $order->coupon_amount }}Rs.</td>
                        <td>{{ $order->shipping_charges }} Rs.</td>
                        <td>{{ $order->grand_total }} Rs.</td>
                        <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal{{$order->id}}">
                        Track Order

                    </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
	</section>

<!-- Modal -->
 @foreach ($orders as $order)
  @foreach ($order->orders as $product)
<div class="modal fade" id="{{ $product->product_code }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <p>Product Code: #{{ $product->product_code }}</p>
                                <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />
                                <span>
                                    <span>{{ $product->product_price }} Rs.</span>
                                    <label>Quantity:</label>
                                    <input type="text" value="{{ $product->product_qyt }}" name="quantity" readonly/>
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
<div class="modal fade" id="modal{{$order->id}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Track Order</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <div class="text-center">
                    <table class="table table-bordered text-center">
                        <tr>
                            <td class="text-info "><strong>Order Status </strong></td>
                            <td class="@if ($order->order_status == 'Cancelled')
                                text-danger
                            @else
                                text-success
                            @endif"><strong> {{ $order->order_status }}</strong></td>
                        </tr>
                    </table>
                </div>
    <div class="tracking">
        @if ($order->order_status == "New")
            <div class="title">Tracking Order: <span class="text-success">In Process</span></div>
        @elseif ($order->order_status == "Cancelled")
            <div class="title ">Tracking Order: <span class="text-danger">Order Cancelled</span></div>
        @else
            <div class="title">Tracking Order</div>
        @endif
    </div>
    <div class="progress-track">
        <ul id="progressbar">
            @if ($order->order_status == "Accepted")
                <li class="step0  active" id="step1">Accepted</li>
                <li class="step0 text-center" id="step2">Shipped</li>
                <li class="step0 text-right" id="step3">On the way</li>
                <li class="step0 text-right" id="step4">Delivered</li>
            @elseif ($order->order_status == "Shipped")
                <li class="step0 active" id="step1">Accepted</li>
                <li class="step0 active text-center" id="step2">Shipped</li>
                <li class="step0 text-right" id="step3">On the way</li>
                <li class="step0 text-right" id="step4">Delivered</li>
            @elseif ($order->order_status == "On the way")
                <li class="step0 active" id="step1">Accepted</li>
                <li class="step0 active text-center" id="step2">Shipped</li>
                <li class="step0 active text-right" id="step3">On the way</li>
                <li class="step0 text-right" id="step4">Delivered</li>
            @elseif ($order->order_status == "Delivered")
                <li class="step0 active" id="step1">Accepted</li>
                <li class="step0 active text-center" id="step2">Shipped</li>
                <li class="step0 active text-right" id="step3">On the way</li>
                <li class="step0 active text-right" id="step4">Delivered</li>
            @elseif ($order->order_status == "Cancelled" || $order->order_status == "New")
                <li class="step0" id="step1">Accepted</li>
                <li class="step0 text-center" id="step2">Shipped</li>
                <li class="step0 text-right" id="step3">On the way</li>
                <li class="step0 text-right" id="step4">Delivered</li>

            @endif
        </ul>
    </div><br><br>
               <div class="card-info shadow mb-5 bg-white rounded">
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
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endforeach
@endforeach

@endsection

