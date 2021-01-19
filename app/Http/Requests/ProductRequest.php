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
            'model'=> 'required|unique:products,model' ,
            'sku'=> 'required|max:64' ,
            'upc'=> 'required|max:12' ,
        ];

    }
    public function messages()
    {
        return [
            'model.required'=> 'هذا الحقل مطلوب' ,
            'model.unique'=> 'هذا الحقل موجود' ,
            'sku.required'=> 'هذا الحقل مطلوب' ,
            'sku.max'=> 'يجب ان يكون عدد احرف هذا الحقل اقل من 64 حرف' ,
            'upc.required'=> 'هذا الحقل مطلوب' ,
            'upc.max'=> 'يجب ان يكون عدد احرف هذا الحقل اقل من 12 حرف' ,

        ];
    }
}
