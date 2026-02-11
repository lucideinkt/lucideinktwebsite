<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        // Billing fields
        'billing_first_name',
        'billing_last_name',
        'billing_email',
        'billing_company',
        'billing_street',
        'billing_house_number',
        'billing_house_number-add',
        'billing_postal_code',
        'billing_city',
        'billing_country',
        'billing_phone',

    ];

    /**
     * Get the billing house number addition attribute.
     * This is an accessor for backward compatibility since the database column uses hyphens.
     */
    public function getBillingHouseNumberAdditionAttribute()
    {
        return $this->attributes['billing_house_number-add'] ?? null;
    }

    /**
     * Set the billing house number addition attribute.
     * This is a mutator for backward compatibility since the database column uses hyphens.
     */
    public function setBillingHouseNumberAdditionAttribute($value)
    {
        $this->attributes['billing_house_number-add'] = $value;
    }

    /**
     * Get the orders for the customer.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
