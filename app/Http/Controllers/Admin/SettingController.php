<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit(){
        $setting=Setting::first();
    

        return view('admin.setting.index',compact('setting'));
    }

    public function update(Request $request,Setting $setting)
    {
        $old_logo_image = $request->post('logo');
        $old_favicon_image = $request->post('favicon');
        $data = $request->except('logo');
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('uploads/setting', ['disk' => 'public']);
            $data['logo'] = $path;
        }
        if ($old_logo_image && isset($data['logo'])) {
            Storage::disk('public')->delete($old_logo_image);
        }
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $path = $file->store('uploads/setting', ['disk' => 'public']);
            $data['favicon'] = $path;
        }
        if ($old_favicon_image && isset($data['favicon'])) {
            Storage::disk('public')->delete($old_favicon_image);
        }

        $setting->update($data);
        return view('admin.setting.index')->with('success', __('operation updation accomplished successfully'));
    }
}
