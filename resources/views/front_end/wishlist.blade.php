@extends('front_end.layout')
@section('content')
  	<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">wishlist</li>
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
                        @if ($list != '')
                            @foreach ($list as $item)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="{{asset('product_images')}}/{{$item->product_image}}" alt="" width="150px" height="120px"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $item->product_name }}</a></h4>
                                    <p>Product-Id: {{ $item->product_code }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>Rs. {{ $item->product_price }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item->quantity }}" readonly autocomplete="off" size="2">
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{ $item->product_price * $item->quantity }} Rs.</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="/delete-wishlist-item/{{ $item->product_id }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
						@endforeach
                        @else
                        <tr>
                            <td><h3>Wishlist is empty</h3></td>
                        </tr>

                        @endif
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

@endsection
