<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    const PAGE_LIMIT = 10;

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
