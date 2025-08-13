<?php

namespace App\Models;

use App\Traits\HasBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    use HasBranch;

    protected $guarded = ['id'];

    protected $casts = [
        'reservation_date_time' => 'datetime',
        'payment_details' => 'array',
        'payment_date' => 'datetime',
        'refund_date' => 'datetime',
        'advance_payment_amount' => 'decimal:2',
        'refund_amount' => 'decimal:2'
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Payment helper methods
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->payment_status === 'pending';
    }

    public function hasFailed(): bool
    {
        return $this->payment_status === 'failed';
    }

    public function isRefunded(): bool
    {
        return $this->payment_status === 'refunded';
    }

    public function requiresPayment(): bool
    {
        return !is_null($this->advance_payment_amount) && $this->advance_payment_amount > 0;
    }

    public function getPaymentStatusBadgeClass(): string
    {
        return match($this->payment_status) {
            'paid' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'failed' => 'bg-red-100 text-red-800',
            'refunded' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

}
