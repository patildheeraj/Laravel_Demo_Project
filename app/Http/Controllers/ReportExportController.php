<?php

namespace App\Http\Controllers;

use App\Exports\CouponExport;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportExportController extends Controller
{
    public function report()
    {
        return view('products.reports');
    }

    public function productExport()
    {
        return Excel::download(new OrderExport, 'productSales.xlsx');
    }

    public function customerExport()
    {
        return Excel::download(new CustomerExport, 'Registered_user.xlsx');
    }

    public function couponExport()
    {
        return Excel::download(new CouponExport, 'Coupon.xlsx');
    }
}