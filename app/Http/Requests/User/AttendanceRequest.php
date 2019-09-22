<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            'request_content' => 'sometimes|required|max:500',
            'absence_reason'   => 'sometimes|required|max:500',
            'date'            => 'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}

