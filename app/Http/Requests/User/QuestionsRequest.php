<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionsRequest extends FormRequest
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
            'tag_category_id' => Rule::notIn([0]),
            'title' => 'required|max:50',
            'content' => 'required|max:250',
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須項目です。',
            'title.max' => '50文字以内で入力してください。',
            'content.max' => '250文字以内で入力してください。',
        ];
    }
}

