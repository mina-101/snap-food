<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vendor_id', 'description', 'delivery_time'];

    const PAGE_LIMIT = 10;

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function trip(): HasOne
    {
        return $this->hasOne(Trip::class);
    }

    public function delays()
    {
        return $this->hasMany(Delay::class);
    }

    public function delayReports()
    {
        return $this->hasMany(DelayReport::class);
    }
}
