<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryValidationRequest;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaries = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->orderBy('salaries.id', 'DESC')
            ->get();
        return response()->json($salaries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalaryValidationRequest $request)
    {
        if ($request->validated()) {
            $salary = Salary::create([

                'employee_id'          => $request->employee_id,
                'amount'               => $request->amount,
                'salary_date'          => date('d/m/y'),
                'salary_month'         => $request->salary_month,
                'salary_year'          => date('d/m/y'),
            ]);
            return response()->json(['salary' => $salary]);
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
        $salary = Salary::findOrFail($id);
        return response()->json($salary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryValidationRequest $request, $id)
    {
        $salary = Salary::findOrFail($id);
        if ($request->validated()) {
            $salary->update($request->all());
            return response()->json(['salary' => $salary]);
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
        Salary::findOrFail($id)->delete();
    }
}
