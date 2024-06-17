<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name'];

    const PAGE_LIMIT = 10;


    public function delays(): BelongsToMany
    {
        return $this->belongsToMany(Delay::class);
    }
}
