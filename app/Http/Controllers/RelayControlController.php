<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelaySetting;

class RelayControlController extends Controller
{
public function check(Request $request)
{
    $relaySetting = RelaySetting::first();

    if (!$relaySetting) {
        return response()->json(['error' => 'Pengaturan relay belum tersedia.'], 404);
    }

    $mode = $relaySetting->mode;
    $status_pump = $relaySetting->status_relay;
    $status_fan = $relaySetting->status_relay_fan;

    if ($mode === 'otomatis') {
        // Validasi HARUS dilakukan sebelum mengakses input
        $validated = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
        ]);

        // Ambil nilai setelah validasi
        $temperature = $validated['temperature'];
        $humidity = $validated['humidity'];

        // Logika otomatisasi
        // Logika otomatisasi (sesuai dengan deskripsi awal)
        $status_pump = ($temperature > 30);
        $status_fan = ($humidity < 60);

    }

    return response()->json([
        'mode' => $mode,
        'relay_pump' => $status_pump,
        'relay_fan' => $status_fan,
    ]);
}
}
