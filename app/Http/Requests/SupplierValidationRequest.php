<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierValidationRequest extends FormRequest
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
                        'name'          => 'required|min:2|max:100|unique:suppliers,name',
                        'email'         => 'required|string|unique:suppliers,email',
                        'address'       => 'required',
                        'phone'         => 'required|numeric',
                        'photo'         => 'sometimes',
                        'shop_name'     => 'required'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name'          => 'required|min:2|max:100|unique:suppliers,name,' . $this->id,
                        'email'         => 'required|string|unique:suppliers,email,' . $this->id,
                        'address'       => 'required',
                        'phone'         => 'required|numeric',
                        'photo'         => 'sometimes',
                        'shop_name'     => 'required'
                    ];
                }
            default:
                break;
        }
    }
}
