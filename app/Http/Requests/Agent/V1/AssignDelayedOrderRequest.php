<?php

namespace App\Http\Requests\Agent\V1;

use Illuminate\Foundation\Http\FormRequest;

class AssignDelayedOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'agent_id' => 'required|exists:agents,id',
        ];
    }
}
