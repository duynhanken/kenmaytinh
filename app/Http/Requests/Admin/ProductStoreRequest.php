<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'slug' => ['required'],
            'brand_id' => ['required'],
            'ram_id' => ['required'],
            'cpu_id' => ['required'],
            'hard_driver_id' => ['required'],
            'image' => ['required','image'],
            'desc' => ['required'],
            'out_price' => ['required'],
            'status' => ['required'],
        ];
    }
}
