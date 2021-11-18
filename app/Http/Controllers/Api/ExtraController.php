<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function vat()
    {
        $vats = Extra::first();
        return response()->json($vats);
    }
}
