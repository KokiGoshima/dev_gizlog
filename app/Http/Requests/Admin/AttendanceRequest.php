<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Rules\CheckTime;

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
        $rules = [
            'correction_reason' => 'sometimes|required|max:500',
            'absence_reason' => 'sometimes|required|max:500',
            'start_time' => [
                'sometimes',
                'required',
            ],
            'end_time' => [
                'sometimes',
                'required',
            ],
            'date' => [
                'sometimes',
                'required',
                'before:tomorrow',
                Rule::unique('attendances')->where('date', Carbon::today()->format('Y-m-d'))
                    ->where('user_id', $this->route()->user_id)
            ],
        ];

        if ($this->filled(['start_time', 'end_time'])) {
            $rules['start_time'][] = new CheckTime($this);
        }

        return $rules;
    }

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator){
    //         if ($this->filled(['start_time', 'end_time'])) {
    //             if ($this->input('end_time') <= $this->input('start_time')) {
    //                 $validator->errors()->add('checkTime', '出社時間は退社時間よりも早い時間で登録してください');
    //             }
    //         }
    //     });
    // }
}
