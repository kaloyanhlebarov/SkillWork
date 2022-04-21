<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email'     => 'required|string|email|exists:users,email',
            'password'  => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'email.required' 	=> 'Email address can`t be empty.',
			'email.string'	    => 'You have used unauthorized characters.',
			'email.email'		=> 'Please enter a valid email address.',
			'email.exists' 		=> 'There is no such user.',
			'password.required' => 'Password can`t be empty.',
			'password.string'   => 'You have used unauthorized characters.',
        ];
    }
}
