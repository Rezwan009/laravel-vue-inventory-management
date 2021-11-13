<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeValidationRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

use Image;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employees = Employee::all();
        $employees = Employee::select('name', 'phone', 'photo', 'salary', 'joining_date')->get();
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeValidationRequest $request)
    {

        $photo  = $request->photo ? Employee::base64Image($request->photo) : null;
        if ($request->validated()) {
            $employee = Employee::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'photo'        => $photo,
                'address'      => $request->address,
                'phone'        => $request->phone,
                'nid'          => $request->nid,
                'salary'       => $request->salary,
                'joining_date' => $request->joining_date,
            ]);
            return response()->json(['employee' => $employee]);
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
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeValidationRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        // $photo  = $request->newPhoto ? Employee::base64Image($request->newPhoto) : $employee->photo;
        $data = array();
        if ($request->validated()) {

            $data['name']         = $request->name;
            $data['email']        = $request->email;
            $data['address']      = $request->address;
            $data['phone']        = $request->phone;
            $data['nid']          = $request->nid;
            $data['salary']       = $request->salary;
            $data['joining_date'] = $request->joining_date;
            $photo = $request->newPhoto;
            if ($photo) {
                $newPhoto = Employee::base64Image($photo);
                if ($newPhoto) {
                    $data['photo'] = $newPhoto;
                    $oldPhoto = $request->photo;
                    unlink(public_path('backend/assets/img/employee/' . $oldPhoto));
                    $employee->update($data);
                }
                return response()->json(['employee' => $employee]);
            } else {
                $data['photo'] = $request->photo;
                $employee->update($data);
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
        $employee = Employee::findOrFail($id);
        $photo = $employee->photo;
        if ($photo) {
            unlink(public_path('backend/assets/img/employee/' . $photo));
            $employee->delete();
        } else {
            $employee->delete();
        }
    }
}
