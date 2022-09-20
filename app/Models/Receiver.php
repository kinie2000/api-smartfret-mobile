<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase_order;

class Receiver extends Model
{
    use HasFactory;

      protected $fillable = [
        'id',
        'receiver_name',
        'receiver_email',
        'receiver_cni',
        'receiver_phone1',
        'receiver_phone2',
        'receiver_city',
        'receiver_adress',
        'date_create',
        'customer_id'
    ];

     public function purchase_order()
    {
        return $this->hasOne('App\Models\Receiver', "receiver_id ");
    }
}
