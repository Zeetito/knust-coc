<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Share extends Model
{
    use HasFactory;

    protected $fillable = [
        'sharable_id',
        'sharable_type',
        'sendable_id',
        'sendable_type',
        'receivable_id',
        'receivable_type',
    ];

    public function sharable()
    {
        return $this->morphTo();
    }

    public function sendable()
    {
        return $this->morphTo();
    }
    public function receivable()
    {
        return $this->morphTo();
    }
}
