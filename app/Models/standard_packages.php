<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class standard_packages extends Model
{
    use HasFactory;
    protected $fillable=['id','type_standard','name_standard','price_standard','length','width','height','type_cars','days','destination','capacity'];
}
