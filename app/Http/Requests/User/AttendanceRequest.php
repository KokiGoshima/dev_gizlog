<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

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
            'correction_reason' => 'sometimes|required|max:500',
            'absence_reason' => 'sometimes|required|max:500',
            'date' => 'sometimes|required|before:tomorrow',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}

