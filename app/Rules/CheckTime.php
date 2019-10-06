<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckTime implements Rule
{

    protected $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * バリデーションの成功を判定
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->request->input('end_time') >= $value;
    }

    /**
     * バリデーションエラーメッセージの取得
     * @return string
     */
    public function message()
    {
        return '出社時間は'. $this->request->input('end_time'). '(退社時間)より早い時間で指定してください。';
    }
}
