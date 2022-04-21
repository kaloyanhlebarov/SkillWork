<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required'         => 'Name can`t be empty.',
			'name.string'           => 'You have used unauthorized characters.',
			'name.min'              => 'Name must be at least :min characters.',
			'email.required'        => 'Email can`t be empty.',
			'email.string'          => 'You have used unauthorized characters.',
			'email.email'           => 'Please enter a valid email address.',
			'email.max'             => 'Email address can`t be more than :max characters.',
			'email.unique'          => 'Email address is already registered.',
			'password.required'     => 'Password can`t be empty.',
			'password.string'       => 'You have used unauthorized characters.',
			'password.min'          => 'Password must be at least :min characters.',
        ];
    }
}
