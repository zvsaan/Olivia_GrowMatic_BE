<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorDataController extends Controller
{
    // GET /sensor-data
    public function index()
    {
        $data = SensorData::latest()->get();
        return response()->json($data);
    }

    // GET /sensor-data/latest
    public function latest()
    {
        $latest = SensorData::latest()->first();

        if (!$latest) {
            return response()->json(['message' => 'Belum ada data sensor.'], 404);
        }

        return response()->json($latest);
    }

    // POST /sensor-data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'mode' => 'required|in:otomatis,manual',
            'status_relay' => 'required|boolean',       // Pompa
            'status_relay_fan' => 'required|boolean',   // Kipas
        ]);


        $data = SensorData::create($validated);

        return response()->json([
            'message' => 'Data sensor berhasil disimpan.',
            'data' => $data
        ], 201);
    }
}
