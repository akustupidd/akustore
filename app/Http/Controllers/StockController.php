<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function Stock(Request $request) {
        $rowLength = $request->query('row_length', 10);
        $stocks = Stock::join('products', 'stock.product_id', '=', 'products.id') 
        ->select('stock.*', 'products.name as product_name')
        ->where('products.name', 'like', '%'.$request->input('search').'%')
        ->paginate($rowLength);

        return view('page.stocks.index', [
            'stocks'=>$stocks,
        ]);
    }

    public function Insert() {
        $products = Product::with('stock')->get();
        return view('page.stocks.insert', compact('products'));
    }

    public function InsertData(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $product_id = $request->input('product_id');

        // Fetch existing stock for the product
        $stock = Stock::where('product_id', $product_id)->first();

        if ($stock) {
            // Update existing stock
            $stock->quantity = $request->input('quantity');
            $stock->price = $request->input('price');
            // Check if SKU is 'SKU_NOT_FOUND' and generate a new SKU if needed
            if ($stock->sku == 'SKU_NOT_FOUND') {
                $stock->sku = $this->generateSku($stock->product->name); // Generate a new SKU
            }
            $stock->updated_at = now();
            $stock->save();
        } else {
            // Create new stock using existing SKU from product or generate new SKU
            $product = Product::findOrFail($product_id);

            $stock = new Stock();
            $stock->product_id = $product_id;
            $stock->quantity = $request->input('quantity');
            $stock->price = $request->input('price');

            // If SKU is 'SKU_NOT_FOUND', generate a new SKU
            $sku = $product->stock->sku ?? 'SKU_NOT_FOUND';
            $stock->sku = ($sku == 'SKU_NOT_FOUND') ? $this->generateSku($product->name) : $sku; // Use product name to generate SKU if needed
            $stock->save();
        }

        return redirect()->route('stock')->with('message', 'Stock updated successfully');
    }

    // Update function
    public function Update($id) {
        $stock = Stock::find($id);
        $products = Product::all();

        return view('page.stocks.edit', [
            'stock'=>$stock,
            'products'=>$products
        ]);
    }

    public function DataUpdate(Request $request, $id) {
        $stock = Stock::find($id);
        $stock->quantity = $request->input('quantity');
        $stock->price = $request->input('price');
        $stock->product_id = $request->input('product_id');

        // Check if SKU needs to be updated to a generated one
        if ($stock->sku == 'SKU_NOT_FOUND') {
            $product = Product::find($stock->product_id);
            $stock->sku = $this->generateSku($product->name); // Generate new SKU if SKU_NOT_FOUND
        }

        $stock->update();
        
        return redirect()->route('stock')->with('message', 'Accessories Updated Successfully');
    }

    // Delete function
    public function Delete(Request $request, $id){
        try {
            Stock::destroy($request->id);
            return redirect()->route('stock');
        } catch(\Exception $e) {
            report($e);
        }
    }

    // Function to generate SKU
    private function generateSku($productName)
    {
        // Get the initials of the product name
        $initials = strtoupper(substr($productName, 0, 3));
        // Generate a random number
        $randomNumber = rand(100, 999);
        // Get current timestamp
        $timestamp = now()->format('YmdHis');
        // Concatenate to form the SKU
        return $initials . '-' . $randomNumber . '-' . $timestamp;
    }
}

