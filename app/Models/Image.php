<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type',
    ];
    /**
     * Get the parent imageable model (user or residence or zones...).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
