<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PharIo\Manifest\Email;

class UserRequest extends FormRequest
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
            'username'=>'required|max:20',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed',
        ];



    }


    public function messages() {
        return [
            'username.required'=>'名前を入力してください!',
            'username.max'=>'名前が長すぎます!',
            'email.required' =>'メールアドレスを入力してください!',
            'email.email' =>'存在するメールアドレスを入力してください!',
            'email.unique' => 'そのメールアドレスはすでに登録されています!',
            'password.required' => 'パスワードを入力してください!',
            'password.min' => 'パスワードは8文字以上にしてください!',
            'password.confirmed' => '確認用パスワードと一致しません!',
        ];
    }
}
