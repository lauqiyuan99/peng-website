<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyOriginRequest extends FormRequest
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
            'family_origin_content' => 'required',
            'particular_year' => 'required',
            'media_path.*' => 'mimes:mp4,mov,ogg', //50 MB
            'image_path.*' => 'mimes:jpeg,jpg,png' // max 10000kb
        ];
    }

    public function messages()
    {
        return [
            'family_origin_content.required' => '内容不能为空',
            'particular_year.required' => '年份不能为空',
            'media_path' => '视频只能50MB',
            'image_path' => '照片过大'
        ];
    }
}
