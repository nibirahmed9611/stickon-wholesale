<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model {

    use HasFactory;

    protected $fillable = [
        'user_id',
        'subtotal',
        'discount',
        'total',
        'paid',
        'due',
        'status',
    ];

    /**
     * Get all of the order_products for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_products(): HasMany {
        return $this->hasMany( OrderProduct::class );
    }

    /**
     * Get the account associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account(): HasOne {
        return $this->hasOne( Account::class );
    }

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo( User::class );
    }

}
