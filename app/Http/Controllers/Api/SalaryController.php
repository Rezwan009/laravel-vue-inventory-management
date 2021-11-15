<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryValidationRequest;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function paySalary(SalaryValidationRequest $request, $id)
    {
        if ($request->validated()) {
            $month = $request->salary_month;
            $isPaid = Salary::where('employee_id', $id)->where('salary_month', $request->salary_month)->first();
            if ($isPaid) {
                return response()->json(["msg" => "Salary already paid"]);
            } else {
                $salary = Salary::create([

                    'employee_id'          => $id,
                    'amount'               => $request->salary,
                    'salary_date'          => date('d/m/y'),
                    'salary_month'         => $month,
                    'salary_year'          => date('Y'),
                ]);
                return response()->json(['salary' => $salary]);
            }
        } else {
            return response()->json(['errors' => $request->input()]);
        }
    }
    public function allSalaries()
    {
        $salaries = DB::table('salaries')
            ->select('salary_month')
            ->groupBy('salary_month')
            ->get();
        return response()->json($salaries);
    }

    public function salaryDetails($month)
    {
        $salaryDetails = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->where('salaries.salary_month', $month)
            ->select('employees.name', 'salaries.*')
            ->get();
        return response()->json($salaryDetails);
    }
    public function salaryEdit($id)
    {
        $salary = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'employees.email', 'salaries.*')
            ->where('salaries.id', $id)
            ->first();
        return response()->json($salary);
    }
    public function salaryUpdate(Request $request, $id)
    {
        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_month'] = $request->salary_month;
        Salary::where('id', $id)->update($data);
    }
}
