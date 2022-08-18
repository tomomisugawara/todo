<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUser extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:filter|max:255',

            'image' => 'image|mimes:jpeg,png,jpg|max:2048',//8/18追加
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ニックネーム',
        ];
    }
}
