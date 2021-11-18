<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function categoryWiseProducts($id)
    {
        $catProducts = Product::where('category_id', $id)->get();

        return response()->json($catProducts);
    }
    public function createOrder(Request $request)
    {
        $data = array();
        $validated = $request->validate([
            'customer_id' => "required",
            'payment_method' => 'required',
            'paid_amount' => 'required',
            'due_amount' => 'required'
        ]);

        if ($validated) {
            $data['customer_id'] = $request->customer_id;
            $data['payment_method'] = $request->payment_method;
            $data['paid_amount'] = $request->paid_amount;
            $data['due_amount'] = $request->due_amount;
            $data['total'] = $request->total;
            $data['vat'] = $request->vat;
            $data['subTotal'] = $request->subTotal;
            $data['quantity'] = $request->quantity;
            $data['order_date'] = date('d/m/y');
            $data['order_month'] = date('M');
            $data['order_year'] = date('Y');
            $order_id = DB::table('orders')->insertGetId($data);

            $orders = DB::table('carts')->get();
            $order_data = array();
            foreach ($orders as $order) {

                $order_data['order_id'] = $order_id;
                $order_data['product_id'] = $order->product_id;
                $order_data['product_qty'] = $order->product_qty;
                $order_data['product_price'] = $order->product_price;
                $order_data['sub_total'] = $order->sub_total;

                DB::table('order_details')->insert($order_data);

                DB::table('products')
                    ->where('id', $order->product_id)
                    ->update(['quantity' => DB::raw('quantity -' . $order->product_qty)]);
            }
            DB::table('carts')->delete();

            return response()->json(['success' => 'Success']);
        }
    }
}
