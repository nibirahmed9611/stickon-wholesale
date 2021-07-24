<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model {

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];

    use HasFactory;
}
