<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
      protected $fillable = [
        'id',
        'payement_method',
        'payement_amount',
        'paid_after_invoicing',
        'purchase_order_id',
        'user_id',
        'checkout_id',

    ];
}
