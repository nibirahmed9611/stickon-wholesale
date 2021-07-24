<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderProduct extends Model {

    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'attribute_id',
        'quantity',
        'status',
    ];

    /**
     * Get the attribute that owns the OrderProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute(): BelongsTo {
        return $this->belongsTo( Attribute::class );
    }

    /**
     * Get the order that owns the OrderProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo {
        return $this->belongsTo( Order::class );
    }

    /**
     * Get the product that owns the OrderProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo {
        return $this->belongsTo( Product::class );
    }

    /**
     * Get the image associated with the OrderProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image(): HasOne {
        return $this->hasOne( Media::class, 'order_product_id' );
    }

}
