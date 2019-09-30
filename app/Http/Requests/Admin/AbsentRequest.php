<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AbsentRequest extends FormRequest
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
            'date' => 'sometimes|required|before:tomorrow',
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
                if (app()->make('App\Models\Attendance')->findTheDayUserAttendance($this->date, $this->user_id)) {
                    $validator->errors()->add('checkDate', $this->date. '日の勤怠情報はすでに存在しています。');
                }
            }
        });
    }
}
