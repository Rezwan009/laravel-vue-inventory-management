<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeValidationRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name'          => 'required|min:2|max:100|unique:employees,name',
                        'email'         => 'required|string|unique:employees,email',
                        'address'       => 'required',
                        'phone'         => 'required|numeric',
                        'photo'         => 'sometimes',
                        'nid'           => 'sometimes',
                        'salary'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
                        'joining_date'  => 'required'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name'          => 'required|min:2|max:100|unique:employees,name,' . $this->id,
                        'email'         => 'required|string|unique:employees,email,' . $this->id,
                        'address'       => 'required',
                        'phone'         => 'required|numeric',
                        'photo'         => 'sometimes',
                        'nid'           => 'sometimes',
                        'salary'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
                        'joining_date'  => 'required'
                    ];
                }
            default:
                break;
        }
    }
}
