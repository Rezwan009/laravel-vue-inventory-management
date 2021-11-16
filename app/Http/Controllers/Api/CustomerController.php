<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerValidationRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerValidationRequest $request)
    {
        $photo  = $request->photo ? Customer::base64Image($request->photo) : null;
        if ($request->validated()) {
            $customer = Customer::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'photo'        => $photo,
                'address'      => $request->address,
                'phone'        => $request->phone,

            ]);
            return response()->json(['customer' => $customer]);
        } else {
            return response()->json(['errors' => $request->input()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerValidationRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        // $photo  = $request->newPhoto ? Employee::base64Image($request->newPhoto) : $employee->photo;
        $data = array();
        if ($request->validated()) {

            $data['name']         = $request->name;
            $data['email']        = $request->email;
            $data['address']      = $request->address;
            $data['phone']        = $request->phone;
            $photo = $request->newPhoto;
            if ($photo) {
                $newPhoto = Customer::base64Image($photo);
                if ($newPhoto) {
                    $data['photo'] = $newPhoto;
                    $oldPhoto = $request->photo;
                    unlink(public_path('backend/assets/img/customer/' . $oldPhoto));
                    $customer->update($data);
                }
                return response()->json(['customer' => $customer]);
            } else {
                $data['photo'] = $request->photo;
                $customer->update($data);
            }
        } else {
            return response()->json(['errors' => $request->input()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $photo = $customer->photo;
        if ($photo) {
            unlink(public_path('backend/assets/img/customer/' . $photo));
            $customer->delete();
        } else {
            $customer->delete();
        }
    }
}
