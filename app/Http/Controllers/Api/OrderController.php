<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function todaysOrder()
    {
        $date = date('d/m/y');
        $todaysOrder = DB::table('orders')
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->where('order_date', $date)
            ->select('customers.name', 'orders.*')
            ->orderBy('orders.id', 'DESC')
            ->get();
        return response()->json($todaysOrder);
    }
    public function orderDetails($id)
    {
        $order = DB::table('orders')
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->where('orders.id', $id)
            ->select('customers.name', 'customers.phone', 'customers.address', 'orders.*')
            ->first();
        return response()->json($order);
    }
    public function searchOrder(Request $request)
    {
        $date = $request->date;
        $newDate = new DateTime($date);
        $getDate = $newDate->format('d/m/y');
        $order = DB::table('orders')
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->where('orders.order_date', $getDate)
            ->select('customers.name', 'customers.phone', 'customers.address', 'orders.*')
            ->get();
        if ($order) {
            # code...
            return response()->json($order);
        } else {
            return response()->json(['error' => 'Not Found']);
        }
    }
    public function allOrderDetails($id)
    {
        $order_details = DB::table('order_details')
            ->join('products', 'products.id', 'order_details.product_id')
            ->where('order_details.order_id', $id)
            ->select('products.name', 'products.code', 'products.image', 'order_details.*')
            ->get();
        return response()->json($order_details);
    }
    public function todayIncome()
    {
        $date = date('d/m/y');
        $income = DB::table('orders')->where('order_date', $date)->sum('paid_amount');
        return response()->json($income);
    }
    public function todaySell()
    {
        $date = date('d/m/y');
        $sell = DB::table('orders')->where('order_date', $date)->sum('total');
        return response()->json($sell);
    }
    public function todayDue()
    {
        $date = date('d/m/y');
        $due = DB::table('orders')->where('order_date', $date)->sum('due_amount');
        return response()->json($due);
    }
    public function todayExpense()
    {
        $date = date('d/m/y');
        $expense = DB::table('expenses')->where('expense_date', $date)->sum('amount');
        return response()->json($expense);
    }
}
