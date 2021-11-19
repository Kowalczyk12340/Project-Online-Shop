<?php

namespace App\Http\Requests\ShoppingCartProduct;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductShoppingCartRequest extends FormRequest
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
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
