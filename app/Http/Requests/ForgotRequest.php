<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotRequest extends FormRequest
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
            'email'=>'required|email|exists:users',
        ];
    }

    public function messages() {
        return [
            'email.required' =>'メールアドレスを入力してください!',
            'email.email' =>'存在するメールアドレスを入力してください!',
            'email.exists' => 'そのアドレスは登録されていません'
        ];
    }
}
