<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItems;

class OrderItemController extends Controller
{
    public function getOrderItemData()
    {
        // Fetch product types from the database
        $orderItems = OrderItems::all();

        // Return data as JSON
        return response()->json($orderItems);
    }
}
