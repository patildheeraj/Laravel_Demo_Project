<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function show()
    {
        $coupon = Coupon::all();
        return view('coupon.coupon-list', compact('coupon'));
    }

    public function addCoupon()
    {
        return view('coupon.add-coupon');
    }

    public function storeCoupon(Request $request)
    {
        $request->validate(
            [
                'coupon_code' => 'required|unique:coupons,coupon_code|alpha_num',
                'coupon_type' => 'required',
                'coupon_value' => 'required|integer',
                'minimum_purchase' => 'required|integer',
                'date' => 'required',
                'status' => 'required',
            ],
        );

        $coupon_code = $request->coupon_code;
        $coupon_type = $request->coupon_type;
        $coupon_value = $request->coupon_value;
        $minimum_purchase = $request->minimum_purchase;
        $Exp_date = $request->date;
        $status = $request->status;

        $model = new Coupon();
        $model->coupon_code = $coupon_code;
        $model->coupon_type = $coupon_type;
        $model->coupon_value = $coupon_value;
        $model->minimum_purchase = $minimum_purchase;
        $model->Exp_date = $Exp_date;
        $model->status = $status;
        $model->save();
        Toastr::success('Coupon Added Successfully');
        return redirect()->route('coupon.fetch');
    }

    public function editCoupon($id)
    {
        $data = Coupon::find($id);
        return view('coupon.edit-coupon', compact('data'));
    }

    public function updateCoupon(Request $request)
    {
        $coupon_code = $request->coupon_code;
        $coupon_type = $request->coupon_type;
        $coupon_value = $request->coupon_value;
        $minimum_purchase = $request->minimum_purchase;
        $Exp_date = $request->date;
        $status = $request->status;

        $model = Coupon::find($request->id);
        $model->coupon_code = $coupon_code;
        $model->coupon_type = $coupon_type;
        $model->coupon_value = $coupon_value;
        $model->minimum_purchase = $minimum_purchase;
        $model->Exp_date = $Exp_date;
        $model->status = $status;
        $model->save();
        Toastr::success('Coupon Updated Successfully');
        return redirect()->route('coupon.fetch');
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        Toastr::error('Coupon Deleted Successfully');
        return back();
    }

    public function status($status, $id)
    {
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        Toastr::success('Coupon status changed');
        return back();
    }
}