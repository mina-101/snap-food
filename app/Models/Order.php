<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vendor_id', 'description', 'delivery_time'];

    const PAGE_LIMIT = 10;

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
