<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

       protected $fillable = [
        'id',
        'container_number',
        'container_description',
        'container_status',
        'container_picture',
        'container_loading_date',
        'container_unloading_date   ',
        'container_barcode'
    ];
}
