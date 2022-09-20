<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $categories = [
        'id',
        'category_name',
        'category_description'
    ];
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', "category_id");
    }
}
