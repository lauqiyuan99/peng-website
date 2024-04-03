<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'name' => 'required',
            'image_path.*' => 'mimes:jpeg,jpg,png,gif',
            'business_list' =>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名字不能为空',
            'business_list.required' => '生意不能为空',
        ];
    }
}
