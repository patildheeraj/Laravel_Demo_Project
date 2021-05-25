@extends('front_end.layout')
@section('content')
      	<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Payment Amount</li>
          </ol>
        </div>
	</section>

	<section id="do_action">
		<div class="container">
			<div class="heading text-center">
				<h3>YOUR  ORDER HAS BEEN PLACED SUCCESSFULLY!!</h3>
				<p>Your order number is {{Session::get('order_id')}} and total payble amount is  {{ Session::get('grand_total') }} Rs.</p>
        <p>Clicking Payment Button for Payment Online by the Paypal </p>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST">
          <input type="text" name="cmd" value="_xclick">
          {{-- <input type="text" name="hosted_button_id" value="221"> --}}
          <input type="text" name="business" value="sb-kyhup6087226@business.example.com">
           <input type="text" name="currency_code" value="INR">
          <input type="text" name="item_name" value="{{Session::get('order_id')}}">
          <input type="text" name="item_number" value="{{Session::get('order_id')}}">
          <input type="text" name="amount" value="{{ round($orderDetails->grand_total,2) }}">
          <input type="text" name="first_name" value="{{ $nameArr[0] }}">
          <input type="text" name="last_name" value="{{ $nameArr[1] }}">
          <input type="text" name="address1" value="{{ $orderDetails->address }}">
          <input type="text" name="city" value="{{ $orderDetails->city }}">
          <input type="text" name="state" value="{{ $orderDetails->state }}">
          <input type="text" name="zip" value="{{ $orderDetails->pincode }}">
          <input type="text" name="country" value="{{ $orderDetails->country }}">
          <input type="text" name="mobile" value="{{ $orderDetails->mobile }}">
          <input type="text" name="email" value="{{ $orderDetails->user_email }}">
          <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
          <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>

        {{-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <!-- Saved buttons use the "secure click" command -->
                <input type="hidden" name="cmd" value="_s-xclick">

                <!-- Saved buttons are identified by their button IDs -->
                <input type="text" name="hosted_button_id" value="221">
                <input type="text" name="business" value="sb-kyhup6087226@business.example.com">
                        <input type="text" name="item_name" value="{{Session::get('order_id')}}">
                        <input type="text" name="item_number" value="{{Session::get('order_id')}}">
                        <input type="text" name="amount" value="{{ round($orderDetails->grand_total,2) }}">
                        <input type="text" name="first_name" value="{{ $nameArr[0] }}">
                        <input type="text" name="last_name" value="{{ $nameArr[1] }}">
                        <input type="text" name="address1" value="{{ $orderDetails->address }}">
                        <input type="text" name="city" value="{{ $orderDetails->city }}">
                        <input type="text" name="state" value="{{ $orderDetails->state }}">
                        <input type="text" name="zip" value="{{ $orderDetails->pincode }}">
                        <input type="text" name="country" value="{{ $orderDetails->country }}">
                        <input type="text" name="mobile" value="{{ $orderDetails->mobile }}">
                        <input type="text" name="email" value="{{ $orderDetails->user_email }}">
                <!-- Saved buttons display an appropriate button image. -->
                <input type="image" name="submit"
                    src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
                    alt="PayPal - The safer, easier way to pay online">
                <img alt="" width="1" height="1"
                    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

            </form> --}}
			</div>
		</div>
	</section>
@endsection
{{ Session::forget('order_id') }}
{{ Session::forget('grand_total') }}
