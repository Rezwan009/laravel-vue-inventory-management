<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductValidationRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('suppliers', 'products.supplier_id', 'suppliers.id')
            ->select('categories.name as category_name', 'suppliers.name as supplier_name', 'products.*')
            ->orderBy('products.id', 'DESC')
            ->get();
        return response()->json($products);
    }
    public function stockOutProducts()
    {
        $products = DB::table('products')->where('quantity', '<', 1)->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidationRequest $request)
    {
        $image  = $request->image ? Product::base64Image($request->image) : null;
        if ($request->validated()) {
            $product = Product::create([

                'name'                => $request->name,
                'code'                => $request->code,
                'description'         => $request->description,
                'category_id'         => $request->category_id,
                'supplier_id'         => $request->supplier_id,
                'image'               => $image,
                'root'                => $request->root,
                'quantity'            => $request->quantity,
                'buying_price'        => $request->buying_price,
                'selling_price'       => $request->selling_price,
                'buying_date'         => $request->buying_date,
                'status'              => $request->status,
            ]);
            return response()->json(['product' => $product]);
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
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductValidationRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        // $photo  = $request->newPhoto ? Employee::base64Image($request->newPhoto) : $employee->photo;
        $data = array();
        if ($request->validated()) {

            $data['name']         = $request->name;
            $data['code']        = $request->code;
            $data['description']      = $request->description;
            $data['category_id']        = $request->category_id;
            $data['supplier_id']        = $request->supplier_id;
            $data['root']        = $request->root;
            $data['quantity']        = $request->quantity;
            $data['buying_price']        = $request->buying_price;
            $data['selling_price']        = $request->selling_price;
            $data['buying_date']          = $request->buying_date;
            $data['status']       = $request->status;
            $image = $request->newImage;
            if ($image) {
                $newImage = Product::base64Image($image);
                if ($newImage) {
                    $data['image'] = $newImage;
                    $oldImage = $request->image;
                    unlink(public_path('backend/assets/img/product/' . $oldImage));
                    $product->update($data);
                }
                return response()->json(['product' => $product]);
            } else {
                $data['image'] = $request->image;
                $product->update($data);
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
        $product = Product::findOrFail($id);
        $image = $product->image;
        if ($image) {
            unlink(public_path('backend/assets/img/product/' . $image));
            $product->delete();
        } else {
            $product->delete();
        }
    }
    public function stockUpdate(Request $request, $id)
    {
        $data = array();

        $data['quantity'] = $request->quantity;
        Product::where('id', $id)->update($data);
    }
}
