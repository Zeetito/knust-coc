<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'defaultImageable_id',
        'defaultImageable_type',
    ];

    public function defaultImageable(): MorphTo
    {
        return $this->morphTo();
    }
}
