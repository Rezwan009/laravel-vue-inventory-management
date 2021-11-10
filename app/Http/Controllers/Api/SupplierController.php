<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierValidationRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierValidationRequest $request)
    {
        $photo  = $request->photo ? Supplier::base64Image($request->photo) : null;
        if ($request->validated()) {
            $supplier = Supplier::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'photo'        => $photo,
                'address'      => $request->address,
                'phone'        => $request->phone,
                'shop_name'    => $request->shop_name,
            ]);
            return response()->json(['supplier' => $supplier]);
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
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierValidationRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        // $photo  = $request->newPhoto ? Employee::base64Image($request->newPhoto) : $employee->photo;
        $data = array();
        if ($request->validated()) {

            $data['name']         = $request->name;
            $data['email']        = $request->email;
            $data['address']      = $request->address;
            $data['phone']        = $request->phone;
            $data['shop_name']    = $request->shop_name;
            $photo = $request->newPhoto;
            if ($photo) {
                $newPhoto = Supplier::base64Image($photo);
                if ($newPhoto) {
                    $data['photo'] = $newPhoto;
                    $oldPhoto = $request->photo;
                    unlink(public_path('backend/assets/img/supplier/' . $oldPhoto));
                    $supplier->update($data);
                }
                return response()->json(['supplier' => $supplier]);
            } else {
                $data['photo'] = $request->photo;
                $supplier->update($data);
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
        $supplier = Supplier::findOrFail($id);
        $photo = $supplier->photo;
        if ($photo) {
            unlink(public_path('backend/assets/img/supplier/' . $photo));
            $supplier->delete();
        } else {
            $supplier->delete();
        }
    }
}
