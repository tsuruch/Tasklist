<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required',
            'deadline' => 'required'
        ];


    }


    public function messages() {

        return [
            'name.required' => '案件名をいれてください!!!',
            'deadline.required' => '納品日をいれてください!!!'
        ];
    }
}
