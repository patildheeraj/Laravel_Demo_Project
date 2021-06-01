<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function show()
    {
        $data = Banner::all();
        return view('banner.banner-list', compact('data'));
    }

    public function addBanner()
    {
        return view('banner.add-banner');
    }

    public function storeBanner(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'required',
            'file' => 'required',
        ], [
            'title.required' => '**Banner title is Required',
            'sub_title.required' => '**Banner Subtitle is Required',
            'link.required' => '**Link Required',
            'file.required' => '**Image is Required'
        ]);

        $title = $request->title;
        $sub_title = $request->sub_title;
        $link = $request->link;

        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('banner_images'), $imageName);

        if ($imageName == null) {
            $imageName = '';
        }

        $model = new Banner();
        $model->title = $title;
        $model->sub_title = $sub_title;
        $model->link = $link;
        $model->bimage = $imageName;
        $model->save();

        return back()->with('product_added', 'Banner Added Successfully!!!');
    }

    public function editBanner($id)
    {
        $data = Banner::find($id);
        return view('banner.edit-banner', compact('data'));
    }

    public function updateBanner(Request $request)
    {
        $title = $request->title;
        $sub_title = $request->sub_title;
        $link = $request->link;

        $image = $request->file('file');
        if ($image != null) {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('banner_images'), $imageName);
        } else {
            $model = Banner::find($request->bid);
            $imageName = $model->bimage;
        }


        $model = Banner::find($request->bid);
        $model->title = $title;
        $model->sub_title = $sub_title;
        $model->link = $link;
        $model->bimage = $imageName;
        $model->save();
        return redirect()->route('Banner.fetch');
        return back()->with('product_update', 'Banner Updated Successfully!!');
    }

    public function deleteBanner($id)
    {
        $data = Banner::find($id);
        unlink(public_path('banner_images') . '/' . $data->bimage);
        $data->delete();
        return back()->with('product_deleted', 'Banner Deleted Successfully!!');
    }
}