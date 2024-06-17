<?php

namespace App\Http\Requests\Order\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id',
            'vendor_id' => 'required|exists:vendors,id',
        ];
    }
}
