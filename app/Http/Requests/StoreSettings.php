<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettings extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'redirect_to' => 'nullable|string',
            'throttle_redirect_to' => 'nullable|string',
            'allowed_site' => 'nullable|string',
        ];
    }
}
