<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigurationController extends Controller
{
    /*public function show()
    {
        $data = Configuration::all();
        return view('configuration.configuration-list', compact('data'));
    }

    public function addConfiguration()
    {
        return view('configuration.add-configuration');
    }

    public function storeConfiguration(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email',
            'notification_email' => 'required|email',
        ]);

        $admin_email = $request->admin_email;
        $notification_email = $request->notification_email;

        $data = new Configuration();

        $data->admin_email = $admin_email;
        $data->notification_email = $notification_email;
        $data->save();
        return back()->with('success', 'Added Successfully!!!');
    }*/

    public function editConfiguration()
    {
        $data = Configuration::select('parameter_value')->pluck('parameter_value');
        //$data = DB::table('configurations')->select('parameter_value')->get();
        // print_r($data);
        // print_r($data[0]);
        // print_r($data[1]);
        // die();
        return view('configuration.edit-configuration', compact('data'));
    }

    public function updateConfiguration(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email',
            'notification_email' => 'required|email',
        ]);
        $id1 = 1;
        $id2 = 2;
        $admin_email = $request->admin_email;
        $notification_email = $request->notification_email;

        $data1 = Configuration::find($id1);
        $data1->parameter_value = $admin_email;
        $data1->save();

        $data2 = Configuration::find($id2);
        $data2->parameter_value = $notification_email;
        $data2->save();
        return back()->with('success', 'Updated Successfully!!!');
    }

    // public function deleteConfiguration($id)
    // {
    //     $data = Configuration::find($id);
    //     $data->delete();
    //     return back()->with('success', 'Deleted Successfully!!');
    // }
}