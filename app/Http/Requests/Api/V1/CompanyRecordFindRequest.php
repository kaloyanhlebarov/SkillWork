<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRecordFindRequest extends FormRequest
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
    public function rules() {
        return [
            'company_domain' => 'required|string|exists:company_records,company_domain',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'company_domain.required' => 'Company domain can`t be empty.',
            'company_domain.string' => 'You have used unauthorized characters.',
            'company_domain.exists' => 'There is`t a request for this comapny domain.',
        ];
    }
}
