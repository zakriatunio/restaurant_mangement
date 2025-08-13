<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlutterwavePayment extends Model
{
    use HasFactory;

    protected $table = 'flutterwave_payments';
    protected $fillable = [
        'flutterwave_payment_id',
        'order_id',
        'amount',
        'payment_status',
        'payment_date',
        'payment_error_response',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
