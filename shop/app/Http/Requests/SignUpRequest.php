<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SignUpRequest extends Request
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
        $rules = [
            'name'      => 'required|max:50',
            'lastname'  => 'required|max:50',
            'email'     => 'required|max:255|email|unique:users,email',
            'gender'    => 'required',
            'user_type' => 'required|max:20',
            'password'  => 'required|min:6|confirmed',
            'password_confirmation' => 'required|max:200',
            'username'  => 'required|max:200|unique:users,username',
        ];

        return $rules;
    }
}
