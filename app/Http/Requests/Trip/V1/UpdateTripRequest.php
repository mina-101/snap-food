<?php

namespace App\Http\Requests\Trip\V1;

use App\Enums\TripStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "status" => ["required", Rule::enum(TripStatus::class)]
        ];
    }
}
