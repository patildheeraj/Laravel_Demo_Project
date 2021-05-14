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
			<div class="row">
                <div class="col-sm-4 col-sm-offset-1">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
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
						<form action="{{ route('frontuser.store') }}" method="POST">
							@csrf
							<input type="text" name="name" placeholder="Enter Name" value="{{ old('name') }}"/>
							{{-- <input type="text" name="lname" placeholder="Last Name" value="{{ old('lname') }}"/> --}}
							<input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"/>
							<input type="password" name="password" placeholder="Password" value="{{ old('password') }}"/>
							<input type="password" name="conpassword" placeholder="Confirm Password"/>
							<button type="submit" class="btn btn-default" id="btn1">Signup</button>
							I already have a account,<a href="{{ url('/login') }}" class="mt-3"><Strong> Sign in!</Strong></a>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection