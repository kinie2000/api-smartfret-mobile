<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Activity extends Model
{
    use HasFactory;

    protected $table = 'activitys';
        protected $fillable = [
        'id',
        'activity_description',
        'activity_identified',
        'activity_route',
        'user_id',
    ];
}
