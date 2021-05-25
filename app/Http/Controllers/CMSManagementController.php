<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CMSManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CMSManagementController extends Controller
{
    public function viewCMSPage()
    {
        $cms = CMSManagement::all();
        return view('CSM.cms_list', compact('cms'));
    }

    public function addCMSPage()
    {
        return view('CSM.add_cms');
    }

    public function StoreCMSPage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
        ]);
        $cms = new CMSManagement();
        $cms->title = $request->title;
        $cms->description = $request->description;
        $cms->url = $request->url;
        if (empty($request->status)) {
            $cms->status = 0;
        } else {
            $cms->status = 1;
        }

        $cms->save();
        // echo '<pre>';
        // print_r(json_decode(json_encode($cms)));
        // die();
        return redirect('/admin/list-cms-page')->with('success', 'CMS Page added successfully!!');
    }

    public function editCMSPage($id)
    {
        $cms = CMSManagement::find($id);
        return view('CSM.edit_cms', compact('cms'));
    }

    public function updateCMSPage(Request $request)
    {
        $cms = CMSManagement::where('id', $request->id)->first();
        $cms->title = $request->title;
        $cms->description = $request->description;
        $cms->url = $request->url;
        if (empty($request->status)) {
            $cms->status = 0;
        } else {
            $cms->status = 1;
        }

        $cms->save();
        return redirect('/admin/list-cms-page')->with('success', 'CMS Page Updated successfully!!');
        // echo '<pre>';
        // print_r(json_decode(json_encode($cms)));
        // die();
    }

    public function deleteCMSPage($id)
    {
        CMSManagement::find($id)->delete();
        return redirect('/admin/list-cms-page')->with('success', 'CMS Page deleted successfully!!');
    }

    public function CMSPages($url)
    {
        $cmsPage = CMSManagement::where('url', $url)->first();
        $data = Category::with('categories')->where(['parent_category_id' => 0])->get();
        return view('pages.cms_page', compact('cmsPage', 'data'));
    }
}