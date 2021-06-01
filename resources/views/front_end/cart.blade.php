<style>
#p1{
	margin-top: 5px;
	margin-left: 20px;
	color: #5f3bff;
}
#pp{
	margin-top: 5px;
	margin-left: 20px;
	color: #da0a0a;
}
#checkout{
	margin-left: 82%;
}
#btn1{
	margin-left: 82%;
}
</style>
@extends('front_end.layout')
@section('content')
  	<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Shopping Cart</li>
          </ol>
        </div>
		    @if (Session::get('success'))
				<div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('success') }}
				</div>
			@endif
			@if (Session::get('fail'))
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('fail') }}
				</div>
			@endif
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price Per Unit</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
							$total_amount = 0;
						@endphp
						@if (empty($cart))
							<tr>
								<td><h3>Cart is empty</h3></td>
							</tr>
						@else

						@foreach ($cart as $item)
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{asset('product_images')}}/{{$item->product_image}}" alt="" width="150px" height="120px"></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{ $item->product_name }}</a></h4>
									<p>Product-Id: #{{ $item->product_code }}</p>
								</td>
								<td class="cart_price">
									<p>Rs. {{ $item->product_price }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										@if ($item->quantity > 1)
											<a class="cart_quantity_down" href="{{ url('update-quantity/'.$item->product_id.'/-1') }}"> - </a>
										@else
											<a class="cart_quantity_down"  style="pointer-events: none"> - </a>
										@endif
										<input class="cart_quantity_input" type="text" name="quantity" value="{{ $item->quantity }}" autocomplete="off" readonly size="2">
										<a class="cart_quantity_up" href="{{ url('update-quantity/'.$item->product_id.'/1') }}"> + </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{ $item->product_price * $item->quantity }} Rs.</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="/delete-cart-item/{{ $item->product_id }}/{{ $item->quantity }}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@php
								$total_amount = $total_amount + ($item->product_price * $item->quantity);
							@endphp
						@endforeach
						@endif

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a coupon code you want to use.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<form action="{{ route('apply.coupon') }}" method="Post">
									@csrf
									<label>Use Coupon Code:&nbsp;&nbsp; </label>
									<input type="text" name="coupon_code">&nbsp;&nbsp;&nbsp;
									<input type="submit" class="btn-sm btn-success ml-5" value="Apply">
								</form>
							</li>
						</ul>

					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							@if(!empty(Session::get('CouponAmount')))
								<li>Cart Sub Total <span>{{ $total_amount }} Rs.</span></li>
								<li>Coupon Discount <span>{{ Session::get('CouponAmount') }} Rs.</span></li>
								<li>Shipping Cost <span> @if ($total_amount >1000)
									Free
									@elseif ($total_amount == 0)
									0 Rs.
									@else
									200 Rs.
								@endif </span></li>
								@if ($total_amount > 1000)
									<p id="p1">If your cart amount is greather then 1000 Rs. your shipping will be free.</p>
								@else
									<p id="pp">If your cart amount is less then 1000 Rs. your shipping will be applied.</p>
								@endif
								<li>Grand Total <span>@if ($total_amount >1000)
									{{ $total_amount -  Session::get('CouponAmount')}} Rs.
									@elseif ($total_amount == 0) Rs.
									0 Rs.
									@else
									{{ $total_amount + 200 -  Session::get('CouponAmount')}} Rs.
								@endif</span>
								</li>
							@else
								<li>Cart Sub Total <span>{{ $total_amount }} Rs.</span></li>
								<li>Shipping Cost <span> @if ($total_amount >1000 && $total_amount>0)
									Free
									@elseif ($total_amount == 0)
									0 Rs.
									@else
									200 Rs.
								@endif </span></li>
								@if ($total_amount > 1000)
									<p id="p1">If your cart amount is greather then 1000 Rs. your shipping will be free.</p>
								@else
									<p id="pp">If your cart amount is less then 1000 Rs. your shipping will be applied.</p>
								@endif
								<li>Grand Total <span>
									@if ($total_amount >1000 && $total_amount>0)
									{{ $total_amount }} Rs.
									@elseif ($total_amount == 0)
									0 Rs.
									@else
									{{ $total_amount + 200 }} Rs.
									@endif</span>
								</li>
							@endif
						</ul>
							{{-- <a class="btn btn-default update" href="">Update</a> --}}
							@if ($total_amount > 0)
								<a class="btn btn-default check_out" href="{{ url('/checkout') }}" id="btn1">Check Out</a>
							@else
								<a class="btn btn-default check_out" href=""  id="checkout">Check Out</a>
							@endif

					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection
