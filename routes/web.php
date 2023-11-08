<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


require __DIR__ . '/auth.php';

Route::get('/', [IndexController::class, 'Index'])->name('home');

// Login Admin
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

// Login Vendor
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);

// Become Vendor
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');

// Register Vendor
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');

// Back-end
// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Dashboard
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/profile',  'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/update',  'AdminProfileUpdate')->name('admin.profile.update');
        Route::get('/admin/change/password',  'AdminChangePassword')->name('admin.change.password');
        Route::post('/admin/update/password',  'AdminUpdatePassword')->name('admin.update.password');
        Route::get('/admin/logout',  'AdminDestroy')->name('admin.logout');


        // Vendor Routes
        Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')->name('inactive.vendor.details');
        Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');
        Route::post('/inactive/vendor/approve', 'InActiveVendorApprove')->name('inactive.vendor.approve');
    });

    // Backend Admin
    // Brand Routes
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/update/brand', 'UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });

    // Category Routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    // SubCategory Routes
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubcategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubcategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubcategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'UpdateSubcategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubcategory')->name('delete.subcategory');
    });

    // Product Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::post('/update/product/main-image-thumbnail', 'UpdateProductMainImageThumbnail')->name('update.product.main_image_thumbnail');
        Route::post('/update/product/multi_image', 'UpdateProductMultiImage')->name('update.product.multi_image');
        Route::get('/delete/product/multi_image/{id}', 'DeleteProductMultiImage')->name('delete.product.multi_image');

        Route::get('/add/product/multi_image/{id}', 'AddProductMultiImage')->name('add.product.multi_image');
        Route::post('/store/product/multi_image', 'StoreProductMultiImage')->name('store.product.multi_image');


        Route::get('/inactive/product/{id}', 'InActiveProduct')->name('inactive.product');
        Route::get('/active/product/{id}', 'ActiveProduct')->name('active.product');


        Route::get('/subcategory/ajax/{category_id}', 'GetSubcategory');

        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');

        // Stock Product
        Route::get('admin/stock/product', 'AdminStockProduct')->name('admin.stock.product');

        // Out stock Product
        Route::get('admin/out-stock/product', 'AdminOutStockProduct')->name('admin.out_stock.product');
    });

    // Slider Routes
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    // Banner Routes
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    // Coupon Routes
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon', 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
    });

    // Shipping Area Routes
    Route::controller(ShippingAreaController::class)->group(function () {
        // Ship Division Routes
        Route::get('/all/division', 'AllDivision')->name('all.division');
        Route::get('/add/division', 'AddDivision')->name('add.division');
        Route::post('/store/division', 'StoreDivision')->name('store.division');
        Route::get('/edit/division/{id}', 'EditDivision')->name('edit.division');
        Route::post('/update/division', 'UpdateDivision')->name('update.division');
        Route::get('/delete/division/{id}', 'DeleteDivision')->name('delete.division');


        // Ship District Routes
        Route::get('/all/district', 'AllDistrict')->name('all.district');
        Route::get('/add/district', 'AddDistrict')->name('add.district');
        Route::post('/store/district', 'StoreDistrict')->name('store.district');
        Route::get('/edit/district/{id}', 'EditDistrict')->name('edit.district');
        Route::post('/update/district', 'UpdateDistrict')->name('update.district');
        Route::get('/delete/district/{id}', 'DeleteDistrict')->name('delete.district');


        // Ship State Routes
        Route::get('/all/state', 'AllState')->name('all.state');
        Route::get('/add/state', 'AddState')->name('add.state');
        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state');

        Route::get('/district/ajax/{division_id}', 'GetDistrict');
    });

    // Order Routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending/order', 'AdminPendingOrder')->name('admin.pending.order');
        Route::get('/admin/confirmed/order', 'AdminConfirmedOrder')->name('admin.confirmed.order');
        Route::get('/admin/processing/order', 'AdminProcessingOrder')->name('admin.processing.order');
        Route::get('/admin/delivered/order', 'AdminDeliveredOrder')->name('admin.delivered.order');
        Route::get('/admin/order-details/{order_id}', 'AdminOrderDetails')->name('admin.order.details');

        // Change status order
        Route::get('/admin/pending-to-confirmed-order/{order_id}', 'AdminPendingToConfirmedOrder')->name('admin.pending-to-confirmed-order');
        Route::get('/admin/confirmed-to-processing-order/{order_id}', 'AdminConfirmedToProcessingOrder')->name('admin.confirmed-to-processing-order');
        Route::get('/admin/processing-to-delivered-order/{order_id}', 'AdminProcessingToDeliveredOrder')->name('admin.processing-to-delivered-order');

        // Invoice download PDF
        Route::get('/admin/invoice/download/{order_id}', 'AdminInvoiceDownload')->name('admin.invoice.download');

        // Return Orders
        Route::get('/admin/return-request-orders', 'AdminReturnRequestOrders')->name('admin.return.request.orders');
        Route::get('/admin/approve-return-request-order/{order_id}', 'AdminApproveReturnRequestOrder')->name('admin.approve.return.request.order');
        Route::get('/admin/complete-return-request-order', 'AdminCompleteReturnRequestOrders')->name('admin.complete.return.request.order');
    });

    // Report Routes
    Route::controller(ReportController::class)->group(function () {
        Route::get('admin/report/view', 'ReportView')->name('admin.report.view');
        Route::post('admin/search-by-date', 'SearchByDate')->name('admin.search-by-date');
        Route::post('admin/search-by-month', 'SearchByMonth')->name('admin.search-by-month');
        Route::post('admin/search-by-year', 'SearchByYear')->name('admin.search-by-year');

        Route::get('admin/report-order-by-user', 'ReportOrderByUser')->name('admin.order-by-user');
        Route::post('admin/search-by-user', 'SearchByUser')->name('admin.search-by-user');
    });

    // Account Routes
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('admin/all-user', 'AdminAllUser')->name('admin.all.user');
        Route::get('admin/all-vendor', 'AdminAllVendor')->name('admin.all.vendor');
    });

    // Blog Category Routes
    Route::controller(BlogController::class)->group(function () {
        // Blog Category Routes
        Route::get('/admin/all/blog/category', 'AllBlogCategory')->name('admin.all.blog.category');
        Route::get('/admin/add/blog/category', 'AddBlogCategory')->name('admin.add.blog.category');
        Route::post('/admin/store/blog/category', 'StoreBlogCategory')->name('admin.store.blog.category');
        Route::get('/admin/edit/blog/category/{id}', 'EditBlogCategory')->name('admin.edit.blog.category');
        Route::post('/admin/update/blog/category', 'UpdateBlogCategory')->name('admin.update.blog.category');
        Route::get('/admin/delete/blog/category{id}', 'DeleteBlogCategory')->name('admin.delete.blog.category');


        // Blog Post Routes
        Route::get('/admin/all/blog/post', 'AllBlogPost')->name('admin.all.blog.post');
        Route::get('/admin/add/blog/post', 'AddBlogPost')->name('admin.add.blog.post');
        Route::post('/admin/store/blog/post', 'StoreBlogPost')->name('admin.store.blog.post');
        Route::get('/admin/edit/blog/post/{id}', 'EditBlogPost')->name('admin.edit.blog.post');
        Route::post('/admin/update/blog/post', 'UpdateBlogPost')->name('admin.update.blog.post');
        Route::get('/admin/delete/blog/post{id}', 'DeleteBlogPost')->name('admin.delete.blog.post');
    });

    // Review Routes
    Route::controller(ReviewController::class)->group(function () {
        Route::get('admin/pending/review', 'AdminPendingReview')->name('admin.pending.review');
        Route::get('admin/approve/review/{id}', 'AdminApproveReview')->name('admin.approve.review');
        Route::get('admin/publish/review', 'AdminPublishReview')->name('admin.publish.review');
        Route::get('admin/delete/review/{id}', 'AdminDeleteReview')->name('admin.delete.review');
    });

    // Site Setting Routes
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/admin/site-setting', 'AdminSiteSetting')->name('admin.site.setting');
        Route::post('/admin/update/site-setting', 'AdminSiteSettingUpdate')->name('admin.site.setting.update');
        Route::get('/admin/seo-setting', 'AdminSeoSetting')->name('admin.seo.setting');
        Route::post('/admin/update/seo-setting', 'AdminSeoSettingUpdate')->name('admin.seo.setting.update');
    });

    // Admin Management Routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/all/admin', 'AdminAllAdmin')->name('admin.all.admin');
        Route::get('/admin/add/admin', 'AdminAddAdmin')->name('admin.add.admin');
        Route::post('/admin/store/admin', 'AdminStoreAdmin')->name('admin.store.admin');
        Route::get('/admin/edit/admin/{id}', 'AdminEditAdmin')->name('admin.edit.admin');
        Route::post('/admin/update/admin/{id}', 'AdminUpdateAdmin')->name('admin.update.admin');
        Route::get('/admin/delete/admin/{id}', 'AdminDeleteAdmin')->name('admin.delete.admin');
    });
});

