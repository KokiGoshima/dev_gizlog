<?php

namespace App\Http\Requests\Admin;

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
            if ($this->filled('date')) {
                if (app()->make('App\Models\Attendance')->findTheDateUserAttendance($this->date, $this->user_id) {
                    $validator->errors()->add('checkDate', $this->date. '日の勤怠情報はすでに存在しています。');
                }
            }

            if ($this->filled(['start_time', 'end_time'])) {
                if($this->input('end_time') <= $this->input('start_time')) {
                    $validator->errors()->add('checkTime', '出社時間は退社時間よりも早い時間で登録してください');
                }
            }
        });
    }
}

