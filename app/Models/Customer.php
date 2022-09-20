<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
class Customer extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;
    protected $table='customers';

      protected $fillable = [
        'id',
        'customer_name',
        'customer_surname',
        'customer_cni',
        'customer_mail',
        'customer_phone',
        'customer_adress',
        'customer_other_adress',
        'customer_city',
        'customer_country',
        'customer_login',
        'password',
        'customer_profil',
        'reduction_value',
        'customer_picture',
        'category_id',
        'permission_id',
        'Customer_contry_code',
        'password',
        'date_inscription',
        'customer_barCode',
        'reduction_value',
        'reduction_voiture',
        'augmentation'
    ];


    protected $guarded = [];

    public function getCountry() {
        return [
            'Algérie',
            'Allemagne',
            'Argentine',
            'Australie',
            'Belgique',
            'Bénin',
            'Brésil',
            'Canada',
            'Chine',
            'Espagne',
            'États-Unis',
            'France',
            'Italie',
            'Mexique',
            'Russie'
        ];
    }
    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie', "category_id");
    }
}