// Vendor
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::controller(VendorController::class)->group(function () {
        // Vendor Dashboard
        Route::get('/vendor/dashboard', 'VendorDashboard')->name('vendor.dashboard');
        Route::get('/vendor/profile', 'VendorProfile')->name('vendor.profile');
        Route::post('/vendor/profile/update', 'VendorProfileUpdate')->name('vendor.profile.update');
        Route::get('/vendor/change/password', 'VendorChangePassword')->name('vendor.change.password');
        Route::post('/vendor/update/password', 'VendorUpdatePassword')->name('vendor.update.password');
        Route::get('/vendor/logout', 'VendorDestroy')->name('vendor.logout');
    });

    // Backend Vendor Management
    // Vendor Product Routes
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');
        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/main-image-thumbnail', 'VendorUpdateProductMainImageThumbnail')->name('vendor.update.product.main_image_thumbnail');
        Route::post('/vendor/update/product/multi_image', 'VendorUpdateProductMultiImage')->name('vendor.update.product.multi_image');
        Route::get('/vendor/delete/product/multi_image/{id}', 'VendorDeleteProductMultiImage')->name('vendor.delete.product.multi_image');
        Route::get('/vendor/add/product/multi_image/{id}', 'VendorAddProductMultiImage')->name('vendor.add.product.multi_image');
        Route::post('/vendor/store/product/multi_image', 'VendorStoreProductMultiImage')->name('vendor.store.product.multi_image');
        Route::get('/vendor/inactive/product/{id}', 'VendorInActiveProduct')->name('vendor.inactive.product');
        Route::get('/vendor/active/product/{id}', 'VendorActiveProduct')->name('vendor.active.product');
        Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubcategory');
        Route::get('/vendor/delete/product/{id}', 'VendorDeleteProduct')->name('vendor.delete.product');

        // Stock Product
        Route::get('vendor/stock/product/{vendor_id}', 'VendorStockProduct')->name('vendor.stock.product');

        // Out stock Product
        Route::get('vendor/out-stock/product/{vendor_id}', 'VendorOutStockProduct')->name('vendor.out_stock.product');
    });

    // Order Routes
    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('/vendor/all/order', 'VendorAllOrder')->name('vendor.all.order');
        Route::get('/vendor/order-details/{order_id}', 'VendorOrderDetails')->name('vendor.order-details');


        // Return Order
        Route::get('/vendor/return-orders', 'VendorReturnOrders')->name('vendor.return.orders');
        Route::get('/vendor/complete-return-orders', 'VendorCompleteReturnOrders')->name('vendor.complete.return.orders');
    });

    // Review Routes
    Route::controller(ReviewController::class)->group(function () {
        Route::get('vendor/all/review', 'VendorAllReview')->name('vendor.all.review');
    });
});


