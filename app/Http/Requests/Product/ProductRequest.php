<?php

namespace App\Http\Requests\Product;

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
        \Validator::extend('name',
        'Nazwa produktu wymagana', ['name' => $this->name],
    );

    \Validator::extend('category_id',
        'Kategoria produktu wymagana', ['category_id' => $this->category_id],
    );


        return [
            'name' => 'required',
            'category_id' => 'required',
            'unit_price' => 'required',
            'stock_status' => 'required',
            'description' => 'required',
            'image' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa produktu jest wymagana',
            'category_id.required' => 'Kategoria jest wymagana',
            'unit_price.required' => 'Cena jednostkowa jest wymagana',
            'stock_status.required' => 'Stan magazynowy jest wymagany',
            'description.required' => 'Opis produktu jest wymagany',
        ];
    }
}
