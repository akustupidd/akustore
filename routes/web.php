<?php
use App\Http\Controllers\ReportSaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\Auth\GoogleController;
// Auth::routes();

// Customer routes
Route::get('/', [App\Http\Controllers\WebControllers\HomePageController::class, 'HomePage'])->name('home-page');
Route::post('/blog/comment/sort', [App\Http\Controllers\WebControllers\BlogController::class, 'sortComments'])
    ->name('blog.comment.sort');
Route::prefix('customer')->group(function () {
    Route::post('/blog/{id}/comment', [App\Http\Controllers\WebControllers\BlogController::class, 'storeComment'])->name('blog.comment')->middleware('auth:customer');
    Route::get('/register', [App\Http\Controllers\CustomerRegisterController::class, 'showRegistrationForm'])->name('customer.register');
    Route::post('/register', [App\Http\Controllers\CustomerRegisterController::class, 'register'])->name('customer.register.submit');
    Route::get('/login', [App\Http\Controllers\CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/login', [App\Http\Controllers\CustomerLoginController::class, 'login'])->name('customer.login.submit');
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
    // Forgot Password Routes
    Route::get('/forgot-password', [App\Http\Controllers\CustomerPasswordResetController::class, 'showForgotPasswordForm'])->name('customer.forgot-password');
    Route::post('/forgot-password', [App\Http\Controllers\CustomerPasswordResetController::class, 'sendOtp'])->name('customer.send-otp');
    Route::get('/reset-password', [App\Http\Controllers\CustomerPasswordResetController::class, 'showResetPasswordForm'])->name('customer.reset-password');
    Route::post('/reset-password', [App\Http\Controllers\CustomerPasswordResetController::class, 'resetPassword'])->name('customer.reset-password.submit');
    Route::post('/customer/resend-otp', [App\Http\Controllers\CustomerPasswordResetController::class, 'resendOtp'])->name('customer.resend-otp');

    Route::get('/', [App\Http\Controllers\WebControllers\HomePageController::class, 'HomePage'])->name('home');
    //profile setting
    Route::get('/account/profile', [App\Http\Controllers\WebControllers\ProfileController::class, 'Profile'])->name('profile')->middleware('auth:customer');
    Route::post('/account/profile/update-data', [App\Http\Controllers\WebControllers\ProfileController::class, 'UpdateData'])->name('profile.update')->middleware('auth:customer');

    // Route::put('/account/profile/update-data', [App\Http\Controllers\WebControllers\ProfileController::class, 'UpdateData'])->name('profile-update-data-setting')->middleware('auth:customer');
    Route::get('/account/my-order', [App\Http\Controllers\WebControllers\MyOrderController::class, 'MyOrder'])->name('my-order')->middleware('auth:customer');
    Route::get('/account/favorite', [App\Http\Controllers\WebControllers\FavoriteController::class, 'Favorite'])->name('favorite')->middleware('auth:customer');
    Route::get('/account/favorite-add/{id}', [App\Http\Controllers\WebControllers\FavoriteController::class, 'FavoriteAdd'])->name('favorite-add')->middleware('auth:customer');
    Route::delete('/remove-from-favorite/{id}', [App\Http\Controllers\WebControllers\FavoriteController::class, 'RemoveFav'])->name('remove-from-favorite')->middleware('auth:customer');
    Route::get('/account/change-password', [App\Http\Controllers\WebControllers\ChangePasswordController::class, 'ChangePassword'])->name('change-password')->middleware('auth:customer');
    Route::put('/account/update-password', [App\Http\Controllers\WebControllers\ChangePasswordController::class, 'UpdatePassword'])->name('update-password')->middleware('auth:customer');
    Route::get('/account/coupon', [App\Http\Controllers\WebControllers\CouponController::class, 'Coupon'])->name('coupon')->middleware('auth:customer');
    Route::post('/fetch-location', [App\Http\Controllers\LocationController::class, 'fetchLocation']);
    Route::post('/save-location', [App\Http\Controllers\CustomerLoginController::class, 'saveLocation'])->name('save.location');


    // Logout Route
    Route::post('/logout', [App\Http\Controllers\CustomerLoginController::class, 'logout'])->name('customer.logout');
});
// web application
Route::get('/products/{type}', [App\Http\Controllers\WebControllers\ProductController::class, 'getProductsByType'])->name('products.byType');
Route::get('/', [App\Http\Controllers\WebControllers\HomePageController::class, 'HomePage'])->name('home-page');
Route::get('/privacy-policy', function () {
    return view('web-page.contact.privacy-policy');
})->name('privacy-policy');
// page
Route::get('/product-shop', [App\Http\Controllers\WebControllers\ProductController::class, 'Product'])->name('product-shop');
// Route::get('/detail-prouct-quick-view/{id}', [App\Http\Controllers\WebControllers\ProductController::class, 'quickView'])->name('detail-product-quick-view');
Route::get('/product-detail/{slug}', [App\Http\Controllers\WebControllers\ProductController::class, 'ProductDetail'])->name('product-detail');
Route::get('blog', [App\Http\Controllers\WebControllers\BlogController::class, 'Blog'])->name('blog');
Route::get('/blog-details/{slug}', [App\Http\Controllers\WebControllers\BlogController::class, 'BlogDetail'])->name('blog-detail');

Route::get('/contact', [App\Http\Controllers\WebControllers\ContactController::class, 'Contact'])->name('contact');
// add to cart and place order
Route::get('/cart', [App\Http\Controllers\WebControllers\CartController::class, 'Cart'])->name('cart');
Route::get('/add-to-cart/{id}', [App\Http\Controllers\WebControllers\CartController::class, 'addToCart'])->name('cart.add');
Route::put('/update-cart/{id}', [App\Http\Controllers\WebControllers\CartController::class, 'UpdateCart'])->name('update-cart');
Route::delete('/remove-from-cart/{id}', [App\Http\Controllers\WebControllers\CartController::class, 'RemoveCart'])->name('remove-from-cart');
Route::get('/checkout', [App\Http\Controllers\WebControllers\CheckoutController::class, 'Checkout'])->name('checkout');
Route::post('/place-order', [App\Http\Controllers\WebControllers\CheckoutController::class, 'PlaceOrder'])->name('place-order');
// Route::get('/quick-view', [App\Http\Controllers\WebControllers\ModalViewController::class, 'QuickView'])->name('quick-view');

Route::prefix('admin')->group(function () {
    // Login Routes
    Route::get('/login', [App\Http\Controllers\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminLoginController::class, 'login'])->name('admin.login.submit');

    // Admin Dashboard (protected by auth:admin middleware)
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('auth:admin');
    // accessaries type
    Route::get('/accessaries', [App\Http\Controllers\AccessaryController::class, 'Accessaries'])->name('accessaries')->middleware('auth:admin');
    Route::post('/insert-data-accessaries', [App\Http\Controllers\AccessaryController::class, 'InsertData'])->name('insert-data-accessaries')->middleware('auth:admin');
    Route::put('/update-data-accessaries/{id}', [App\Http\Controllers\AccessaryController::class, 'DataUpdate'])->name('update-data-accessaries')->middleware('auth:admin');
    Route::get('/delete-accessaries/{id}', [App\Http\Controllers\AccessaryController::class, 'Delete'])->name('delete-accessaries')->middleware('auth:admin');
    // product
    Route::get('/product', [App\Http\Controllers\ProductController::class, 'Product'])->name('product')->middleware('auth:admin');
    Route::get('/insert-product', [App\Http\Controllers\ProductController::class, 'Insert'])->name('insert.product')->middleware('auth:admin');
    Route::post('/insert-data-product', [App\Http\Controllers\ProductController::class, 'InsertData'])->name('insert-data-product')->middleware('auth:admin');
    Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'Update'])->name('update.product')->middleware('auth:admin');
    Route::put('/edit-data-product/{id}', [App\Http\Controllers\ProductController::class, 'DataUpdate'])->name('edit-data-product')->middleware('auth:admin');
    Route::get('/delete-product/{id}', [App\Http\Controllers\ProductController::class, 'Delete'])->name('delete-product')->middleware('auth:admin');
    // // blog
    Route::get('/blog-ad', [App\Http\Controllers\BlogController::class, 'index'])->name('blog-ad')->middleware('auth:admin'); // ✅ Fixed!
    Route::get('/insert-blog', [App\Http\Controllers\BlogController::class, 'create'])->name('insert-blog')->middleware('auth:admin');
    Route::post('/insert-data-blog', [App\Http\Controllers\BlogController::class, 'store'])->name('data-insert-blog')->middleware('auth:admin');
    Route::get('/edit-blog/{id}', [App\Http\Controllers\BlogController::class, 'edit'])->name('update-blog')->middleware('auth:admin');
    Route::put('/edit-data-blog/{id}', [App\Http\Controllers\BlogController::class, 'update'])->name('data-update-blog')->middleware('auth:admin');
    Route::get('/delete-blog/{id}', [App\Http\Controllers\BlogController::class, 'destroy'])->name('delete-blog')->middleware('auth:admin'); // Changed GET to DELETE
    Route::post('/blog/{id}/toggle-status', [App\Http\Controllers\BlogController::class, 'toggleStatus'])->name('toggle-blog-status')->middleware('auth:admin');
    Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

    // brands
    Route::get('/brand', [App\Http\Controllers\BrandController::class, 'Brand'])->name('brand')->middleware('auth:admin');
    Route::post('/insert-data-brand', [App\Http\Controllers\BrandController::class, 'InsertData'])->name('insert-data-brand')->middleware('auth:admin');
    Route::put('/edit-data-brand/{id}', [App\Http\Controllers\BrandController::class, 'DataUpdate'])->name('edit-data-brand')->middleware('auth:admin');
    Route::get('/delete-brand/{id}', [App\Http\Controllers\BrandController::class, 'Delete'])->name('delete-brand')->middleware('auth:admin');
    // category
    Route::get('/category', [App\Http\Controllers\CategoryController::class, 'Category'])->name('category')->middleware('auth:admin');
    Route::post('/insert-data-category', [App\Http\Controllers\CategoryController::class, 'InsertData'])->name('insert.category')->middleware('auth:admin');
    Route::put('/edit-data-category/{id}', [App\Http\Controllers\CategoryController::class, 'DataUpdate'])->name('update-data-category')->middleware('auth:admin');
    Route::get('/delete-category/{id}', [App\Http\Controllers\CategoryController::class, 'Delete'])->name('delete-category')->middleware('auth:admin');
    // product type
    Route::get('/product-type', [App\Http\Controllers\ProductTypeController::class, 'ProductType'])->name('product-type')->middleware('auth:admin');
    Route::get('/insert-product-type', [App\Http\Controllers\ProductTypeController::class, 'Insert'])->name('insert-product-type')->middleware('auth:admin');
    Route::post('/insert-data-product-type', [App\Http\Controllers\ProductTypeController::class, 'InsertData'])->name('insert-data-product-type')->middleware('auth:admin');
    Route::get('/edit-product-type/{id}', [App\Http\Controllers\ProductTypeController::class, 'Update'])->name('update-product-type')->middleware('auth:admin');
    Route::put('/edit-data-product-type/{id}', [App\Http\Controllers\ProductTypeController::class, 'DataUpdate'])->name('update-data-product-type')->middleware('auth:admin');
    Route::get('/delete-product-type/{id}', [App\Http\Controllers\ProductTypeController::class, 'Delete'])->name('delete-product-type')->middleware('auth:admin');
    // banner
    Route::get('/banner', [App\Http\Controllers\BannersController::class, 'Banner'])->name('banner')->middleware('auth:admin');
    Route::post('/insert-data-banner', [App\Http\Controllers\BannersController::class, 'InsertData'])->name('insertbanner')->middleware('auth:admin');
    Route::put('/edit-data-banner/{id}', [App\Http\Controllers\BannersController::class, 'DataUpdate'])->name('updatebanner')->middleware('auth:admin');
    Route::get('/delete-banner/{id}', [App\Http\Controllers\BannersController::class, 'Delete'])->name('deltbanner')->middleware('auth:admin');
    // specification
    Route::get('/specification', [App\Http\Controllers\SpecificationController::class, 'Specification'])->name('specification')->middleware('auth:admin');
    Route::get('/insert-specification', [App\Http\Controllers\SpecificationController::class, 'Insert'])->name('insert-specification')->middleware('auth:admin');
    Route::post('/insert-data-specification', [App\Http\Controllers\SpecificationController::class, 'InsertData'])->name('insert-data-specification')->middleware('auth:admin');
    Route::get('/edit-specification/{id}', [App\Http\Controllers\SpecificationController::class, 'Update'])->name('update-specification')->middleware('auth:admin');
    Route::put('/edit-data-specification/{id}', [App\Http\Controllers\SpecificationController::class, 'DataUpdate'])->name('edit-data-specification')->middleware('auth:admin');
    Route::get('/delete-specification/{id}', [App\Http\Controllers\SpecificationController::class, 'Delete'])->name('delete-specification')->middleware('auth:admin');
    // soft info
    Route::get('/soft-info', [App\Http\Controllers\SoftInfoController::class, 'SoftInfo'])->name('soft-info')->middleware('auth:admin');
    Route::get('/insert-soft-info', [App\Http\Controllers\SoftInfoController::class, 'Insert'])->name('insert-soft-info')->middleware('auth:admin');
    Route::post('/insert-data-soft-info', [App\Http\Controllers\SoftInfoController::class, 'InsertData'])->name('insert-data-soft-info')->middleware('auth:admin');
    Route::get('/edit-soft-info/{id}', [App\Http\Controllers\SoftInfoController::class, 'Update'])->name('update-soft-info')->middleware('auth:admin');
    Route::put('/edit-data-soft-info/{id}', [App\Http\Controllers\SoftInfoController::class, 'DataUpdate'])->name('edit-data-soft-info')->middleware('auth:admin');
    Route::get('/delete-soft-info/{id}', [App\Http\Controllers\SoftInfoController::class, 'Delete'])->name('delete-soft-info')->middleware('auth:admin');
    // ram
    Route::get('/ram', [App\Http\Controllers\RamController::class, 'Ram'])->name('ram')->middleware('auth:admin');
    Route::get('/insert-ram', [App\Http\Controllers\RamController::class, 'Insert'])->name('insert-ram')->middleware('auth:admin');
    Route::post('/insert-data-ram', [App\Http\Controllers\RamController::class, 'InsertData'])->name('insert-data-ram')->middleware('auth:admin');
    Route::get('/edit-ram/{id}', [App\Http\Controllers\RamController::class, 'Update'])->name('update-ram')->middleware('auth:admin');
    Route::put('/edit-data-ram/{id}', [App\Http\Controllers\RamController::class, 'DataUpdate'])->name('edit-data-ram')->middleware('auth:admin');
    Route::get('/delete-ram/{id}', [App\Http\Controllers\RamController::class, 'Delete'])->name('delete-ram')->middleware('auth:admin');
    // storage
    Route::get('/storage', [App\Http\Controllers\StorageController::class, 'Storage'])->name('storage')->middleware('auth:admin');
    Route::get('/insert-storage', [App\Http\Controllers\StorageController::class, 'Insert'])->name('insert-storage')->middleware('auth:admin');
    Route::post('/insert-data-storage', [App\Http\Controllers\StorageController::class, 'InsertData'])->name('insert-data-storage')->middleware('auth:admin');
    Route::get('/edit-storage/{id}', [App\Http\Controllers\StorageController::class, 'Update'])->name('update-storage')->middleware('auth:admin');
    Route::put('/edit-data-storage/{id}', [App\Http\Controllers\StorageController::class, 'DataUpdate'])->name('edit-data-storage')->middleware('auth:admin');
    Route::get('/delete-storage/{id}', [App\Http\Controllers\StorageController::class, 'Delete'])->name('delete-storage')->middleware('auth:admin');
    // color
    Route::get('/color', [App\Http\Controllers\ColorController::class, 'Color'])->name('color')->middleware('auth:admin');
    Route::get('/insert-color', [App\Http\Controllers\ColorController::class, 'Insert'])->name('insert-color')->middleware('auth:admin');
    Route::post('/insert-data-color', [App\Http\Controllers\ColorController::class, 'InsertData'])->name('insert-data-color')->middleware('auth:admin');
    Route::get('/edit-color/{id}', [App\Http\Controllers\ColorController::class, 'Update'])->name('update-color')->middleware('auth:admin');
    Route::put('/edit-data-color/{id}', [App\Http\Controllers\ColorController::class, 'DataUpdate'])->name('edit-data-color')->middleware('auth:admin');
    Route::get('/delete-color/{id}', [App\Http\Controllers\ColorController::class, 'Delete'])->name('delete-color')->middleware('auth:admin');
    // stock
    Route::get('/stock', [App\Http\Controllers\StockController::class, 'Stock'])->name('stock')->middleware('auth:admin');
    Route::get('/insert-stock', [App\Http\Controllers\StockController::class, 'Insert'])->name('insert-stock')->middleware('auth:admin');
    Route::post('/insert-data-stock', [App\Http\Controllers\StockController::class, 'InsertData'])->name('insert-data-stock')->middleware('auth:admin');
    Route::get('/update-stock/{id}', [App\Http\Controllers\StockController::class, 'Update'])->name('update-stock')->middleware('auth:admin');
    Route::put('/update-data-stock/{id}', [App\Http\Controllers\StockController::class, 'DataUpdate'])->name('update-data-stock')->middleware('auth:admin');
    Route::get('/delete-stock/{id}', [App\Http\Controllers\StockController::class, 'Delete'])->name('delete-stock')->middleware('auth:admin');
    // coupon
    Route::get('/admin-coupon', [App\Http\Controllers\CouponController::class, 'Coupon'])->name('admin-coupon')->middleware('auth:admin');
    Route::get('/insert-admin-coupon', [App\Http\Controllers\CouponController::class, 'Insert'])->name('insert-admin-coupon')->middleware('auth:admin');
    Route::post('/insert-data-admin-coupon', [App\Http\Controllers\CouponController::class, 'InsertData'])->name('insert-data-admin-coupon')->middleware('auth:admin');
    Route::get('/edit-admin-coupon/{id}', [App\Http\Controllers\CouponController::class, 'Update'])->name('update-admin-coupon')->middleware('auth:admin');
    Route::put('/edit-data-admin-coupon/{id}', [App\Http\Controllers\CouponController::class, 'DataUpdate'])->name('edit-data-admin-coupon')->middleware('auth:admin');
    Route::get('/delete-admin-coupon/{id}', [App\Http\Controllers\CouponController::class, 'Delete'])->name('delete-admin-coupon')->middleware('auth:admin');
    //report stock
    Route::get('/report-stock', [App\Http\Controllers\ReportStockController::class, 'ReportStock'])->name('report-stock')->middleware('auth:admin');
    Route::get('/export-stock', [App\Http\Controllers\ReportStockController::class, 'ExportCSV'])->name('export-stock')->middleware('auth:admin');
    // report sale
    Route::get('/report-sale', [App\Http\Controllers\ReportSaleController::class, 'ReportSale'])->name('report-sale')->middleware('auth:admin');
    Route::get('/order/{order_id}', [ReportSaleController::class, 'show'])->name('orders.show')->middleware('auth:admin');

    Route::get('/export-sale', [App\Http\Controllers\ReportSaleController::class, 'ExportCSV'])->name('export-sale')->middleware('auth:admin');
    // user
    Route::get('/user', [App\Http\Controllers\UserController::class, 'User'])->name('user')->middleware('auth:admin');
    Route::get('/insert-user', [App\Http\Controllers\UserController::class, 'Insert'])->name('insert-user')->middleware('auth:admin');
    Route::post('/insert-data-user', [App\Http\Controllers\UserController::class, 'InsertData'])->name('insert-data-user')->middleware('auth:admin');
    Route::get('/edit-user/{id}', [App\Http\Controllers\UserController::class, 'Update'])->name('update-user')->middleware('auth:admin');
    Route::put('/edit-data-user/{id}', [App\Http\Controllers\UserController::class, 'DataUpdate'])->name('edit-data-user')->middleware('auth:admin');
    Route::get('/delete-user/{id}', [App\Http\Controllers\UserController::class, 'Delete'])->name('delete-user')->middleware('auth:admin');
     // client
     Route::get('/client', [clientController::class, 'Customer'])->name('client')->middleware('auth:admin');
     Route::get('/client/insert', [clientController::class, 'Insert'])->name('client.insert')->middleware('auth:admin');
     Route::post('/client/insert', [clientController::class, 'InsertData'])->name('client.insert.data')->middleware('auth:admin');
     Route::get('/client/edit/{id}', [clientController::class, 'Update'])->name('client.edit')->middleware('auth:admin');
     Route::put('/client/edit/{id}', [clientController::class, 'DataUpdate'])->name('client.update')->middleware('auth:admin');
     Route::get('/client-delete/{id}', [clientController::class, 'Delete'])->name('client.delete')->middleware('auth:admin');
    //role
    Route::get('/role', [App\Http\Controllers\RoleController::class, 'Role'])->name('role')->middleware('auth:admin');
    Route::get('/insert-role', [App\Http\Controllers\RoleController::class, 'Insert'])->name('insert-role')->middleware('auth:admin');
    Route::post('/insert-data-role', [App\Http\Controllers\RoleController::class, 'InsertData'])->name('insert-data-role')->middleware('auth:admin');
    Route::get('/edit-role/{id}', [App\Http\Controllers\RoleController::class, 'Update'])->name('update-role')->middleware('auth:admin');
    Route::put('/edit-data-role/{id}', [App\Http\Controllers\RoleController::class, 'DataUpdate'])->name('update-data-role')->middleware('auth:admin');
    Route::get('/delete-role/{id}', [App\Http\Controllers\RoleController::class, 'Delete'])->name('delete-role')->middleware('auth:admin');
    //permission
    Route::get('/permission', [App\Http\Controllers\PermissionController::class, 'Permission'])->name('permission')->middleware('auth:admin');
    Route::get('/insert-permission', [App\Http\Controllers\PermissionController::class, 'Insert'])->name('insert-permission')->middleware('auth:admin');
    Route::post('/insert-data-permission', [App\Http\Controllers\PermissionController::class, 'InsertData'])->name('insert-data-permission')->middleware('auth:admin');
    Route::get('/edit-permission/{id}', [App\Http\Controllers\PermissionController::class, 'Update'])->name('update-permission')->middleware('auth:admin');
    Route::put('/edit-data-permission/{id}', [App\Http\Controllers\PermissionController::class, 'DataUpdate'])->name('update-data-permission')->middleware('auth:admin');
    Route::get('/delete-permission/{id}', [App\Http\Controllers\PermissionController::class, 'Delete'])->name('delete-permission')->middleware('auth:admin');
    // account setting
    Route::get('/account-setting', [App\Http\Controllers\SettingController::class, 'account'])->name('account')->middleware('auth:admin');
    Route::put('/update-data-setting', [App\Http\Controllers\SettingController::class, 'UpdateData'])->name('update-data-setting')->middleware('auth:admin');
    Route::get('/delete-account', [App\Http\Controllers\SettingController::class, 'DeleteAccount'])->name('delete-account')->middleware('auth:admin');
    // Logout Route
    Route::post('/logout', [App\Http\Controllers\AdminLoginController::class, 'logout'])->name('admin.logout');
});

