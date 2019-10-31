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
            'correction_reason' => ['sometimes', 'required', 'max:500'],
            'absence_reason' => ['sometimes', 'required', 'max:500'],
            'start_time' => ['sometimes','required'],
            'end_time' => ['sometimes','required'],
            'date' => ['sometimes','required','before:tomorrow'],
        ];

        if ($this->filled(['start_time', 'end_time'])) {
            $rules['start_time'][] = new CheckTime($this);
        }

        if (!strpos(url()->previous(), 'edit')) {
            $rules['date'][] = Rule::unique('attendances')
                ->where('date', $this->date)
                ->where('user_id', $this->route()->user_id);
        }

        return $rules;
    }
}
