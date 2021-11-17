<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function categoryWiseProducts($id)
    {
        $catProducts = Product::where('category_id', $id)->get();

        return response()->json($catProducts);
    }
}
