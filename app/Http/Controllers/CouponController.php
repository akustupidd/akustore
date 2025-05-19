<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupon(Request $request) {
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);

        // Build the query
        $query = Coupon::query();

        // Apply search if present
        if ($search_value) {
            $query->where(function($q) use ($search_value) {
                $q->where('code', 'LIKE', '%' . $search_value . '%')
                ->orWhere('title', 'LIKE', '%' . $search_value . '%');
            });
        }

        // Paginate results
        $coupons = $query->paginate($rowLength);

        // Return view with data
        return view('page.coupons.index', [
            'coupons' => $coupons,
            'search_value' => $search_value,
        ]);
    }


    public function Insert() {
        return view('page.coupons.insert');
    }

    public function InsertData(Request $request) {
        $sku = $this->generateSku($request->input('title'));
        $coupon = new Coupon();
        $coupon->title = $request->input('title');
        $coupon->value = $request->input('value');
        $coupon->code = $sku;


        $coupon->save();
        return redirect()->route('admin-coupon')->with('message', 'Coupon Inserted Successfully');
    }

    // update
    public function Update($id) {
        $coupon = Coupon::find($id);

        return view('page.coupons.edit', [
            'coupon'=>$coupon,
        ]);
    }

    public function DataUpdate(Request $request, $id) {
        $coupon = Coupon::find($id);
        $coupon->title = $request->input('title');
        $coupon->value = $request->input('value');

        $coupon->update();

        return redirect()->route('admin-coupon')->with('message','Coupon Updated Successfully');
    }

    // delete
    public function Delete(Request $request, $id){
        try {
            Coupon::destroy($request->id);
            return redirect()->route('admin-coupon');
        } catch(\Exception $e) {
            report($e);
        }
    }

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
