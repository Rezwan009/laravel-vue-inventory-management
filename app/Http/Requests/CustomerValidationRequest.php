<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerValidationRequest extends FormRequest
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
                        'name'          => 'required|min:4|max:255|string',
                        'email'         => 'sometimes|email',
                        'address'       => 'required',
                        'phone'         => 'required|numeric|unique:customers,phone',
                        'photo'         => 'sometimes',

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [

                        'name'          => 'required|min:4|max:255|string',
                        'email'         => 'sometimes|email',
                        'address'       => 'required',
                        'phone'         => 'required|numeric|unique:customers,phone,' . $this->id,
                        'photo'         => 'sometimes',
                    ];
                }
            default:
                break;
        }
    }
}
