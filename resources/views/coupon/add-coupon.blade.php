@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Coupon Management</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Coupon</h3>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close text-success" data-dismiss="alert">×</button>
                            </div>
                        @endif
                        <form action="{{ route('coupon.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="coupon_code">Coupon Code</label>
                                    <input type="text" name="coupon_code" class="form-control @error('coupon_code') is-invalid @enderror" id="firstname" value="{{ old('coupon_code') }}" placeholder="Enter Coupon Code">
                                    @error('coupon_code')
                                        <div class="invalid-feeedback text-danger font-weight-light">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="coupon_type">Coupon Type</label>
                                            <select name='coupon_type' class="custom-select rounded-0 @error('coupon_type') is-invalid @enderror" >
                                                <option value="">Select Coupon Type</option>
                                                <option value="Fixed">Fixed Value</option> 
                                                <option value="Percentage">Percentage</option>                     
                                            </select>
                                            @error('coupon_type')
                                                <div class="invalid-feeedback text-danger font-weight-light">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="coupon_value">Coupon Value</label>
                                            <input type="text" name="coupon_value" class="form-control @error('coupon_value') is-invalid @enderror" id="coupon_value" value="{{ old('coupon_value') }}" placeholder="Enter Coupon Value">
                                            @error('coupon_value')
                                                <div class="invalid-feeedback text-danger font-weight-light">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="minimum_purchase">Minimum Purchase Amount</label>
                                            <input type="text" name="minimum_purchase" class="form-control @error('minimum_purchase') is-invalid @enderror" id="minimum_purchase" value="{{ old('minimum_purchase') }}" placeholder="Enter Minimum Purchase Value">
                                            @error('minimum_purchase')
                                                <div class="invalid-feeedback text-danger font-weight-light">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="date">Expiry Date</label>
                                            <input type="text" id="datepicker" name="date" class="form-control @error('date') is-invalid @enderror" id="minimum_purchase" value="{{ old('date') }}" placeholder="Choose Date" autocomplete="off">
                                            @error('date')
                                                <div class="invalid-feeedback text-danger font-weight-light">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <label for="status">Status</label>
                                <br>
                                <div class="form-group form-check-inline">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input @error('status') is-invalid @enderror" id="Radio1" name="status" value="1" {{ old('status')=='1' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Radio1">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input @error('status') is-invalid @enderror" id="Radio2" name="status" value="0" {{ old('status')=='0' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Radio2">Inactive</label>
                                    </div>
                                    @error('status')
                                        <div class="invalid-feeedback text-danger font-weight-light">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Add Coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection