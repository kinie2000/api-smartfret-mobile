<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeValidation extends Model
{
    protected $fillable=['idUser','idCustomer','code','status'];
    use HasFactory;
}
