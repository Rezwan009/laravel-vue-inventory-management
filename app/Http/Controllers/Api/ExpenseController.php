<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseValidationRequest;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses  = Expense::all();
        return response()->json($expenses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseValidationRequest $request)
    {
        if ($request->validated()) {
            $expense = Expense::create([
                'details'              => $request->details,
                'amount'               => $request->amount,
                'expense_date'         => date('d/m/y'),
            ]);
            return response()->json(['expense' => $expense]);
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
        $expense = Expense::findOrFail($id);
        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseValidationRequest $request, $id)
    {
        $expense = Expense::findOrFail($id);

        if ($request->validated()) {
            $expense->update($request->all());
            return response()->json(['expense' => $expense]);
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
        Expense::findOrFail($id)->delete();
    }
}
