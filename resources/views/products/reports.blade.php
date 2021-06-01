@extends('layouts.master')
@section('report', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
                </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-info">
                        <div class="card-header">
                            Reports
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Sales Report</th>
                                    <td><a href="{{ url('/admin/reports/productExport') }}" class="btn btn-block btn-success">Export the Sales Report</a></td>
                                </tr>
                                <tr>
                                    <th>Customer Registered</th>
                                    <td><a href="{{ url('/admin/reports/customerExport') }}" class="btn btn-block btn-success">Export the Customer Registered</a></td>
                                </tr>
                                <tr>
                                    <th>Coupons </th>
                                    <td><a href="{{ url('/admin/reports/couponExport') }}" class="btn btn-block btn-success">Export the Coupons Report</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
