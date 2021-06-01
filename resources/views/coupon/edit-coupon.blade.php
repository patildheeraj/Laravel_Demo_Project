@extends('layouts.master')
@section('coupon_menu','menu-open')
@section('coupon', 'active')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Coupon Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Coupon Management</a></li>
                    <li class="breadcrumb-item active">Edit Coupon</li>
                </ol>
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
                            <h3 class="card-title">Update Coupon</h3>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close text-success" data-dismiss="alert">×</button>
                            </div>
                        @endif
                        <form action="{{ route('coupon.update') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="coupon_code">Coupon Code</label>
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="text" name="coupon_code" class="form-control @error('coupon_code') is-invalid @enderror" id="coupon_code" value="{{ $data->coupon_code }}">
                                    @error('coupon_code')
                                        <div class="invalid-feeedback text-danger font-weight-light">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="coupon_type">Coupon Type</label>
                                    <select name='coupon_type' class="custom-select rounded-0 @error('coupon_type') is-invalid @enderror" value="{{ $data->coupon_type }}">
                                        <option value="">Select Coupon Type</option>
                                        <option value="Fixed" {{ $data->coupon_type == 'Fixed'? 'selected':'' }}>Fixed Value</option>
                                        <option value="Percentage" {{ $data->coupon_type == 'Percentage'? 'selected':'' }}>Percentage</option>
                                    </select>
                                    @error('coupon_type')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="coupon_value">Coupon Value</label>
                                    <input type="text" name="coupon_value" class="form-control @error('coupon_value') is-invalid @enderror" id="coupon_value" value="{{ $data->coupon_value }}">
                                    @error('coupon_value')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="minimum_purchase">Minimum Purchase Amount</label>
                                    <input type="text" name="minimum_purchase" class="form-control @error('minimum_purchase') is-invalid @enderror" id="minimum_purchase" value="{{ $data->minimum_purchase }}">
                                    @error('minimum_purchase')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                            <label for="date">Expiry Date</label>
                                            <input type="text" id="datepicker" name="date" value="{{ $data->Exp_date }}" class="form-control @error('date') is-invalid @enderror" id="minimum_purchase" value="{{ old('date') }}" placeholder="Choose Date">
                                            @error('date')
                                                <div class="invalid-feeedback text-danger font-weight-light">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                <label for="status">Status</label>
                                <br>
                                <div class="form-group form-check-inline">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input @error('status') is-invalid @enderror" id="Radio1" name="status" value="1" {{ $data->status=='1' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Radio1">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input @error('status') is-invalid @enderror" id="Radio2" name="status" value="0" {{ $data->status=='0' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Radio2">Inactive</label>
                                    </div>
                                    @error('status')
                                    <div class="invalid-feeedback text-danger font-weight-light">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Update Coupon</button>
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
