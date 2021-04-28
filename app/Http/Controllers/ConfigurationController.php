<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function show()
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
    }

    public function editConfiguration($id)
    {
        $data = Configuration::find($id);
        return view('configuration.edit-configuration', compact('data'));
    }

    public function updateConfiguration(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email',
            'notification_email' => 'required|email',
        ]);
        $id = $request->id;
        $admin_email = $request->admin_email;
        $notification_email = $request->notification_email;

        $data = Configuration::find($id);
        $data->admin_email = $admin_email;
        $data->notification_email = $notification_email;
        $data->save();
        return back()->with('success', 'Updated Successfully!!!');
    }

    public function deleteConfiguration($id)
    {
        $data = Configuration::find($id);
        $data->delete();
        return back()->with('success', 'Deleted Successfully!!');
    }
}