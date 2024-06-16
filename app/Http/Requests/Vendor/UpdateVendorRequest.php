<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVendorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => ["required", "string","max:255", Rule::unique('vendors')->ignore($this->vendor, 'name')]
        ];
    }
}
