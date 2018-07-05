<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HomeUserRegisterRequest extends Request
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

    public $rules = [
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
    ];


    protected $message = [
        'username.required' => '用户名必填',
        'password.required' => '密码不能为空',
        'password_confirmation.required' => '请重新输入确认密码'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->rules;
        return $rules;
    }

    public function messages()
    {
        return $this->message;
    }
}
