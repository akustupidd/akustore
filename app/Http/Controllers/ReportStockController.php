<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ReportStockController extends Controller
{
    public function ReportStock(Request $request) {
    $rowLength = $request->query('row_length', 10);

    $query = Stock::join('products', 'stock.product_id', '=', 'products.id')
                ->select('stock.*', 'products.name as product_name');

    // Filter by product name
    if ($request->filled('search')) {
        $query->where('products.name', 'like', '%' . $request->input('search') . '%');
    }

    // Filter by start and end date with correct UTC conversion
    if ($request->filled(['start_date', 'end_date'])) {
        $startDate = Carbon::parse($request->input('start_date'), 'Asia/Phnom_Penh')
            ->startOfDay()
            ->timezone('UTC');

        $endDate = Carbon::parse($request->input('end_date'), 'Asia/Phnom_Penh')
            ->addDay() // include full end date
            ->startOfDay()
            ->timezone('UTC');

        $query->whereBetween('stock.created_at', [$startDate, $endDate]);
    }

    $report_stocks = $query->paginate($rowLength);

    return view('page.report-stock.index', [
        'report_stocks' => $report_stocks
    ]);
}

    public function ExportCSV()
    {
        $filename = 'report-stock.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add BOM for Excel UTF-8 support
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // CSV headers
            fputcsv($handle, ['ID', 'Date', 'Name', 'Quantity', 'Price', 'Total']);

            Stock::with(['product'])->chunk(25, function ($stocks) use ($handle) {
                foreach ($stocks as $key => $item) {
                    $data = [
                        $item->id,
                        optional($item->created_at)->format('Y-m-d'),
                        optional($item->product)->name ?? '',
                        $item->quantity,
                        number_format($item->price, 2),
                        number_format($item->quantity * $item->price, 2)
                    ];

                    fputcsv($handle, $data);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

}
