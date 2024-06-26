<?php

use App\Http\Controllers\Admin\AccountSettingController;
use App\Http\Controllers\Admin\AddStockController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetCurrency;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManagement\UserController;
use App\Http\Controllers\Admin\UserManagement\RoleController;
use App\Http\Controllers\Admin\UserManagement\PermissionController;
use App\Http\Controllers\Admin\UserManagement\PermissionGroupController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ProductSMLShareController;
use App\Http\Controllers\Admin\MetaTypeController;
use App\Http\Controllers\Admin\MetaKeyController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSpecificationKeyController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\StockOutController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ProductShowCaseController;
use App\Http\Controllers\Admin\ShowCaseProductController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\SocialMediaLinkController;
use App\Http\Controllers\Admin\FooterLinkController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginRegisterController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//   return view('welcome');
// });

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Clear Config cache:
Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return '<h1>Storage linked</h1>';
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

//Admin 
Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::post('/admin-login-validate', [AdminLoginController::class, 'adminLogin'])->name('adminlogin.validate');
Route::get('logout-admin', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('myaccount', [HomeController::class, 'myaccount'])->name('myaccount');

//User 
Route::get('user', [UserController::class, 'index'])->name('users.index');
Route::get('user/data', [UserController::class, 'indexData'])->name('users.data');
Route::get('user-create', [UserController::class, 'create'])->name('users.create');
Route::post('user-store', [UserController::class, 'store'])->name('users.store');
Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('user-update/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('user-delete/{id}', [UserController::class, 'delete'])->name('users.delete');


//accountsetting

Route::get('account', [AccountSettingController::class, 'index'])->name('accountsetting.index');
Route::get('profile/edit', [AccountSettingController::class, 'edit'])->name('accountsetting.profile');
Route::post('/admin-profile/update', [AccountSettingController::class, 'adminupdate'])->name('adminprofile.update');
Route::post('/adminchange-password', [AccountSettingController::class, 'AdminchangePassword'])->name('adminaccount.changepassword');


//Role
Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('role/data', [RoleController::class, 'indexData'])->name('roles.data');
Route::get('role-create', [RoleController::class, 'create'])->name('roles.create');
Route::post('role-store', [RoleController::class, 'store'])->name('roles.store');
Route::get('role-edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::post('role-update/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::get('role-delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');

// permission 
Route::get('permission-list', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('permission/data', [PermissionController::class, 'indexData'])->name('permissions.data');
Route::get('permission-create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('permission-store', [PermissionController::class, 'store'])->name('permissions.store');
Route::post('permission-storepermission/{id}', [PermissionController::class, 'storePermission'])->name('permissions.storepermission');
Route::get('permission-edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::post('permission-update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
Route::get('permission-delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');

//permission Group
Route::get('permission_group-list', [PermissionGroupController::class, 'index'])->name('permission_groups.index');
Route::get('permission_group/data', [PermissionGroupController::class, 'indexData'])->name('permission_groups.data');
Route::get('permission_group-create', [PermissionGroupController::class, 'create'])->name('permission_groups.create');
Route::post('permission_group-store', [PermissionGroupController::class, 'store'])->name('permission_groups.store');
Route::get('permission_group-edit/{id}', [PermissionGroupController::class, 'edit'])->name('permission_groups.edit');
Route::post('permission_group-update/{id}', [PermissionGroupController::class, 'update'])->name('permission_groups.update');
Route::get('permission_group-delete/{id}', [PermissionGroupController::class, 'delete'])->name('permission_groups.delete');

//Setting
Route::get('setting-list', [SettingController::class, 'index'])->name('settings.index');
Route::put('setting-general', [SettingController::class, 'general'])->name('settings.general');
Route::put('setting-contact', [SettingController::class, 'contact'])->name('settings.contact');
Route::put('setting-theme', [SettingController::class, 'theme'])->name('settings.theme');
Route::put('setting-other', [SettingController::class, 'other'])->name('settings.other');
Route::put('setting-email', [SettingController::class, 'emailconfigure'])->name('settings.email');

//Contact Message 
Route::get('contact_message-list', [ContactMessageController::class, 'index'])->name('contact_messages.index');
Route::get('contact_message/data', [ContactMessageController::class, 'indexData'])->name('contact_messages.data');
Route::get('contact_message-create', [ContactMessageController::class, 'create'])->name('contact_messages.create');
Route::post('contact_message-store', [ContactMessageController::class, 'store'])->name('contact_messages.store');
Route::get('contact_message-edit/{id}', [ContactMessageController::class, 'edit'])->name('contact_messages.edit');
Route::post('contact_message-update/{id}', [ContactMessageController::class, 'update'])->name('contact_messages.update');
Route::get('contact_message-delete/{id}', [ContactMessageController::class, 'delete'])->name('contact_messages.delete');
Route::get('contact_message_read_one/{id}', [ContactMessageController::class, 'read_one'])->name('contact_messages.read.one');
Route::post('contact_message_read_all', [ContactMessageController::class, 'read_all'])->name('contact_messages.read.all');

//Meta Type
Route::get('meta_type-list', [MetaTypeController::class, 'index'])->name('meta_types.index');
Route::get('meta_type/data', [MetaTypeController::class, 'indexData'])->name('meta_types.data');
Route::get('meta_type-create', [MetaTypeController::class, 'create'])->name('meta_types.create');
Route::post('meta_type-store', [MetaTypeController::class, 'store'])->name('meta_types.store');
Route::get('meta_type-edit/{id}', [MetaTypeController::class, 'edit'])->name('meta_types.edit');
Route::post('meta_type-update/{id}', [MetaTypeController::class, 'update'])->name('meta_types.update');
Route::get('meta_type-delete/{id}', [MetaTypeController::class, 'delete'])->name('meta_types.delete');

//Meta Key
Route::get('meta_key-list', [MetaKeyController::class, 'index'])->name('meta_keys.index');
Route::get('meta_key/data', [MetaKeyController::class, 'indexData'])->name('meta_keys.data');
Route::get('meta_key-create', [MetaKeyController::class, 'create'])->name('meta_keys.create');
Route::post('meta_key-store', [MetaKeyController::class, 'store'])->name('meta_keys.store');
Route::get('meta_key-edit/{id}', [MetaKeyController::class, 'edit'])->name('meta_keys.edit');
Route::post('meta_key-update/{id}', [MetaKeyController::class, 'update'])->name('meta_keys.update');
Route::get('meta_key-delete/{id}', [MetaKeyController::class, 'delete'])->name('meta_keys.delete');

//Blog Tag
Route::get('blog_tag-list', [BlogTagController::class, 'index'])->name('blog_tags.index');
Route::get('blog_tag/data', [BlogTagController::class, 'indexData'])->name('blog_tags.data');
Route::get('blog_tag-create', [BlogTagController::class, 'create'])->name('blog_tags.create');
Route::post('blog_tag-store', [BlogTagController::class, 'store'])->name('blog_tags.store');
Route::get('blog_tag-edit/{id}', [BlogTagController::class, 'edit'])->name('blog_tags.edit');
Route::post('blog_tag-update/{id}', [BlogTagController::class, 'update'])->name('blog_tags.update');
Route::get('blog_tag-delete/{id}', [BlogTagController::class, 'delete'])->name('blog_tags.delete');

//Blog Category
Route::get('blog_category-list', [BlogCategoryController::class, 'index'])->name('blog_categories.index');
Route::get('blog_category/data', [BlogCategoryController::class, 'indexData'])->name('blog_categories.data');
Route::get('blog_category-create', [BlogCategoryController::class, 'create'])->name('blog_categories.create');
Route::post('blog_category-store', [BlogCategoryController::class, 'store'])->name('blog_categories.store');
Route::get('blog_category-edit/{id}', [BlogCategoryController::class, 'edit'])->name('blog_categories.edit');
Route::post('blog_category-update/{id}', [BlogCategoryController::class, 'update'])->name('blog_categories.update');
Route::get('blog_category-delete/{id}', [BlogCategoryController::class, 'delete'])->name('blog_categories.delete');

//Blog Post
Route::get('blog_post-list', [BlogPostController::class, 'index'])->name('blog_posts.index');
Route::get('blog_post/data', [BlogPostController::class, 'indexData'])->name('blog_posts.data');
Route::get('blog_post-create', [BlogPostController::class, 'create'])->name('blog_posts.create');
Route::post('blog_post-store', [BlogPostController::class, 'store'])->name('blog_posts.store');
Route::get('blog_post-edit/{id}', [BlogPostController::class, 'edit'])->name('blog_posts.edit');
Route::post('blog_post-update/{id}', [BlogPostController::class, 'update'])->name('blog_posts.update');
Route::get('blog_post-delete/{id}', [BlogPostController::class, 'delete'])->name('blog_posts.delete');
Route::get('/meta-keys/{metaTypeId}', [BlogPostController::class, 'getMetaKeys']);


//Blog Comment
Route::get('blog_comment-list', [BlogCommentController::class, 'index'])->name('blog_comments.index');
Route::get('blog_comment/data', [BlogCommentController::class, 'indexData'])->name('blog_comments.data');

//Category
Route::get('category', [CategoryController::class, 'index'])->name('category.index');
Route::get('category/data', [CategoryController::class, 'indexData'])->name('category.data');
Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::PUT('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');


//subcategory
Route::get('subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
Route::get('subcategory/data', [SubCategoryController::class, 'indexData'])->name('subcategory.data');
Route::get('subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
Route::post('subcategory/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
Route::get('subcategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
Route::PUT('subcategory/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
Route::get('subcategory/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');

//childcategory
Route::get('childcategory', [ChildCategoryController::class, 'index'])->name('childcategory.index');
Route::get('childcategory/data', [ChildCategoryController::class, 'indexData'])->name('childcategory.data');
Route::get('childcategory/create', [ChildCategoryController::class, 'create'])->name('childcategory.create');
Route::post('childcategory/store', [ChildCategoryController::class, 'store'])->name('childcategory.store');
Route::get('/subcategories/{categoryId}', [ChildCategoryController::class, 'getSubcategories']);
Route::get('childcategory/edit/{id}', [ChildCategoryController::class, 'edit'])->name('childcategory.edit');
Route::PUT('childcategory/update/{id}', [ChildCategoryController::class, 'update'])->name('childcategory.update');
Route::get('childcategory/delete/{id}', [ChildCategoryController::class, 'delete'])->name('childcategory.delete');

//brand
Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('brand/data', [BrandController::class, 'indexData'])->name('brand.data');
Route::get('brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
Route::PUT('brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
Route::get('brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

//\
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/categories/{categoryId}/subcategories', [ProductController::class, 'getSubcategories']);
Route::get('/subcategories/{subcategoryId}/childcategories', [ProductController::class, 'getChildcategories']);
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('product/data', [ProductController::class, 'indexData'])->name('product.data');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');

Route::PUT('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/meta-keys/{metaTypeId}', [ProductController::class, 'getMetaKeys']);





//productspecificationkey
Route::get('productspecificationkey', [ProductSpecificationKeyController::class, 'index'])->name('productspecificationkey.index');
Route::get('productspecificationkey/data', [ProductSpecificationKeyController::class, 'indexData'])->name('productspecificationkey.data');
Route::get('productspecificationkey/create', [ProductSpecificationKeyController::class, 'create'])->name('productspecificationkey.create');
Route::post('productspecificationkey/store', [ProductSpecificationKeyController::class, 'store'])->name('productspecificationkey.store');
Route::get('productspecificationkey/edit/{id}', [ProductSpecificationKeyController::class, 'edit'])->name('productspecificationkey.edit');
Route::PUT('productspecificationkey/update/{id}', [ProductSpecificationKeyController::class, 'update'])->name('productspecificationkey.update');
Route::get('productspecificationkey/delete/{id}', [ProductSpecificationKeyController::class, 'delete'])->name('productspecificationkey.delete');

//inventory

Route::get('inventory/index', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('inventory/data', [InventoryController::class, 'indexData'])->name('inventory.data');

//Add stock
Route::get('/stock/index/{product}', [AddStockController::class, 'show'])->name('stock.show');
Route::get('stock/data/{product}', [AddStockController::class, 'indexData'])->name('stock.data');

Route::post('stock/store', [AddStockController::class, 'store'])->name('stock.store');


//Country
Route::get('country-list', [CountryController::class, 'index'])->name('countries.index');
Route::get('country/data', [CountryController::class, 'indexData'])->name('countries.data');
Route::get('country-create', [CountryController::class, 'create'])->name('countries.create');
Route::post('country-store', [CountryController::class, 'store'])->name('countries.store');
Route::get('country-edit/{id}', [CountryController::class, 'edit'])->name('countries.edit');
Route::post('country-update/{id}', [CountryController::class, 'update'])->name('countries.update');
Route::get('country-delete/{id}', [CountryController::class, 'delete'])->name('countries.delete');

//State
Route::get('state-list', [StateController::class, 'index'])->name('states.index');
Route::get('state/data', [StateController::class, 'indexData'])->name('states.data');
Route::get('state-create', [StateController::class, 'create'])->name('states.create');
Route::post('state-store', [StateController::class, 'store'])->name('states.store');
Route::get('state-edit/{id}', [StateController::class, 'edit'])->name('states.edit');
Route::post('state-update/{id}', [StateController::class, 'update'])->name('states.update');
Route::get('state-delete/{id}', [StateController::class, 'delete'])->name('states.delete');

//City
Route::get('city-list', [CityController::class, 'index'])->name('cities.index');
Route::get('city/data', [CityController::class, 'indexData'])->name('cities.data');
Route::get('city-create', [CityController::class, 'create'])->name('cities.create');
Route::post('city-store', [CityController::class, 'store'])->name('cities.store');
Route::get('city-edit/{id}', [CityController::class, 'edit'])->name('cities.edit');
Route::post('city-update/{id}', [CityController::class, 'update'])->name('cities.update');
Route::get('city-delete/{id}', [CityController::class, 'delete'])->name('cities.delete');

//Currency 
Route::get('currency-list', [CurrencyController::class, 'index'])->name('currencies.index');
Route::get('currency/data', [CurrencyController::class, 'indexData'])->name('currencies.data');
Route::get('currency-create', [CurrencyController::class, 'create'])->name('currencies.create');
Route::post('currency-store', [CurrencyController::class, 'store'])->name('currencies.store');
Route::get('currency-edit/{id}', [CurrencyController::class, 'edit'])->name('currencies.edit');
Route::post('currency-update/{id}', [CurrencyController::class, 'update'])->name('currencies.update');
Route::get('currency-delete/{id}', [CurrencyController::class, 'delete'])->name('currencies.delete');


//Shipping
Route::get('shipping-list', [ShippingController::class, 'index'])->name('shippings.index');
Route::get('shipping/data', [ShippingController::class, 'indexData'])->name('shippings.data');
Route::get('shipping-create', [ShippingController::class, 'create'])->name('shippings.create');
Route::post('shipping-store', [ShippingController::class, 'store'])->name('shippings.store');
Route::get('shipping-edit/{id}', [ShippingController::class, 'edit'])->name('shippings.edit');
Route::post('shipping-update/{id}', [ShippingController::class, 'update'])->name('shippings.update');
Route::get('shipping-delete/{id}', [ShippingController::class, 'delete'])->name('shippings.delete');

//Payment Method
Route::get('payment_method-list', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
Route::put('payment_method-stripe', [PaymentMethodController::class, 'stripe'])->name('payment_methods.stripe');
Route::put('payment_method-razorpay', [PaymentMethodController::class, 'razorpay'])->name('payment_methods.razorpay');

//Coupon
Route::get('coupon-list', [CouponController::class, 'index'])->name('coupons.index');
Route::get('coupon/data', [CouponController::class, 'indexData'])->name('coupons.data');
Route::get('coupon-create', [CouponController::class, 'create'])->name('coupons.create');
Route::post('coupon-store', [CouponController::class, 'store'])->name('coupons.store');
Route::get('coupon-edit/{id}', [CouponController::class, 'edit'])->name('coupons.edit');
Route::post('coupon-update/{id}', [CouponController::class, 'update'])->name('coupons.update');
Route::get('coupon-delete/{id}', [CouponController::class, 'delete'])->name('coupons.delete');

//Product show case
Route::get('product_show_case-list', [ProductShowCaseController::class, 'index'])->name('product_show_cases.index');
Route::get('product_show_case/data', [ProductShowCaseController::class, 'indexData'])->name('product_show_cases.data');
Route::get('product_show_case-create', [ProductShowCaseController::class, 'create'])->name('product_show_cases.create');
Route::post('product_show_case-store', [ProductShowCaseController::class, 'store'])->name('product_show_cases.store');
Route::get('product_show_case-edit/{id}', [ProductShowCaseController::class, 'edit'])->name('product_show_cases.edit');
Route::post('product_show_case-update/{id}', [ProductShowCaseController::class, 'update'])->name('product_show_cases.update');
Route::get('product_show_case-delete/{id}', [ProductShowCaseController::class, 'delete'])->name('product_show_cases.delete');


//Show case product
Route::get('show_case_product-list', [ShowCaseProductController::class, 'index'])->name('show_case_products.index');
Route::get('show_case_product/data', [ShowCaseProductController::class, 'indexData'])->name('show_case_products.data');
Route::get('show_case_product-create', [ShowCaseProductController::class, 'create'])->name('show_case_products.create');
Route::post('show_case_product-store', [ShowCaseProductController::class, 'store'])->name('show_case_products.store');
Route::get('show_case_product-edit/{id}', [ShowCaseProductController::class, 'edit'])->name('show_case_products.edit');
Route::post('show_case_product-update/{id}', [ShowCaseProductController::class, 'update'])->name('show_case_products.update');
Route::get('show_case_product-delete/{id}', [ShowCaseProductController::class, 'delete'])->name('show_case_products.delete');


//Footer
Route::get('footer-list', [FooterController::class, 'index'])->name('footers.index');
Route::get('footer/data', [FooterController::class, 'indexData'])->name('footers.data');
Route::get('footer-create', [FooterController::class, 'create'])->name('footers.create');
Route::post('footer-store', [FooterController::class, 'store'])->name('footers.store');
Route::get('footer-edit/{id}', [FooterController::class, 'edit'])->name('footers.edit');
Route::post('footer-update/{id}', [FooterController::class, 'update'])->name('footers.update');
Route::get('footer-delete/{id}', [FooterController::class, 'delete'])->name('footers.delete');

//Footer social Media Links
Route::get('social_media_link-list', [SocialMediaLinkController::class, 'index'])->name('social_media_links.index');
Route::get('social_media_link/data', [SocialMediaLinkController::class, 'indexData'])->name('social_media_links.data');
Route::get('social_media_link-create', [SocialMediaLinkController::class, 'create'])->name('social_media_links.create');
Route::post('social_media_link-store', [SocialMediaLinkController::class, 'store'])->name('social_media_links.store');
Route::get('social_media_link-edit/{id}', [SocialMediaLinkController::class, 'edit'])->name('social_media_links.edit');
Route::post('social_media_link-update/{id}', [SocialMediaLinkController::class, 'update'])->name('social_media_links.update');
Route::get('social_media_link-delete/{id}', [SocialMediaLinkController::class, 'delete'])->name('social_media_links.delete');


//Footer Link
Route::get('footer_link-list', [FooterLinkController::class, 'firstColumnIndex'])->name('footer_links.index');
Route::get('footer_link/data', [FooterLinkController::class, 'firstColumnIndexData'])->name('footer_links.data');
Route::get('footer_link-create', [FooterLinkController::class, 'firstColumnCreate'])->name('footer_links.create');
Route::post('footer_link-store', [FooterLinkController::class, 'firstColumnStore'])->name('footer_links.store');
Route::get('footer_link-edit/{id}', [FooterLinkController::class, 'firstColumnEdit'])->name('footer_links.edit');
Route::post('footer_link-update/{id}', [FooterLinkController::class, 'firstColumnUpdate'])->name('footer_links.update');
Route::get('footer_link-delete/{id}', [FooterLinkController::class, 'firstColumnDelete'])->name('footer_links.delete');
//Second Column Link
Route::get('second_column-list', [FooterLinkController::class, 'secondColumnIndex'])->name('second_columns.index');
Route::get('second_column/data', [FooterLinkController::class, 'secondColumnIndexData'])->name('second_columns.data');
Route::get('second_column-create', [FooterLinkController::class, 'secondColumnCreate'])->name('second_columns.create');
Route::post('second_column-store', [FooterLinkController::class, 'secondColumnStore'])->name('second_columns.store');
Route::get('second_column-edit/{id}', [FooterLinkController::class, 'secondColumnEdit'])->name('second_columns.edit');
Route::post('second_column-update/{id}', [FooterLinkController::class, 'secondColumnUpdate'])->name('second_columns.update');
Route::get('second_column-delete/{id}', [FooterLinkController::class, 'secondColumnDelete'])->name('second_columns.delete');
//Third Column Link
Route::get('third_column-list', [FooterLinkController::class, 'thirdColumnIndex'])->name('third_columns.index');
Route::get('third_column/data', [FooterLinkController::class, 'thirdColumnIndexData'])->name('third_columns.data');
Route::get('third_column-create', [FooterLinkController::class, 'thirdColumnCreate'])->name('third_columns.create');
Route::post('third_column-store', [FooterLinkController::class, 'thirdColumnStore'])->name('third_columns.store');
Route::get('third_column-edit/{id}', [FooterLinkController::class, 'thirdColumnEdit'])->name('third_columns.edit');
Route::post('third_column-update/{id}', [FooterLinkController::class, 'thirdColumnUpdate'])->name('third_columns.update');
Route::get('third_column-delete/{id}', [FooterLinkController::class, 'thirdColumnDelete'])->name('third_columns.delete');



//Productsmlshare
Route::get('product_sml_share', [ProductSMLShareController::class, 'index'])->name('product_sml_shares.index');
Route::get('product_sml_share/data', [ProductSMLShareController::class, 'indexData'])->name('product_sml_shares.data');
Route::get('product_sml_share/create', [ProductSMLShareController::class, 'create'])->name('product_sml_shares.create');
Route::post('product_sml_share/store', [ProductSMLShareController::class, 'store'])->name('product_sml_shares.store');
Route::get('product_sml_share/edit/{id}', [ProductSMLShareController::class, 'edit'])->name('product_sml_shares.edit');
Route::post('product_sml_share/update/{id}', [ProductSMLShareController::class, 'update'])->name('product_sml_shares.update');
Route::get('product_sml_share/delete/{id}', [ProductSMLShareController::class, 'delete'])->name('product_sml_shares.delete');

//Order 

Route::get('order-all', [OrderController::class, 'all'])->name('orders.all');
Route::get('/orders/{id}', [OrderController::class, 'getOrder']);
Route::post('order-update', [OrderController::class, 'update'])->name('orders.update');
Route::get('order-edit/{id}', [CouponController::class, 'edit'])->name('order.edit');
Route::get('order/data', [OrderController::class, 'indexData'])->name('orders.data');
Route::get('order/pending_data', [OrderController::class, 'pendingData'])->name('orders.pending_data');
Route::get('order/progress_data', [OrderController::class, 'progressData'])->name('orders.progress_data');
Route::get('order/delivered_data', [OrderController::class, 'deliveredData'])->name('orders.delivered_data');
Route::get('order/completed_data', [OrderController::class, 'completedData'])->name('orders.completed_data');
Route::get('order/declined_data', [OrderController::class, 'declinedData'])->name('orders.declined_data');
Route::get('order/cash_data', [OrderController::class, 'cashData'])->name('orders.cash_data');
Route::get('order-pending', [OrderController::class, 'pending'])->name('orders.pending');
Route::get('order-progress', [OrderController::class, 'progress'])->name('orders.progress');
Route::get('order-delivered', [OrderController::class, 'delivered'])->name('orders.delivered');
Route::get('order-completed', [OrderController::class, 'completed'])->name('orders.completed');
Route::get('order-declined', [OrderController::class, 'declined'])->name('orders.declined');
Route::get('order-cash_on_delivery', [OrderController::class, 'cashONDelivery'])->name('orders.cashONDelivery');
Route::get('order-show/{id}', [OrderController::class, 'show'])->name('orders.show');

//Frontend

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('shop', [HomeController::class, 'shop'])->name('shop');


Route::get('/shop/filter',  [HomeController::class, 'filter'])->name('shop.filter');
Route::get('/products/filter', [HomeController::class, 'filterByPrice'])->name('products.filter');
Route::get('/shop/category/{id}', [HomeController::class, 'filterByCategory'])->name('shop.category');
Route::get('/filter', [HomeController::class, 'filterBySpecifications'])->name('filter.bySpecifications');

Route::get('product/{id}', [HomeController::class, 'singleProduct'])->name('single.product');
Route::get('wishlist', [HomeController::class, 'wishlist'])->name('wishlist');
Route::post('/wishlist/add-to-cart', [HomeController::class, 'addToCart'])->name('wishlist.addToCart');
Route::get('wishlist/remove/{id}', [HomeController::class, 'wishlistDelete'])->name('wishlist.remove');
Route::post('/add-to-wishlist', [HomeController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('cart', [HomeController::class, 'cart'])->name('cart');
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::put('/update-address', [HomeController::class, 'update'])->name('update.address');

Route::post('/user/coupons', [HomeController::class, 'applyCouponCode'])->name('coupons.apply');
Route::post('/set-country', [HomeController::class, 'setCountry'])->name('setCountry');


Route::post('/buy-now/{productId}', [HomeController::class, 'buyNow'])->name('buy.now');

Route::post('/user-profile/update', [HomeController::class, 'userupdate'])->name('profile.update');
//change password
// routes/web.php or routes/api.php
Route::post('/change-password', [HomeController::class, 'changePassword'])->name('account.changepassword');


// cart
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');


Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');

Route::post('remove-from-cart/{id}', [CartController::class, 'removeCart'])->name('remove.from.cart');


Route::get('stock/delete/{id}', [AddStockController::class, 'delete'])->name('stock.delete');

//out of stock
Route::get('out-of-stock', [StockOutController::class, 'outOfStock'])->name('products.outOfStock');
Route::get('out-of-stock/data', [StockOutController::class, 'outOfStockData'])->name('products.outOfStockData');

//product review

Route::get('review', [ReviewController::class, 'index'])->name('review.index');

Route::get('review/data', [ReviewController::class, 'indexData'])->name('review.data');

Route::post('/product_reviews/update', [ReviewController::class,'updateStatus'])->name('review.update');



//product report

Route::get('report', [ReportController::class, 'index'])->name('report.index');

Route::get('report/data', [ReportController::class, 'indexData'])->name('report.data');

//contact

Route::post('contact/store', [HomeController::class, 'contactstore'])->name('contact.store');


//loginregister for normal user

Route::get('normaluser/register', [LoginRegisterController::class, 'register'])->name('normaluser.register');

Route::post('normaluser/store', [LoginRegisterController::class, 'store'])->name('normaluser.store');
Route::post('normaluser/login', [LoginRegisterController::class, 'userLogin'])->name('normaluser.login');

//forgotpassword
Route::get('normaluser/forgot', [LoginRegisterController::class, 'forgotpassword'])->name('forgot');

Route::post('forget-password', [LoginRegisterController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [LoginRegisterController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [LoginRegisterController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('user-logout', [LoginRegisterController::class, 'logout'])->name('user.logout');

//checout
Route::post('placeorder', [CheckOutController::class, 'placeOrder'])->name('placeorder');
Route::get('add-shipping-address', [CheckOutController::class, 'add'])->name('add.shipping.address');
Route::post('store-shipping-address', [CheckOutController::class, 'store'])->name('store.shipping.address');
Route::get('edit-shipping-address/{id}', [CheckOutController::class, 'edit'])->name('edit.shipping.address');
Route::post('update-shipping-address/{id}', [CheckOutController::class, 'update'])->name('update.shipping.address');
Route::get('remove-shipping-address/{id}', [CheckOutController::class, 'delete'])->name('remove.shipping.address');

Route::post('review/store', [ReviewController::class, 'store'])->name('reviews.store');

//subscriber

Route::get('subscriber/index', [SubscriberController::class, 'index'])->name('subscriber.index');

Route::get('subscriber/data', [SubscriberController::class, 'indexData'])->name('subscriber.data');
Route::post('subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');

//newsletter

Route::post('storeNewsletter', [SubscriberController::class, 'storeNewsletter'])->name('newsletter.store');

//contactinfopage

Route::get('contactpage/index', [ContactPageController::class, 'index'])->name('contactpage.index');


Route::PUT('contactpage/store', [ContactPageController::class, 'store'])->name('contactpage.store');

//terms and condition

Route::get('terms/index', [TermsAndConditionController::class, 'index'])->name('terms.index');

Route::put('terms/store', [TermsAndConditionController::class, 'store'])->name('terms.store');


Route::get('privacypolicy/index', [PrivacyPolicyController::class, 'index'])->name('privacypolicy.index');

Route::put('privacypolicy/store', [PrivacyPolicyController::class, 'store'])->name('privacypolicy.store');

//faq

Route::get('faq/index', [FaqController::class, 'index'])->name('faq.index');
Route::get('faq/create', [FaqController::class, 'create'])->name('faq.create');
Route::get('faq/indexData', [FaqController::class, 'indexData'])->name('faq.data');
Route::post('faq/store', [FaqController::class, 'store'])->name('faq.store');
Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
Route::PUT('/faq/update/{id}', [FaqController::class, 'update'])->name('faq.update');
Route::get('/faq/delete/{id}', [FaqController::class, 'delete'])->name('faq.delete');
