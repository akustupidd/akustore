<?php
namespace App\Http\Controllers\WebControllers;
use App\Http\Controllers\Controller;

use App\Models\Accessaries;
use App\Models\ColorFeature;
use App\Models\RamFeature;
use App\Models\StorageFeature;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\FeatureImage;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Specification;
use App\Models\SoftInfo;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\Color;
use App\Models\Blog;

class ProductController extends Controller
{
    public function Product(Request $request)
{
    $sort_by = $request->query('sort_by');
    $rowLength = $request->query('row_length', 12); // Default to 12
    $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
    $products_type = ProductType::all();
    $brands = Brand::all();
    $categories = Category::all();

    // Base query
    $query = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('accessaries_type', 'products.accessary_id', '=', 'accessaries_type.id')
        ->join('products_type', 'products.product_type', '=', 'products_type.id')
        ->select(
            'products.*',
            'categories.name as category_name',
            'brands.name as brand_name',
            'products_type.name as products_type_name',
            'accessaries_type.name as accessary_name'
        );

    // Apply filters
    if ($request->has('search_name')) {
        $query->where('products.name', 'like', '%' . $request->query('search_name') . '%');
    }

    if ($request->has('product_type_name')) {
        $query->whereIn('products_type.name', $request->query('product_type_name'));
    }

    if ($request->has('brand_name')) {
        $query->where('brands.name', 'like', '%' . $request->query('brand_name') . '%');
    }

    if ($request->has('accessary_name')) {
        $query->where('accessaries_type.name', 'like', '%' . $request->query('accessary_name') . '%');
    }

    if ($request->has('category_name')) {
        $query->whereIn('categories.name', $request->query('category_name'));
    }

    // Handle sorting
    switch ($sort_by) {
        case 'title-ascending':
            $query->orderBy('products.name', 'asc');
            break;
        case 'title-descending':
            $query->orderBy('products.name', 'desc');
            break;
        case 'price-ascending':
            $query->orderBy('products.price', 'asc');
            break;
        case 'price-descending':
            $query->orderBy('products.price', 'desc');
            break;
        default:
            $query->orderBy('products.created_at', 'desc'); // Default sort
    }

    // Handle "all" row length
    if ($rowLength === 'all') {
        $products = $query->get(); // Fetch all records
        $isPaginated = false;
    } else {
        $products = $query->paginate($rowLength); // Paginate for other row lengths
        $isPaginated = true;
    }

    // Check if no products found
    if ($products->isEmpty()) {
        $noProductsMessage = "No products found for the given search criteria.";
    } else {
        $noProductsMessage = null;
    }

    return view('web-page.product.shop', [
        'products' => $products,
        'products_type' => $products_type,
        'brands' => $brands,
        'categories' => $categories,
        'sort_by' => $sort_by,
        'posts' => $posts,
        'isPaginated' => $isPaginated, // Pass pagination state to the view
        'noProductsMessage' => $noProductsMessage, // Pass no-products message
    ]);
}



    public function ProductDetail($slug) {

        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $product = Product::where('slug', $slug)->firstOrFail();
        $products = Product::orderBy('created_at', 'desc')->get();
        $specifications = Specification::where('product_id', $product->id)->get();
        $softinfos = SoftInfo::where('product_id', $product->id)->get();
        $features_img = FeatureImage::where('product_id', $product->id)->get();
        $rams = RamFeature::join('rams', 'rams.id', '=', 'rams_feature.ram_id')
        ->select('rams_feature.*', 'rams.size as size')
        ->where('product_id', $product->id)->get();
        $storages = StorageFeature::join('storages', 'storages.id', '=', 'storages_feature.storage_id')
        ->select('storages_feature.*', 'storages.size as size')
        ->where('product_id', $product->id)->get();
        $colors = ColorFeature::join('colors', 'colors.id', '=', 'colors_feature.color_id')
        ->select('colors_feature.*', 'colors.color_name as color_name', 'colors.color_code as color_code')
        ->where('product_id', $product->id)->get();

        return view('web-page.product.product-detail', [
            'product' => $product,
            'products' => $products,
            'specifications' => $specifications,
            'softinfos' => $softinfos,
            'features_img' => $features_img,
            'rams' => $rams,
            'storages' => $storages,
            'colors' => $colors, 
            'posts' => $posts,
        ]);
        
    }

    public function show($slug)
    {
        // Find the product by slug
        $product = Product::where('slug', $slug)->first();

        // Check if the product exists
        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found.');
        }

        // Return the product details view with the product data
        return view('web-page.home', compact('product'));
    }


}
