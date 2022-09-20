<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'packet_title',
        'packet_length',
        'packet_width',
        'packet_heigth',
        'packet_price',
        'number',
        'packet_status',
        'packet_code_bar',
        'packet_show_title',
        'packet_load_date',
        'packet_picture',
        'packet_state',
        'packet_location',
        'packet_location_agency',
        'packet_unload_container_date',
        'packet_load_car_date',
        'packet_unload_car_date',
        'purchase_order_id',
        'car_id',
        'container_id',
    ];
    public function purchase_order()
    {
        return $this->belongsTo('App\Models\Purchase_order', "purchase_order_id");
    }

}
