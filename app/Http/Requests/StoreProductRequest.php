<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'sub_category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Vui long nhap ten',
            'sub_category_id.required' => 'Vui long chon danh muc',
            'description.required' => 'Vui long nhap mo ta',
            'price.required' => 'Vui long nhap gia',
            'quantity.required' => 'Vui long nhap so luong',
        ];
    }
}
