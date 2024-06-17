<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DelayReport extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'status', 'delay', 'new_delivery_time'];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
