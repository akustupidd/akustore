<?php
namespace App\Http\Controllers;

use App\Models\AccessaryType;
use App\Models\ColorFeature;
use App\Models\FeatureImage;
use App\Models\Ram;
use App\Models\RamFeature;
use App\Models\Storage;
use App\Models\StorageFeature;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function Product(Request $request) {
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);
        $categories = Category::all();
        $brands = Brand::all();
        $products_type = ProductType::all();
        $accessaries = AccessaryType::all();

        $products = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftJoin('accessaries_type', 'products.accessary_id', '=', 'accessaries_type.id')
            ->leftJoin('products_type', 'products.product_type', '=', 'products_type.id')
            ->select('products.*',
            'categories.name as category_name',
            'brands.name as brand_name',
            'products_type.name as products_type_name',
            'accessaries_type.name as accessary_name',
            )
            ->where('products.name', 'like', '%'.$request->input('search').'%')
            ->where(function($query) use ($request) {
                $query->where('categories.name', 'like', '%'.$request->query("category").'%')->orWhereNull('categories.name');
            })
            ->where(function($query) use ($request) {
                $query->where('products.type', 'like', '%'.$request->query("type").'%')->orWhereNull('products.type');
            })
            ->where(function($query) use ($request) {
                $query->where('brands.name', 'like', '%'.$request->query("brand").'%')->orWhereNull('brands.name');
            })
            ->where(function($query) use ($request) {
                $query->where('accessaries_type.name', 'like', '%'.$request->query("accessary_name").'%')->orWhereNull('accessaries_type.name');
            })
            ->where(function($query) use ($request) {
                $query->where('products_type.name', 'like', '%'.$request->query("product_type").'%')->orWhereNull('products_type.name');
            })
            ->paginate($rowLength);

        return view('page.products.index', [
            'products'=>$products,
            'search_value' => $search_value,
            'categories'=>$categories,
            'brands'=>$brands,
            'products_type'=>$products_type,
            'accessaries'=>$accessaries
        ]);
    }

    public function Insert() {
        $categories = Category::all();
        $brands = Brand::all();
        $products_type = ProductType::all();
        $accessaries = AccessaryType::all();
        $rams = Ram::orderBy('size', 'ASC')->get();
        $storages = Storage::orderBy('size', 'ASC')->get();
        $colors = Color::get();

        return view('page.products.insert', [
            'categories'=>$categories,
            'brands'=>$brands,
            'products_type'=>$products_type,
            'accessaries'=>$accessaries,
            'rams'=>$rams,
            'storages'=>$storages,
            'colors'=>$colors
        ]);
    }

    public function InsertData(Request $request)
    {
        $products = new Product();
        $products->name = $request->input('name');
        $products->slug = $this->generateSlug($products->name);
        $products->price = $request->input('price');
        $products->discount_price = $request->input('discount_price');
        $products->type = $request->input('type');
        $products->category_id = $request->input('category_id');
        $products->brand_id = $request->input('brand_id');
        $products->product_type = $request->input('product_type');
        $products->quantity = $request->input('quantity');
        $products->accessary_id = $request->input('accessary_id');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/products', $filename);
            $products->image = $filename;
        }
        $products->save();

        // Add to stock with SKU generation based on product name
        $sku = $this->generateSku($products->name); // Generate SKU using product name
        \DB::table('stock')->insert([
            'product_id' => $products->id,
            'quantity' => $products->quantity,
            'price' => $products->price,
            'sku' => $sku,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('product')->with('message', 'Product Inserted Successfully');
    }
    private function generateSku($productName)
    {
        // Get the initials of the product name (first 3 characters)
        $initials = strtoupper(substr($productName, 0, 3));
        // Generate a random 3-digit number
        $randomNumber = rand(100, 999);
        // Get current timestamp
        $timestamp = now()->format('YmdHis');
        // Concatenate to form the SKU
        return $initials . '-' . $randomNumber . '-' . $timestamp;
    }
    public function Update($id) {
    $product = Product::findOrFail($id);
    $categories = Category::all();
    $brands = Brand::all();
    $products_type = ProductType::all();
    $accessaries = AccessaryType::all();
    $rams = Ram::orderBy('size', 'ASC')->get();
    $storages = Storage::orderBy('size', 'ASC')->get();
    $colors = Color::get();

    return view('page.products.edit', [
        'product' => $product,
        'categories' => $categories,
        'brands' => $brands,
        'products_type' => $products_type,
        'accessaries' => $accessaries,
        'rams' => $rams,
        'storages' => $storages,
        'colors' => $colors,
    ]);
}

    public function DataUpdate(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'type' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'product_type' => 'required|integer|exists:products_type,id',
            'quantity' => 'required|integer|min:0',
            'accessary_id' => 'nullable|integer|exists:accessaries_type,id',
        ]);

        $products = Product::find($id);

        if (!$products) {
            return redirect()->route('product')->with('error', 'Product not found');
        }

        $products->name = $request->input('name');
        $products->slug = $this->generateSlug($products->name);
        $products->price = $request->input('price');
        $products->discount_price = $request->input('discount_price');
        $products->type = $request->input('type');
        $products->category_id = $request->input('category_id');
        $products->brand_id = $request->input('brand_id');
        $products->product_type = $request->input('product_type');
        $products->quantity = $request->input('quantity');
        $products->accessary_id = $request->input('accessary_id');

        // Handle file upload
        if ($request->hasFile('image')) {
            $destination = 'uploads/products/' . $products->image;
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/products', $filename);
            $products->image = $filename;
        }

        $products->save();

        // Update stock with new SKU based on product name
        $sku = $this->generateSku($products->name); // Generate new SKU based on name
        \DB::table('stock')->updateOrInsert(
            ['product_id' => $products->id],
            [
                'quantity' => $products->quantity,
                'price' => $products->price,
                'sku' => $sku, // Update SKU as well
                'updated_at' => now(),
            ]
        );

        return redirect()->route('product')->with('message', 'Product Updated Successfully');
    }

    public function Delete(Request $request, $id) {
        try {
            Product::destroy($request->id);
            \DB::table('stock')->where('product_id', $id)->delete(); // Delete stock entry
            return redirect()->route('product')->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            report($e);
        }
    }
    private function generateSlug($name)
    {
        return Str::slug($name, '-');
    }
}
