<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelaySetting extends Model
{
    protected $table = 'relay_settings';

    protected $fillable = [
        'mode',
        'status_relay',
        'status_relay_fan',
    ];
}
