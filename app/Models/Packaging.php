<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    use HasFactory;

     protected $fillable = [
        'id',
        'packaging_name',
        'packagings_length',
        'packaging_width',
        'packagings_height'
    ];
}