// Front-end
// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    // User Dashboard
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard',  'UserDashboard')->name('dashboard');
        Route::get('/user/account-details', 'UseAccount')->name('user.account.page');
        Route::get('/user/change-password', 'UserChangePassword')->name('user.change.password');
        Route::post('/user/update-password',  'UserUpdatePassword')->name('user.update.password');
        Route::post('/user/profile-update',  'UserUpdateProfile')->name('user.update.profile');
        Route::get('/user/orders',  'UserOrders')->name('user.orders.page');
        Route::get('/user/return/orders',  'UserReturnOrders')->name('user.return.orders.page');

        Route::get('/user/order-details/{order_id}',  'UserOrderDetails');
        Route::get('/user/invoice-download/{order_id}',  'UserOrderInvoiceDownload');

        Route::post('/user/return/order/{order_id}',  'UserReturnOrder')->name('user.return.order');

        Route::get('/user/track/order',  'UserTrackOrder')->name('user.track.order.page');
        Route::post('/user/check/tracking-order',  'UserCheckTrackingOrder')->name('user.check.tracking.order');

        Route::get('/user/logout',  'UserLogout')->name('user.logout');
    });


    // Wish List Routes
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishList')->name('wishlist');
        Route::get('/get-product-wishlist', 'GetProductWishList');
        Route::get('/remove-product-wishlist/{id}', 'RemoveProductWishList');
    });

    // Compare Routes
    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'AllCompare')->name('compare');
        Route::get('/get-product-compare', 'GetProductCompare');
        Route::get('/remove-product-compare/{id}', 'RemoveProductCompare');
    });

    // Checkout Routes
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/get-district/ajax/{division_id}', 'GetDistrictAjax');
        Route::get('/get-state/ajax/{district_id}', 'GetStateAjax');

        Route::post('/store/checkout', 'StoreCheckout')->name('store.checkout');
    });

    // Cash Order Routes
    Route::controller(CashController::class)->group(function () {
        Route::post('/cash/order', 'CashOrder')->name('cash.order');
    });
});

