<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AttendanceUpdateRequest extends FormRequest
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
            'start_time' => 'sometimes|required',
            'end_time' => 'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            if ($this->filled(['start_time', 'end_time'])) {
                if($this->input('end_time') <= $this->input('start_time')) {
                    $validator->errors()->add('checkTime', '出社時間は退社時間よりも早い時間で登録してください');
                }
            }
        });
    }
}

