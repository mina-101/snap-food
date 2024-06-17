<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DelayReport extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'status'];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
