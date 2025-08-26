<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
{
    $setting = Setting::first();

    // kalau null, buat default
    if (!$setting) {
        $setting = Setting::create([
            'app_name' => 'Stockify',
            'logo' => null,
        ]);
    }

    return view('settings.edit', compact('setting'));
}

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $setting = Setting::first() ?? new Setting();
        $setting->app_name = $request->app_name;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $setting->logo = $logoPath;
        }

        $setting->save();

        return redirect()->route('settings.edit')->with('success', 'Pengaturan berhasil diperbarui');
    }
}
