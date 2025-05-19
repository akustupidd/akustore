<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class ReportSaleController extends Controller
{
    public function ReportSale(Request $request) {
        $rowLength = $request->query('row_length', 10);



        if ($request->has('start_date') && $request->has('end_date')) {
            $order_items = OrderItems::whereBetween('order_items.created_at', [
                $request->input('start_date'),
                $request->input('end_date')
            ])
            ->where('products.name', 'like', '%'.$request->input('search').'%')
            ->leftJoin('products', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('products_type', 'products_type.id', '=', 'order_items.product_id')
            ->select('order_items.*', 'products.name as product_name', 'products_type.name as products_type_name')
            ->paginate($rowLength);
        } else {
            $order_items = OrderItems::leftJoin('products', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('products_type', 'products_type.id', '=', 'order_items.product_id')
            ->select('order_items.*', 'products.name as product_name', 'products_type.name as products_type_name')
            ->where('products.name', 'like', '%'.$request->input('search').'%')
            ->paginate($rowLength);

        }


        return view('page.report-sale.index',[
            'order_items' => $order_items
        ]);
    }

    public function ExportCSV()
    {
        $filename = 'report-sales.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add BOM (Byte Order Mark) to support special characters in Excel
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Add CSV headers
            fputcsv($handle, [
                'ID',
                'Date',
                'Name',
                'Ram',
                'Storage',
                'Color',
                'Quantity',
                'Price',
                'Total',
            ]);

            // Fetch item data with relations in chunks to avoid memory overload
            OrderItems::with(['product'])->chunk(25, function ($order_items) use ($handle) {
                foreach ($order_items as $key => $item) {
                    // Extract data from each item along with product, category, and status
                    $data = [
                        isset($key) ? $key : '',
                        isset($item->created_at) ? $item->created_at->format('Y-m-d') : '',
                        isset($item->product->name) ? $item->product->name : '',
                        isset($item->ram) ? $item->ram : '',
                        isset($item->storage) ? $item->storage : '',
                        isset($item->color) ? $item->color : '',
                        isset($item->quantity) ? $item->quantity : '0',
                        isset($item->price) ? '$'.number_format($item->price, 2) : '0',
                        isset($item->quantity) ? '$'.number_format($item->quantity * $item->price, 2) : '0',
                    ];

                    // Write data to the CSV file, ensuring UTF-8 support
                    fputcsv($handle, $data);
                }
            });

            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }
    public function show($order_id)
    {
        $order = Orders::findOrFail($order_id);
        $order_items = OrderItems::where('order_id', $order_id)->paginate(10);

        return view('page.report-sale.order-details', compact('order', 'order_items'));
    }
}
