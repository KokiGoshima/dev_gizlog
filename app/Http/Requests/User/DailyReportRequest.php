<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
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
            "title" => "required",
            "contents" => "required",
        ];
    }
  
    public function messages()
    {
        return [
            "title.required" => "入力必須の項目です。",
            "contents.required" => "入力必須の項目です。",
        ];
    }
}

