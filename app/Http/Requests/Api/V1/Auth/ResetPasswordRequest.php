<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'email.required' 		=> 'Email can`t be empty.',
            'email.email' 			=> 'Please enter a valid email address.',
            'email.exists' 		    => 'There is no account associated with that email address.',
            'password.required' 	=> 'Password can`t be empty.',
            'password.string' 	    => 'You have used unauthorized characters.',
            'password.min' 		    => 'Password must be at least :min characters.',
            'password.confirmed'    => 'Both passwords don`t match.',
            'password_confirmation.required' => 'Password confirm can`t be empty.',
        ];
    }
}
