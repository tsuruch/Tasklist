<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatgroupRequest extends FormRequest
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
            'name'=>'required|unique:chatgroups,name,'. $this->id. ',id|max:100',
            'members'=> 'required',
        ];
    }


    public function messages() {
        return [
            'name.required'=>'チャットグループを入れてください!!!',
            'name.max'=>'チャットグループ名は100文字以内にしてください!!!',
            'name.unique'=>'入力されたチャットグループ名は既に存在しています!別の名前にしてください',
            'members.required'=>'グループに招待する人が選択されていません!',
        ];
    }
}
