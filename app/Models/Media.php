<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model {

    use HasFactory;

    protected $fillable = [
        'order_product_id',
        'path',
    ];

    /**
     * Get the order_products that owns the Media
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_products(): BelongsTo {
        return $this->belongsTo( OrderProduct::class );
    }
}