// Route::get('/sign-in', [App\Http\Controllers\AuthController::class, 'SignIn'])->name('sign-in');
// Route::post('/sign-out', [App\Http\Controllers\AuthController::class, 'signOut'])->name('sign-out');
// Route::get('/dashboad', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboad');
// accessaries type
// Route::get('/accessaries', [App\Http\Controllers\AccessaryController::class, 'Accessaries'])->name('accessaries');
// Route::get('/insert-accessaries', [App\Http\Controllers\AccessaryController::class, 'Insert'])->name('insert-accessaries');
// Route::post('/insert-data-accessaries', [App\Http\Controllers\AccessaryController::class, 'InsertData'])->name('insert-data-accessaries');
// Route::get('/edit-accessaries/{id}', [App\Http\Controllers\AccessaryController::class, 'Update'])->name('update-accessaries');
// Route::put('/edit-data-accessaries/{id}', [App\Http\Controllers\AccessaryController::class, 'DataUpdate'])->name('update-data-accessaries');
// Route::get('/delete-accessaries/{id}', [App\Http\Controllers\AccessaryController::class, 'Delete'])->name('delete-accessaries');

// product
// Route::get('/product', [App\Http\Controllers\ProductController::class, 'Product'])->name('product');
// Route::get('/insert-product', [App\Http\Controllers\ProductController::class, 'Insert'])->name('insert.product');
// Route::post('/insert-data-product', [App\Http\Controllers\ProductController::class, 'InsertData'])->name('insert-data-product');
// Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'Update'])->name('update.product');
// Route::put('/edit-data-product/{id}', [App\Http\Controllers\ProductController::class, 'DataUpdate'])->name('edit-data-product');
// Route::get('/delete-product/{id}', [App\Http\Controllers\ProductController::class, 'Delete'])->name('delete-product');


