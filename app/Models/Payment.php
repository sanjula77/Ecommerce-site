<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_id', 'card_number', 'cardholder_name', 'expiry_date', 'cvv', 'amount', 'payment_status'];

    /**
     * Encrypt card number when storing
     */
    protected function cardNumber(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value) return null;
                try {
                    return decrypt($value);
                } catch (\Exception $e) {
                    return $value; // Return as-is if decryption fails (for legacy data)
                }
            },
            set: fn ($value) => $value ? encrypt($value) : null,
        );
    }

    /**
     * Encrypt CVV when storing
     */
    protected function cvv(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value) return null;
                try {
                    return decrypt($value);
                } catch (\Exception $e) {
                    return $value; // Return as-is if decryption fails (for legacy data)
                }
            },
            set: fn ($value) => $value ? encrypt($value) : null,
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

