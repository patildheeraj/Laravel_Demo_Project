<style>
    #form1{
        margin-bottom: 20px;
    }
	#btn1{
		margin-left: 0px; 
	}
</style>
@extends('front_end.layout')
@section('content')
    <section id="form1"><!--form-->
		<div class="container">
            <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check Out</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="row">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p><strong>Opps Something went wrong</strong></p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                <form action="{{ route('save.address') }}" method="POST">
				@csrf
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="signup-form"><!--sign up form-->
                            <h2>Billing Address</h2>
                            <div class="form-group">
                                <input type="text" id="billing_name" name="billing_name" class="form-control" value="{{ $user->name }}" placeholder="Billing Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_address" class="form-control" value="{{ $user->address }}" placeholder="Billing Address">
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_city" class="form-control" value="{{ $user->city }}" placeholder="Billing City">
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_state" class="form-control" value="{{ $user->state }}" placeholder="Billing State">
                            </div>
                            <div class="form-group">
                                <select name="billing_country" id="billing_country" class="form-control">
                                <option value="0">Select Country</option>
                                @foreach ($country as $info)
                                    <option value="{{ $info->country_name }}" {{ $user->country == $info->country_name ? 'selected' : ''}}>{{ $info->country_name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_pincode" class="form-control" value="{{ $user->pincode }}" placeholder="Billing Pincode">
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_mobile" class="form-control" value="{{ $user->mobile }}" placeholder="Billing Mobile">
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_email" class="form-control" value="{{ $user->email }}" placeholder="Billing Email">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="copyAddress" id="copyAddress" onclick="clickfunction()">
                                <label class="form-check-label" for="copyAddress">Shipping Address same as Billing Adreess</label>
                            </div>
                        </div><!--/sign up form-->
                    </div>
                    <div class="col-sm-1">
                        {{-- <h2 class="or">OR</h2> --}}
                    </div>
                    <div class="col-sm-4">
                        @if (Session::get('pwd'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('pwd') }}
                            </div>
                        @endif
                        <div class="signup-form"><!--sign up form-->
                            <h2>Sipping Address</h2>
                                <div class="form-group">
                                <input type="text" id="shipping_name" name="shipping_name" class="form-control" @if (!empty($shippingDetail)) value="{{ $shippingDetail->name }}" @endif placeholder="Sipping Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="shipping_address" class="form-control" @if (!empty($shippingDetail)) value="{{ $shippingDetail->address }}" @endif placeholder="Sipping Address">
                            </div>
                            <div class="form-group">
                                <input type="text" name="shipping_city" class="form-control" @if (!empty($shippingDetail)) value="{{ $shippingDetail->city }}" @endif placeholder="Sipping city">
                            </div>
                            <div class="form-group">
                                <input type="text" name="shipping_state" class="form-control" @if (!empty($shippingDetail)) value="{{ $shippingDetail->state }}" @endif placeholder="Sipping State">
                            </div>
                            <div class="form-group">
                                <select name="shipping_country" id="shipping_country" class="form-control">
                                <option value="0">Select Country</option>
                                @foreach ($country as $info)
                                    <option value="{{ $info->country_name }}" @if (!empty($shippingDetail)) {{ $shippingDetail->country == $info->country_name ? 'selected' : ''}}@endif>{{ $info->country_name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="shipping_pincode" class="form-control" @if (!empty($shippingDetail)) value="{{ $shippingDetail->pincode }}" @endif placeholder="Sipping Pincode">
                            </div>
                            <div class="form-group">
                                <input type="text" name="shipping_mobile" class="form-control" @if (!empty($shippingDetail)) value="{{ $shippingDetail->mobile }}" @endif placeholder="Sipping Mobile">
                            </div>
                            <div class="form-group">
                                <input type="text" name="shipping_email" class="form-control" @if (!empty($shippingDetail)) value="{{ $shippingDetail->user_email }}" @endif placeholder="Shipping Email">
                            </div>
                            <div class="form-group">
                            <button type="submit" id="btn1" class="btn btn-default form-control check_out">Countinue</button>
                            </div>
                        </div><!--/sign up form-->
                    </div>
                </form>
			</div>
		</div>
	</section><!--/form-->
@endsection