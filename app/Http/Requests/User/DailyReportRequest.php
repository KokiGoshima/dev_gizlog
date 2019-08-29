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
            'title' => 'required|max:30',
            'content' => 'required|max:300',
            'reporting_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須の項目です。',
            'title.max' => '30文字以内で入力してください',
            'content.max' => '300文字以内で入力してください',
            'reporting_time.required' => '日付けを入力してください',
        ];
    }
}
