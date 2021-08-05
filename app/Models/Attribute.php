<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model {
    use HasFactory;

    protected $fillable = [
        'product_id',
        'value',
        'quantity',
    ];

    /**
     * Get the product that owns the Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo {
        return $this->belongsTo( Product::class );
    }

}
