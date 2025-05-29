<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SensorDataController extends Controller
{
    // GET /sensor-data
    public function index()
    {
        $data = SensorData::latest()->get();
        return response()->json($data);
    }

    public function chartData()
{
    // Ambil rata-rata harian dalam 1 bulan terakhir
    $data = SensorData::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('AVG(temperature) as avg_temperature'),
            DB::raw('AVG(humidity) as avg_humidity')
        )
        ->where('created_at', '>=', Carbon::now()->subMonth())
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

    return response()->json($data);
}


public function tableData(Request $request)
{
    $query = SensorData::query()->orderBy('created_at', 'desc');

    // Filter berdasarkan tanggal
    if ($request->has('from') && $request->has('to')) {
        $from = Carbon::parse($request->input('from'))->startOfDay();
        $to = Carbon::parse($request->input('to'))->endOfDay();
        $query->whereBetween('created_at', [$from, $to]);
    }

    // Tambahkan pagination
    $perPage = $request->input('per_page', 10);
    $data = $query->paginate($perPage);

    return response()->json([
        'current_page' => $data->currentPage(),
        'data' => $data->items(),
        'last_page' => $data->lastPage(),
        'per_page' => $data->perPage(),
        'total' => $data->total(),
    ]);
}

public function allTableData(Request $request)
{
    $query = SensorData::query()->orderBy('created_at', 'desc');

    if ($request->has('from') && $request->has('to')) {
        $from = Carbon::parse($request->input('from'))->startOfDay();
        $to = Carbon::parse($request->input('to'))->endOfDay();
        $query->whereBetween('created_at', [$from, $to]);
    }

    $data = $query->get();

    return response()->json($data);
}

// public function chartData()
// {
//     // Ambil rata-rata per minggu dalam 1 bulan terakhir
//     $data = SensorData::select(
//             DB::raw('YEAR(created_at) as year'),
//             DB::raw('MONTH(created_at) as month'),
//             DB::raw('WEEK(created_at, 1) as week_number'),
//             DB::raw('AVG(temperature) as avg_temperature'),
//             DB::raw('AVG(humidity) as avg_humidity')
//         )
//         ->where('created_at', '>=', Carbon::now()->subMonth()) // hanya ambil data 1 bulan ke belakang
//         ->groupBy('year', 'month', 'week_number')
//         ->orderBy('year')
//         ->orderBy('month')
//         ->orderBy('week_number')
//         ->get();

//     return response()->json($data);
// }

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
