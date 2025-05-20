<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
        protected $table = 'sensor_data';

    protected $fillable = [
        'temperature',
        'humidity',
        'mode',
        'status_relay',
        'status_relay_fan',
    ];
}
