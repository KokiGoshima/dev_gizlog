<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

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
            'date' => [
                'sometimes',
                'required',
                'before:tomorrow',
                Rule::unique('attendances')->where('date', Carbon::today()->format('Y-m-d'))
                    ->where('user_id', $this->route()->user_id)
            ],
        ];
    }

}
