<?php

namespace App\Http\Requests\Categories;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;


class StoreCategoryRequest extends FormRequest
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
       // rozszerzenie reguł walidacji tylko dla StoreCategoryRequest
        // sprawdzenie unikalności nazwy kategorii
        \Validator::extend('unique_name',
            function ($attribute, $value, $parameters, $validator) {
                $result = Category::withTrashed()->where('category_name', $value)->count();
                return $result === 0;
            },
            'Nazwa kategorii musi być unikalna', ['category_name' => $this->category_name]
        );

        return [
            'category_name'=> [
                'required',
                'max:50',
                'unique_name'
            ],
            'image' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Nazwa kategorii jest wymagana',
            'category_name.max:50' => 'Nazwa kategorii może zawierać maxymalnie 50 znaków',
            'category_name.unique_name' => 'Nazwa kategorii musi być unikalna',
        ];
    }
}
