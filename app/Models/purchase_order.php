<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class Purchase_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'purchase_order_number',
        'purchase_order_title',
        'purchase_statut',
        'purchase_order_number_packet',
        'divisor_value',
        'purchase_order_description',
        'accept_terme',
        'total_amount',
        'has_paid',
        'paid',
        'rest',
        'signature',
        'purchase_order_isDraft',
        'Delivery_address',
        'barcode_printed',
        'purchase_order_verified',
        'purchase_order_date',
        'customer_id',
        'receiver_id',
        'user_id',
        'num_incriment',

    ];

     public function user()
    {
        return $this->belongsTo(user::class);
    }
      public function receiver()
    {
        return $this->belongsTo('App\Models\Receiver', "receiver_id");
    }
     public function packets()
     {
         return $this->hasOne('App\Models\Purchase_order', "purchase_order_id");
     }
}
