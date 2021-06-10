<style>
    #form1{
        margin-bottom: 20px;
    }
	#btn1{
		margin-bottom: 10px;
	}
</style>
@extends('front_end.layout')
@section('content')
    <section id="form1"><!--form-->
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Account</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="row">
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
                <div class="col-sm-4 col-sm-offset-1">
					<div class="signup-form"><!--sign up form-->
						<h2>Update User Account</h2>
						@if($errors->any())
							<div class="alert alert-danger">
								<p><strong>Opps Something went wrong</strong></p>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<form action="{{ route('update.account') }}" method="POST">
							@csrf
							<input type="text" name="name" placeholder="Enter Name" value="{{ $user->name }}"/>
                            <input type="text" name="mobile" placeholder="Enter Mobile number" value="{{ $user->mobile }}">
                            <input type="text" name="address" placeholder="Enter Address" value="{{ $user->address }}">
                            <input type="text" name="city" placeholder="Enter City" value="{{ $user->city }}">
                            <input type="text" name="state" placeholder="Enter State" value="{{ $user->state }}">
                            <select name="country" id="country" style="margin-bottom: 10px;">
                                <option value="0">Select Country</option>
                                @foreach ($country as $info)
                                    <option value="{{ $info->country_name }}" {{ $user->country == $info->country_name ? 'selected' : ''}}>{{ $info->country_name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="pincode" placeholder="Enter pincode" value="{{ $user->pincode }}">
							<button type="submit" class="btn btn-default" id="btn1">Submit info</button>
							Create a new account? <a href="{{ url('/register') }}" class="mt-3"><Strong>Register now!</Strong></a>
						</form>
					</div><!--/sign up form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					@if (Session::get('pwd'))
						<div class="alert alert-success alert-dismissible">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('pwd') }}
						</div>
					@endif
                    @if (Session::get('pwd_fail'))
						<div class="alert alert-danger alert-dismissible">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('pwd_fail') }}
						</div>
					@endif
					<div class="signup-form"><!--sign up form-->
						<h2>Update Password</h2>
						<form action="{{ route('update.password') }}" method="POST">
							@csrf
							<input type="password" name="current_password" placeholder="Current password"/>
							@error('current_password')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
							<input type="password" name="new_password" placeholder="New Password"/>
							@error('new_password')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
							<input type="password" name="conpassword" placeholder="Confirm Password"/>
							@error('conpassword')
                                    <span class="text-danger font-weight-light">{{$message}}</span>
                                @enderror
							<button type="submit" class="btn btn-default" id="btn1">Update</button>
							Don't remember password.<a href="{{ url('/forgot-password') }}" class="mt-3"><Strong>Forgot Password?</Strong></a>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection
