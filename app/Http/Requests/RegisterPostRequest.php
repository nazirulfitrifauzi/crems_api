<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email|unique:users|regex:/(.*)csc\.net\.my$/i',
            'password' => 'required|string|confirmed'
        ];
    }

    /**
     * Get the custom message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.regex' => 'We appreciate your interest on using our System. However at the moment we offer this service only to our company!'
        ];
    }
}
