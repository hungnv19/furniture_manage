<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'      => 'required',
            'product_name'     => 'required|max:80',
            'product_code'     => 'required|max:80',
            'root'             => 'required|max:80',
            'buying_price'     => 'required|numeric',
            'selling_price'    => 'required|numeric',
            'buying_date'      => 'required',
            'product_quantity' => 'required|numeric|min:1',
        ];
    }
}
