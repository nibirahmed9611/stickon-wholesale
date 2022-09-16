<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model {

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
        'status',
    ];

    use HasFactory;

    /**
     * Get the user that owns the Refund
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo( User::class );
    }
}
