<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelaySetting;

class RelaySettingController extends Controller
{
    // GET /relay-setting
    public function show()
    {
        $setting = RelaySetting::first();

        if (!$setting) {
            return response()->json(['message' => 'Setting belum dibuat.'], 404);
        }

        return response()->json($setting);
    }

    // PUT /relay-setting
    public function update(Request $request)
    {
        $request->validate([
            'mode' => 'in:otomatis,manual',
            'status_relay' => 'boolean',
            'status_relay_fan' => 'boolean', // Tambahan
        ]);

        $setting = RelaySetting::first();

        if (!$setting) {
            $setting = new RelaySetting();
        }

        if ($request->has('mode')) {
            $setting->mode = $request->mode;
        }

        if ($request->has('status_relay')) {
            $setting->status_relay = $request->status_relay;
        }

        if ($request->has('status_relay_fan')) {
            $setting->status_relay_fan = $request->status_relay_fan;
        }

        $setting->save();

        return response()->json([
            'message' => 'Pengaturan berhasil diperbarui.',
            'data' => $setting
        ]);

    }

public function viewControl()
{
    $setting = RelaySetting::first();

    if (!$setting) {
        return response()->json([
            'success' => false,
            'message' => 'Relay setting not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $setting
    ]);
}


// POST /relay-control/update-mode
    public function updateMode(Request $request)
    {
        $request->validate([
            'mode' => 'required|in:otomatis,manual'
        ]);

        $setting = RelaySetting::first();
        if (!$setting) {
            return response()->json(['message' => 'Pengaturan belum tersedia.'], 404);
        }

        $setting->mode = $request->mode;
        $setting->save();

        return response()->json([
            'message' => 'Mode berhasil diperbarui.',
            'data' => $setting
        ]);
    }

    // POST /relay-control/update-status
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status_relay' => 'required|boolean'
        ]);

        $setting = RelaySetting::first();
        if (!$setting) {
            return response()->json(['message' => 'Pengaturan belum tersedia.'], 404);
        }

        $setting->status_relay = $request->status_relay;
        $setting->save();

        return response()->json([
            'message' => 'Status relay berhasil diperbarui.',
            'data' => $setting
        ]);
    }

    // POST /relay-control/update-fan-status
    public function updateStatusFan(Request $request)
    {
        $request->validate([
            'status_relay_fan' => 'required|boolean'
        ]);

        $setting = RelaySetting::first();
        if (!$setting) {
            return response()->json(['message' => 'Pengaturan belum tersedia.'], 404);
        }

        $setting->status_relay_fan = $request->status_relay_fan;
        $setting->save();

        return response()->json([
            'message' => 'Status kipas berhasil diperbarui.',
            'data' => $setting
        ]);
    }

}
