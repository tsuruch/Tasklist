<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordresetRequest extends FormRequest
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
            'auth_code'=>'required|digits:6',
            'password'=>'required|min:8|confirmed',
        ];
    }


    public function messages() {
        return [
            'auth_code.required'=>'認証コードを入力してください',
            'auth_code.digits'=>'認証コードは6桁の数字です',
            'password.required' => 'パスワードを入力してください!',
            'password.min' => 'パスワードは8文字以上にしてください!',
            'password.confirmed' => '確認用パスワードと一致しません!',
        ];
    }
}

