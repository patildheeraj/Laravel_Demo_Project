<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
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
                'status' => 'required',
            ],
            // [
            //     'pname.required' => '**Product Name is Required',
            //     'pname.unique' => '**Product name already exist',
            //     'pprice.required' => '**Product Price is Required',
            //     'pprice.integer' => '**Price must be number',
            //     'pcategory.required' => '**Select any one Category',
            //     'file.required' => '**Image is Required'
            // ]
        );

        $coupon_code = $request->coupon_code;
        $coupon_type = $request->coupon_type;
        $coupon_value = $request->coupon_value;
        $minimum_purchase = $request->minimum_purchase;
        $status = $request->status;

        $model = new Coupon();
        $model->coupon_code = $coupon_code;
        $model->coupon_type = $coupon_type;
        $model->coupon_value = $coupon_value;
        $model->minimum_purchase = $minimum_purchase;
        $model->status = $status;
        $model->save();

        return back()->with('product_added', 'Coupon Added Successfully!!!');
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
        $status = $request->status;

        $model = Coupon::find($request->id);
        $model->coupon_code = $coupon_code;
        $model->coupon_type = $coupon_type;
        $model->coupon_value = $coupon_value;
        $model->minimum_purchase = $minimum_purchase;
        $model->status = $status;
        $model->save();
        return redirect()->route('coupon.fetch');
        return back()->with('product_update', 'Coupon Updated Successfully!!');
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return back()->with('product_deleted', 'Coupon Deleted Successfully!!');
    }

    public function status(Request $request, $status, $id)
    {
        // echo $status . $id;
        // die();
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        // $request->session()->flash('message', 'Coupon Status Updated');
        // return redirect('admin/coupon');
        return back()->with('product_deleted', 'Coupon status updated successfully!!');
    }
}