// Product Details Routes
Route::controller(IndexController::class)->group(function () {
    Route::get('/product/details/{id}/{slug}', 'ProductDetails');
    Route::get('/vendor/details/{id}', 'VendorDetails')->name('vendor.details');
    Route::get('/vendor/all', 'VendorAll')->name('vendor.all');
    Route::get('/product/category/{id}/{slug}', 'GetProductOfCategory');
    Route::get('/product/subcategory/{id}/{slug}', 'GetProductOfSubCategory');

    // Show Product View Modal With Ajax
    Route::get('/product/view/modal/{id}', 'ProductViewModalAjax');

    // Search Product Route
    Route::post('/search', 'ProductSearch')->name('product.search');
    Route::post('/search-product', 'ProductSearchAdvanced');
});

// Shop Routes
Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'ShopPage')->name('shop.page');
    Route::post('/shop/filter', 'ShopFilter')->name('shop.filter');
});

// Cart Routes
Route::controller(CartController::class)->group(function () {
    // Add Product to Cart From QuickView
    Route::post('/cart/data/store/{id}', 'QuickViewAddToCart');
    // Get Data To Mini Cart    
    Route::get('/product/mini/cart', 'GetMiniCart');
    // Delete Product In Mini Cart
    Route::get('/minicart/product/remove/{rowId}', 'RemoveProductFromMiniCart');
    // Add Product to Cart From Product Details Page
    Route::post('/details-cart/data/store/{id}', 'ProductDetailsAddToCart');

    // Show cart page
    Route::get('/cart', 'MyCart')->name('cart');
    // Display product in cart page
    Route::get('/get-product-cart', 'GetProductCart');
    // Remove Product in cart page
    Route::get('/remove-product-cart/{rowId}', 'RemoveProductCart');
    // Decrease quantity Product in cart page
    Route::get('/cart-decrement-quantity/{rowId}', 'DecrementQuantityProductCart');
    // Increment quantity Product in cart page
    Route::get('/cart-increase-quantity/{rowId}', 'IncrementQuantityProductCart');

    // Apply Coupon
    Route::post('/apply-coupon', 'ApplyCoupon');

    // Calculate Coupon (Get data after apply coupon)
    Route::get('/calculate-coupon',  'CalculateCoupon');

    // Remove Coupon
    Route::get('/remove-coupon', 'RemoveCoupon');

    // Checkout 
    Route::get('/checkout', 'CreateCheckout')->name('checkout');
});


// Review Routes
Route::controller(ReviewController::class)->group(function () {
    Route::post('/store/review', 'StoreReview')->name('store.review');
});

// Blog Routes
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'AllPost')->name('home.blog');
    Route::get('/blog/post-details/{id}/{slug}', 'DetailsPost');
    Route::get('/blog/blog-category/{id}/{slug}', 'BlogCategoryPost');
});

// Add Product to Wish List 
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);

// Add Product to Compare
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);
