<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency_packet extends Model
{
    use HasFactory;

 protected $guarded = [];
    protected $agency_packets = [
        'id',
        'date',
        'packet_id',
        'agency_id',
    ];
}
