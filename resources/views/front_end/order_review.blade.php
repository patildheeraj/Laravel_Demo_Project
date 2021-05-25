<style>
    #form1{
        margin-bottom: 20px;
    }
	#btn1{
		margin-left: 0px;
	}
	#payment{
		margin-top: 0px;
	}
</style>
@extends('front_end.layout')
@section('content')
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Order Review</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step 1- Address Review</h2>
			</div>
			<div class="checkout-options">
                <section id="form1">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-1">
                                <div class="signup-form"><!--sign up form-->
                                    <h2>Billing Details</h2>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $user->address }}" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $user->city }}" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $user->state }}" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $user->country }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $user->pincode }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $user->mobile }}" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $user->email }}" >
                                    </div>
                                </div><!--/sign up form-->
                            </div>
                            <div class="col-sm-1">
                                {{-- <h2 class="or">OR</h2> --}}
                            </div>
                            <div class="col-sm-4">
                                <div class="signup-form"><!--sign up form-->
                                    <h2>Sipping Details</h2>
                                        <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $shippingDetail->name }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $shippingDetail->address }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $shippingDetail->city }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $shippingDetail->state }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $shippingDetail->country }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $shippingDetail->pincode }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $shippingDetail->mobile }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" value="{{ $shippingDetail->user_email }}" >
                                    </div>
                                </div><!--/sign up form-->
                            </div>
                        </div>
                    </div>
                </section>
			</div>
            <div class="step-one">
				<h2 class="heading">Step 2- Products Review</h2>
			</div>
			{{-- <div class="review-payment">
				<h2>Review & Payment</h2>
			</div> --}}

			<div class="table-responsive cart_info">
				<table class="table table-condensed text-center">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Item Detail</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
							$total_amount = 0;
						@endphp
						@foreach ($cart as $item)

						<tr>
							<td class="cart_product">
								<img src="{{asset('product_images')}}/{{$item->product_image}}" alt="" width="150px" height="120px">
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
									{{ $item->quantity }}
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{ $item->product_price * $item->quantity }} Rs.</p>
							</td>
							<td class="cart_delete">
							</td>
						</tr>
						@php
							$total_amount = $total_amount + ($item->product_price * $item->quantity);
						@endphp
						@endforeach

						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>{{ $total_amount }} Rs.</td>
									</tr>
									<tr>
										<td>Coupon Discount (-)</td>
										<td>
                                            @if (empty(Session::get('CouponAmount')))
                                                0 Rs.
                                            @else
                                                {{ Session::get('CouponAmount') }} Rs.
                                            @endif
                                        </td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost (+)</td>
										<td>@if ($total_amount >1000 && $total_amount>0)
                                            0 Rs.
                                            @elseif ($total_amount == 0)
                                            0 Rs.
                                            @else
                                            200 Rs.
                                        @endif </td>
									</tr>
									<tr>
                                        @if (empty(Session::get('CouponAmount')))
                                            <td>Grand Total</td>
                                            <td><span>
                                                @if ($total_amount<1000 && $total_amount>0)
                                                    {{ $grand_total = $total_amount + ($shippingCharges = 200) }}Rs.
                                                @else
                                                    {{ $grand_total = $total_amount + ($shippingCharges = 0) }}Rs.
                                                @endif
                                            </span></td>
                                        @else
                                                 <td>Grand Total</td>
                                            <td><span>
                                                @if ($total_amount<1000)
                                                    {{$grand_total = $total_amount + ($shippingCharges = 200) - Session::get('CouponAmount')}} Rs.
                                                @else
                                                    {{ $grand_total = $total_amount + ($shippingCharges = 0) - Session::get('CouponAmount') }} Rs.
                                                @endif
                                            </span></td>
                                        @endif

									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="step-one">
				<h2 class="heading">Step 3- Payment Method</h2>
			</div>
			<form name="paymentForm" id="paymentForm" action="{{ url('/place-order') }}" method="POST">
                @csrf
                <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                <input type="hidden" name="shippingCharges" value="{{ $shippingCharges }}">
                <div class="payment-options">
                    <span style="margin-left: 30px;">
                        <label><strong>Select Payment Method:</strong></label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_method" id="COD" value="COD"> <strong>Cash On Delivery</strong></label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_method" id="Paypal" value="Paypal"> <strong>Paypal</strong></label>
                    </span>
                    <span style="margin-left: 400px">

                        @if ($grand_total != 0)
                            <a class="btn btn-default check_out" href="{{ url('/cart') }}" id="payment">Update Order</a>
                            <button type="submit" class="btn btn-default check_out" id="payment" onclick="return selectPaymentMethod();">Place Order</button>
                        @else
                            <a class="btn btn-default check_out" href="{{ url('/cart') }}" id="payment">Update Order</a>
                            <button type="submit" class="btn btn-default check_out" id="payment" onclick="return selectPaymentMethod();" style="pointer-events: none;"><-- Add Item</button>
                        @endif

                    </span>
                </div>
            </form>
		</div>

	</section>
@endsection
