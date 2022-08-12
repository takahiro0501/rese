<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'min:8','max:191'],
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '191文字以内で入力してください',
            'name.string' => '文字で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email.max' => '191文字以内で入力してください',
            'email.unique' => 'メールアドレスが既に登録されています',
            'email.string' => '文字で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => '8文字以上で入力してください',
            'password.max' => '191文字以内で入力してください',
            'password.string' => '文字で入力してください',
        ];
    }
}
