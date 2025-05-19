<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\OrderItems;

class ProductController extends Controller
{
    public function getProductTypeData()
    {
        // Fetch product types from the database
        $productTypes = ProductType::all();

        // Return data as JSON
        return response()->json($productTypes);
    }
}
