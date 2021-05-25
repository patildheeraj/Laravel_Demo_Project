@extends('front_end.layout')
@section('content')
  	<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Thank You</li>
          </ol>
        </div>
	</section>

	<section id="do_action">
		<div class="container">
			<div class="heading text-center">
				<h3>YOUR COD ORDER HAS BEEN PLACED SUCCESSFULLY!!</h3>
				<p>Your order number is {{Session::get('order_id')}} and total payble amount is  {{ Session::get('grand_total') }} Rs.</p>
			</div>
		</div>
	</section>
@endsection
{{ Session::forget('order_id') }}
{{ Session::forget('grand_total') }}

