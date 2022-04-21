<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRecordRequestStoreRequest extends FormRequest
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
            'company_name'     => 'required|string',
            'company_domain'   => 'required|string|unique:company_record_requests,company_domain',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'company_name.required'     => 'Company name can`t be empty.',
			'company_name.string'	    => 'You have used unauthorized characters.',
            'company_domain.required'   => 'Company domain can`t be empty.',
			'company_domain.string'	    => 'You have used unauthorized characters.',
			'company_domain.unique'	    => 'A request for this company domain has already been submitted.',
        ];
    }
}
