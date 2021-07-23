<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model {

    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];

    /**
     * Get all of the attribute for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes(): HasMany {
        return $this->hasMany( Attribute::class );
    }

    /**
     * Get all of the order for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order(): HasMany {
        return $this->hasMany( Order::class );
    }
}
