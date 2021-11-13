<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidationRequest extends FormRequest
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
                        'name'              => 'required|min:2|max:100|unique:products,name',
                        'code'              => 'required|string|unique:products,code',
                        'description'       => 'sometimes',
                        'category_id'       => 'required|numeric',
                        'supplier_id'       => 'required|numeric',
                        'image'             => 'sometimes',
                        'root'              => 'required',
                        'quantity'          => 'required|regex:/^\d+(\.\d{1,2})?$/',
                        'buying_price'      => 'sometimes|regex:/^\d+(\.\d{1,2})?$/',
                        'selling_price'     => 'required|regex:/^\d+(\.\d{1,2})?$/',
                        'buying_date'       => 'required',
                        'status'            => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name'          => 'required|min:2|max:100|unique:products,name,' . $this->id,
                        'code'         => 'required|string|unique:products,code,' . $this->id,
                        'description'       => 'sometimes',
                        'category_id'         => 'required|numeric',
                        'supplier_id'         => 'required|numeric',
                        'image'           => 'sometimes',
                        'root'           => 'required',
                        'quantity'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
                        'buying_price'        => 'sometimes|regex:/^\d+(\.\d{1,2})?$/',
                        'selling_price'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
                        'buying_date'  => 'required',
                        'status'  => 'required',
                    ];
                }
            default:
                break;
        }
    }
}
