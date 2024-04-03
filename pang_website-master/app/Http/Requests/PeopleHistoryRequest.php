<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleHistoryRequest extends FormRequest
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
            'history_name' => 'required',
            'image_path.*' => 'mimes:jpeg,jpg,png,gif',
            'incident_date' => 'required',
            'incident_person' => 'required',
            'media_path.*' => 'mimes:mp4,mov,ogg'// 50mb
        ];
    }
    public function messages()
    {
        return [
            'history_name.required' => '事件名称不能为空',
            'incident_date.required' => '发生于不能为空',
            'incident_person.required' => '时间人物不能为空',
        ];
    }
}
