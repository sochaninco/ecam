<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','HomeController@index');
Route::get('contact','HomeController@contact');
Route::get('products','HomeController@products');
Route::get('products_list_view','HomeController@products_list_view');
Route::get('all_category','HomeController@all_category');
Route::get('products/{c_id}','HomeController@product_by_category');
Route::get('products/brands/{brand_id}','HomeController@product_by_brand');
Route::get('products/cities/{city_id}','HomeController@product_by_city');
Route::get('product_detail/{p_id}','HomeController@detail');
Route::get('shop/product_detail/{p_id}','HomeController@shop_product_detail');
Route::get('search','HomeController@search');
Route::get('products/category/{subcat_id}','HomeController@product_by_subcategory');
Route::get('shop/{shop_id}/products/category/{subcat_id}','HomeController@shop_product_by_subcategory');
Route::get('footer/{FooterType}/{FooterPage}','HomeController@FooterPage');
Route::get('brand_zone','HomeController@brand_zone');
Route::get('store_zone','HomeController@seller_zone');
Route::get('beauty','HomeController@beauty');
Route::get('cloth','HomeController@cloth');
Route::get('best_seller','HomeController@best_seller');
Route::get('discount_deal','HomeController@discount_deal');
Route::get('promotion','HomeController@promotion');

//Shop function
Route::get('shop/{shop_name}','HomeController@shop_page');
Route::get('shop/{shop_name}/all','HomeController@all_product_by_shop');
Route::get('shop/{shop_name}/top_selling','HomeController@top_selling_product_by_shop');
Route::get('shop/{shop_name}/new_arrival','HomeController@new_arrival_product_by_shop');
Route::get('shop/{shop_name}/shop_contact','HomeController@shop_contact');

Route::auth();
Route::get('register-phone','Auth\RegisterController@showPhoneRegistrationForm');
Route::post('register-phone','Auth\RegisterController@register_phone');
Route::get('logout','Auth\LoginController@logout');
//ajax
Route::get('/get_category_by_shop/{shop}','ShopController@get_category_by_shop');
Route::get('/get_categoryID/{id}','ShopController@get_subcategory');
Route::get('/get_brand/{id}','ShopController@get_brand');
Route::get('/get_categoryID_to_product/{id}','AdminController@get_product');
Route::get('get_admin_product_detail_popUp/{id}','AdminController@get_product_detail_pop_up');
Route::get('/get_admin_product_image_popUp/{id}','AdminController@get_product_image_pop_up');
Route::get('/get_pos_sale_detail_popUp/{id}','AdminController@get_pos_sale_detail_pop_up');
Route::get('/home', 'HomeController@index');
Route::get('/add-to-cart/{product_id}/product_from/{from}/qty_order/{qty_order}',[
    'uses'=>'HomeController@getAddToCart',
    'as'=>'product.addToCart'
]);
Route::get('/add-to-wishList/{product_id}/product_from/{from}',
    ['uses'=>'HomeController@getWishList',
        'as'=>'product.WishList']);

Route::get('/get_product_sort_by/{selected}','HomeController@get_product_sort_by');

Route::get('delete_wishlist/{wishId}','HomeController@delete_wishlist');
Route::get('delete_thumbnail/{id}','ShopController@delete_thumbnail');
Route::get('delete_video/productId/{productId}/videoName/{videoName}','ShopController@delete_video');
Route::get('delete_feature_image/{type}/product_id/{id}','ShopController@delete_feature_image');
Route::post('{id}/shop_thumbnail/uploadFiles','ShopController@uploadThumbnails');
Route::post('{id}/user_profile/uploadFiles','UserController@uploadThumbnails');
Route::post('{id}/shop_thumbnail_edit/{product_id}/uploadFiles','ShopController@uploadThumbnails_editPage');

//Route::get('{cat_id}','HomeController@category_tab');

Route::get('get_shop_theme_info/{themeId}','AdminController@get_shop_theme');
Route::get('delete_banner_shop/{bannerName}','AdminController@delete_banner_shop');
Route::get('delete_banner_shop_small/{bannerNameSmall}','AdminController@delete_banner_shop_small');

//    Route::group(['middleware' => 'admin'], function () {
        Route::get('em-admin','AdminController@dashboard');
        Route::get('dashboard',['uses'=>'AdminController@dashboard','middleware'=>['permission:admin-area-access']]);
        Route::get('admin_shop_info',['uses'=>'AdminController@admin_shop_info','middleware'=>['permission:admin-area-access']]);
        Route::get('pos',['uses'=>'AdminController@pos','middleware'=>['permission:admin-area-access']])->name('pos');
        Route::post('pos',['uses'=>'AdminController@save_pos','middleware'=>['permission:admin-area-access']]);
        Route::get('pos_sale_list',['uses'=>'AdminController@pos_sale_list','middleware'=>['permission:admin-area-access']]);
        Route::get('pos/getProductDataByCode/','AdminController@getProductDataByCode');
        Route::get('pos/updatePosSaleTmp/','AdminController@updatePosSaleTmp');
        Route::get('pos/ajaxcategorydata','AdminController@getProductByCategory');
        Route::get('pos/ajaxsubcategorydata','AdminController@getProductBySubcategory');
        Route::get('pos/ajaxbranddata','AdminController@getProductByBrand');

        Route::get('admin_search_keyword',['uses'=>'AdminController@list_search_keyword','middleware' => ['permission:search-keyword-list|search-keyword-create|search-keyword-edit|search-keyword-delete']]);
        Route::get('add_search_keyword',['uses'=>'AdminController@add_search_keyword','middleware'=>['permission:search-keyword-create']]);
        Route::post('add_search_keyword',['uses'=>'AdminController@save_search_keyword','middleware'=>['permission:search-keyword-create']]);
        Route::get('edit_search_keyword/{keywordId}',['uses'=>'AdminController@edit_search_keyword','middleware'=>['permission:search-keyword-edit']]);
        Route::post('edit_search_keyword/{keywordId}',['uses'=>'AdminController@update_search_keyword','middleware'=>['permission:search-keyword-edit']]);
        Route::get('delete_search_keyword/{keywordId}',['uses'=>'AdminController@delete_search_keyword','middleware'=>['permission:search-keyword-delete']]);

        Route::post('admin_own_shop_edit','AdminController@admin_update_own_shop');

        Route::get('admin_product',['uses'=>'AdminController@product','middleware'=>['permission:admin-product-list|admin-product-edit']]);
        Route::get('admin_add_product',['uses'=>'AdminController@add_product','middleware'=>['permission:admin-product-edit']]);
        Route::post('admin_add_product',['uses'=>'AdminController@save_product','middleware'=>['permission:admin-product-edit']]);
        Route::get('edit_product/{id}',['uses'=>'AdminController@edit_product','middleware'=>['permission:admin-product-edit']]);
        Route::post('edit_product/{id}',['uses'=>'AdminController@update_product','middleware'=>['permission:admin-product-edit']]);


        Route::get('admin_print_label',['uses'=>'AdminController@print_label','middleware'=>['permission:admin-print-label']]);
        Route::get('admin_print_label_form',['uses'=>'AdminController@print_label_form','middleware'=>['permission:admin-print-label']]);

        Route::get('admin_promotion',['uses'=>'AdminController@admin_promotion','middleware'=>['permission:admin-promotion-list|admin-promotion-create|admin-promotion-edit|admin-promotion-delete']]);
        Route::get('admin_add_promotion',['uses'=>'AdminController@admin_add_promotion','middleware'=>['permission:admin-promotion-create']]);
        Route::post('admin_add_promotion',['uses'=>'AdminController@admin_save_promotion','middleware'=>['permission:admin-promotion-create']]);
        Route::get('edit_promotion/{id}',['uses'=>'AdminController@edit_promotion','middleware'=>['permission:admin-promotion-edit']]);
        Route::post('edit_promotion/{id}',['uses'=>'AdminController@update_promotion','middleware'=>['permission:admin-promotion-edit']]);
        Route::get('delete_promotion/{id}',['uses'=>'AdminController@delete_promotion','middleware'=>['permission:admin-promotion-delete']]);

        //packages route
        Route::get('admin_packages',['uses'=>'AdminController@packages_list','middleware'=>['permission:admin-package-list|admin-package-create|admin-package-edit']]);
        Route::get('add_package',['uses'=>'AdminController@add_package','middleware'=>['permission:admin-package-create']]);
        Route::post('add_package',['uses'=>'AdminController@save_package','middleware'=>['permission:admin-package-create']]);
        Route::get('edit_package/{packageId}',['uses'=>'AdminController@edit_package','middleware'=>['permission:admin-package-edit']]);
        Route::post('edit_package/{packageId}',['uses'=>'AdminController@update_package','middleware'=>['permission:admin-package-edit']]);

        Route::get('admin_transaction',['uses'=>'AdminController@transaction_list','middleware'=>['permission:admin-transaction-list']]);
        Route::get('transaction_approve/{tranID}',['uses'=>'AdminController@transaction_approve','middleware'=>['permission:admin-transaction-list']]);
        Route::get('transaction_delete/{tranID}',['uses'=>'AdminController@transaction_delete','middleware'=>['permission:admin-transaction-list']]);

        Route::get('admin_payment_list',['uses'=>'AdminController@payment_list','middleware'=>['permission:admin-payment-list|admin-payment-confirm|admin-payment-delete']]);
        Route::post('admin_payment_confirm/{id}',['uses'=>'AdminController@payment_update','middleware'=>['permission:admin-payment-confirm']]);
        Route::get('show_invoice/{id}',['uses'=>'AdminController@invoice_detail','middleware'=>['permission:admin-payment-list']]);
        Route::get('show_payment_method/{id}',['uses'=>'AdminController@payment_method_detail','middleware'=>['permission:admin-payment-list']]);
        Route::get('admin_payment_delete/{id}',['uses'=>'AdminController@payment_delete','middleware'=>['permission:admin-payment-delete']]);
        Route::get('admin_payment_list/{id}/print',['uses'=>'AdminController@payment_print','middleware'=>['permission:admin-payment-list']]);

        Route::get('admin_payment_method',['uses'=>'AdminController@payment_method','middleware'=>['permission:payment-method-listing|payment-method-create|payment-method-edit|payment-method-delete|payment-method-status']]);
        Route::get('add_payment_method',['uses'=>'AdminController@add_payment_method','middleware'=>['permission:payment-method-create']]);
        Route::post('add_payment_method',['uses'=>'AdminController@save_payment_method','middleware'=>['permission:payment-method-create']]);
        Route::get('edit_payment_method/{id}',['uses'=>'AdminController@edit_payment_method','middleware'=>['permission:payment-method-edit']]);
        Route::post('edit_payment_method/{id}',['uses'=>'AdminController@update_payment_method','middleware'=>['permission:payment-method-edit']]);
        Route::get('delete_payment_method/{id}',['uses'=>'AdminController@delete_payment_method','middleware'=>['permission:payment-method-delete']]);
        Route::get('disable_payment_method/{id}',['uses'=>'AdminController@status_payment_method','middleware'=>['permission:payment-method-status']]);
        Route::get('enable_payment_method/{id}',['uses'=>'AdminController@status_payment_method','middleware'=>['permission:payment-method-status']]);

        Route::get('admin_product_order',['uses'=>'AdminController@product_order','middleware'=>['permission:customer-order-list']]);

        Route::get('admin_product_seller',['uses'=>'AdminController@supplier_supply','middleware'=>['permission:seller-status-list']]);

        Route::get('admin_order_status',['uses'=>'AdminController@order_status','middleware'=>['permission:admin-order-status|admin-order-status-edit']]);
        Route::get('edit_order_status/{statusId}',['uses'=>'AdminController@edit_order_status','middleware'=>['permission:admin-order-status-edit']]);
        Route::post('edit_order_status/{statusId}',['uses'=>'AdminController@update_order_status','middleware'=>['permission:admin-order-status-edit']]);


        Route::get('admin_categories',['uses'=>'AdminController@category','middleware'=>['permission:admin-category-list|admin-category-edit']]);
        Route::post('{id}/thumbnail/uploadFiles','AdminController@uploadThumbnails');
        Route::post('{id}/admin/thumbnail/uploadFiles','AdminController@adminUploadThumbnails');
        Route::post('{ADMIN}/byAdmin/thumbnail/uploadFiles','AdminController@adminUploadThumbnails');
        Route::get('delete_thumbnail_admin/{id}','AdminController@delete_thumbnail');
        Route::get('add_category','AdminController@add_category');
        Route::get('edit_category/{id}',['uses'=>'AdminController@edit_category','middleware'=>['permission:admin-category-edit']]);
        Route::post('edit_category/{id}',['uses'=>'AdminController@update_category','middleware'=>['permission:admin-category-edit']]);


        Route::get('admin_subcategories',['uses'=>'AdminController@subcategory','middleware'=>['permission:admin-sub-category-list|admin-sub-category-edit']]);
        Route::get('edit_subcategory/{id}',['uses'=>'AdminController@edit_subcategory','middleware'=>['permission:admin-sub-category-edit']]);
        Route::post('edit_subcategory/{id}',['uses'=>'AdminController@update_subcategory','middleware'=>['permission:admin-sub-category-edit']]);

        Route::get('admin_promotion_slide',['uses'=>'AdminController@slide_promotion','middleware'=>['permission:admin-slide-show-list|admin-slide-show-create|admin-slide-show-edit|admin-slide-show-delete|admin-slide-show-status']]);
        Route::get('add_slide',['uses'=>'AdminController@add_slide','middleware'=>['permission:admin-slide-show-create']]);
        Route::post('add_slide',['uses'=>'AdminController@save_slide','middleware'=>['permission:admin-slide-show-create']]);
        Route::get('delete_slide/{id}',['uses'=>'AdminController@delete_slide','middleware'=>['admin-slide-show-delete']]);
        Route::get('edit_slide/{id}',['uses'=>'AdminController@edit_slide','middleware'=>['permission:admin-slide-show-edit']]);
        Route::post('edit_slide/{id}',['uses'=>'AdminController@update_slide','middleware'=>['permission:admin-slide-show-edit']]);
        Route::get('enable_slide/{id}',['uses'=>'AdminController@update_status_slide','middleware'=>['permission:admin-slide-show-status']]);
        Route::get('disable_slide/{id}',['uses'=>'AdminController@update_status_slide','middleware'=>['permission:admin-slide-show-status']]);


        Route::get('admin_category_promotion_slide',['uses'=>'AdminController@category_slide','middleware'=>['permission:admin-promotion-slide-list|admin-promotion-slide-create|admin-promotion-slide-edit|admin-promotion-slide-delete|admin-promotion-slide-status']]);
        Route::get('add_category_slide',['uses'=>'AdminController@add_category_slide','middleware'=>['permission:admin-promotion-slide-create']]);
        Route::post('add_category_slide',['uses'=>'AdminController@save_category_slide','middleware'=>['permission:admin-promotion-slide-create']]);
        Route::get('delete_slide_category/{id}',['uses'=>'AdminController@delete_slide_category','middleware'=>['permission:admin-promotion-slide-delete']]);
        Route::get('edit_slide_category/{id}',['uses'=>'AdminController@edit_slide_category','middleware'=>['permission:admin-promotion-slide-edit']]);
        Route::post('edit_slide_category/{id}',['uses'=>'AdminController@update_slide_category','middleware'=>['permission:admin-promotion-slide-edit']]);
        Route::get('enable_slide_category/{id}',['uses'=>'AdminController@update_status_slide_category','middleware'=>['permission:admin-promotion-slide-status']]);
        Route::get('disable_slide_category/{id}',['uses'=>'AdminController@update_status_slide_category','middleware'=>['permission:admin-promotion-slide-status']]);


        Route::get('admin_top_banner_mobile',['uses'=>'AdminController@banner_link_mobile','middleware'=>['permission:admin-banner-mobile-listing|admin-banner-mobile-create|admin-banner-mobile-edit']]);
        Route::get('add_banner_link_mobile',['uses'=>'AdminController@add_banner_link_mobile','middleware'=>['permission:admin-banner-mobile-create']]);
        Route::post('add_banner_link_mobile',['uses'=>'AdminController@save_banner_link_mobile','middleware'=>['permission:admin-banner-mobile-create']]);
        Route::get('edit_banner_link_mobile/{id}',['uses'=>'AdminController@edit_banner_link_mobile','middleware'=>['permission:admin-banner-mobile-edit']]);
        Route::post('edit_banner_link_mobile/{id}',['uses'=>'AdminController@update_banner_link_mobile','middleware'=>['permission:admin-banner-mobile-edit']]);

        Route::get('admin_pop_up_banner',['uses'=>'AdminController@pop_up_banner','middleware'=>['permission:admin-pop-up-banner-list|admin-pop-up-banner-create|admin-pop-up-banner-edit|admin-pop-up-banner-delete']]);
        Route::get('add_pop_up_banner',['uses'=>'AdminController@add_pop_up','middleware'=>['permission:admin-pop-up-banner-create']]);
        Route::post('add_pop_up_banner',['uses'=>'AdminController@save_pop_up','middleware'=>['permission:admin-pop-up-banner-create']]);
        Route::get('edit_pop_up_banner/{id}',['uses'=>'AdminController@edit_pop_up','middleware'=>['permission:admin-pop-up-banner-edit']]);
        Route::post('edit_pop_up_banner/{id}',['uses'=>'AdminController@update_pop_up','middleware'=>['permission:admin-pop-up-banner-edit']]);
        Route::get('delete_pop_up_banner/{id}',['uses'=>'AdminController@delete_pop_up','middleware'=>['permission:admin-pop-up-banner-delete']]);
        Route::get('enable_pop_up/{id}',['uses'=>'AdminController@update_status_pop_up','middleware'=>['permission:admin-pop-up-banner-delete']]);
        Route::get('disable_pop_up/{id}',['uses'=>'AdminController@update_status_pop_up','middleware'=>['permission:admin-pop-up-banner-delete']]);


        Route::get('admin_footer_type',['uses'=>'AdminController@footer_type','middleware'=>['permission:admin-footer-type-list|admin-footer-type-create|admin-footer-type-edit|admin-footer-type-delete']]);
        Route::get('add_footer_type',['uses'=>'AdminController@add_footer_type','middleware'=>['permission:admin-footer-type-create']]);
        Route::post('add_footer_type',['uses'=>'AdminController@save_footer_type','middleware'=>['permission:admin-footer-type-create']]);
        Route::get('edit_footer_type/{id}',['uses'=>'AdminController@edit_footer_type','middleware'=>['permission:admin-footer-type-edit']]);
        Route::post('edit_footer_type/{id}',['uses'=>'AdminController@update_footer_type','middleware'=>['permission:admin-footer-type-edit']]);
        Route::get('delete_footer_type/{id}',['uses'=>'AdminController@delete_footer_type','middleware'=>['permission:admin-footer-type-delete']]);


        Route::get('admin_footer_page',['uses'=>'AdminController@footer_page','middleware'=>['permission:admin-footer-page-list|admin-footer-page-create|admin-footer-page-edit|admin-footer-page-delete']]);
        Route::get('add_footer_page',['uses'=>'AdminController@add_footer_page','middleware'=>['permission:admin-footer-page-create']]);
        Route::post('add_footer_page',['uses'=>'AdminController@save_footer_page','middleware'=>['permission:admin-footer-page-create']]);
        Route::get('edit_footer_page/{id}',['uses'=>'AdminController@edit_footer_page','middleware'=>['permission:admin-footer-page-edit']]);
        Route::post('edit_footer_page/{id}',['uses'=>'AdminController@update_footer_page','middleware'=>['permission:admin-footer-page-edit']]);
        Route::get('delete_footer_page/{id}',['uses'=>'AdminController@delete_footer_page','middleware'=>['permission:admin-footer-page-delete']]);

        Route::get('admin_users',['as'=>'admin_user','uses'=>'AdminController@list_users','middleware'=>['permission:admin-user-list|admin-user-create|admin-user-edit|admin-user-delete']]);
        Route::get('admin/delete_user/{user_id}',['uses'=>'AdminController@delete_user','middleware'=>['permission:admin-user-edit']]);
        Route::get('admin/enable_user/{user_id}',['uses'=>'AdminController@delete_user','middleware'=>['permission:admin-user-edit']]);
        Route::get('admin/activate_user/{user_id}',['uses'=>'AdminController@activate_user','middleware'=>['permission:admin-user-edit']]);
        Route::get('admin/user_shop/{user_id}',['uses'=>'AdminController@user_shop','middleware'=>['permission:admin-user-edit']]);
        Route::get('admin/create_user_shop/{user_id}',['uses'=>'AdminController@create_user_shop','middleware'=>['permission:admin-user-edit']]);
        Route::post('admin/create_user_shop/{user_id}',['uses'=>'AdminController@save_create_user_shop','middleware'=>['permission:admin-user-edit']]);
        Route::get('admin/create_user',['uses'=>'AdminController@create_user','middleware'=>['permission:admin-user-create']]);
        Route::post('admin/create_user',['uses'=>'AdminController@store_user','middleware'=>['permission:admin-user-create']]);
        Route::get('admin/edit_user/{user_id}',['uses'=>'AdminController@edit_user','middleware'=>['permission:admin-user-edit']]);
        Route::post('admin/edit_user/{user_id}',['uses'=>'AdminController@update_user','middleware'=>['permission:admin-user-edit']]);
        Route::get('admin/hard_delete_user/{user_id}',['uses'=>'AdminController@hard_delete_user','middleware'=>['permission:admin-user-delete']]);


        Route::get('admin_brands',['uses'=>'AdminController@list_brands','middleware'=>['permission:admin-brand-listing|admin-brand-edit']]);
        Route::get('add_brands',['uses'=>'AdminController@add_brands','middleware'=>['permission:admin-brand-edit']]);
        Route::post('add_brands',['uses'=>'AdminController@save_brands','middleware'=>['permission:admin-brand-edit']]);
        Route::get('edit_brands/{id}',['uses'=>'AdminController@edit_brands','middleware'=>['permission:admin-brand-edit']]);
        Route::post('edit_brands/{id}',['uses'=>'AdminController@update_brands','middleware'=>['permission:admin-brand-edit']]);
        Route::get('delete_brands/{id}',['uses'=>'AdminController@delete_brands','middleware'=>['permission:admin-brand-edit']]);
        Route::get('enable_brands/{id}',['uses'=>'AdminController@delete_brands','middleware'=>['permission:admin-brand-edit']]);


        Route::get('admin_page_management',['uses'=>'AdminController@page_management','middleware'=>['permission:admin-page-management-listing']]);
        Route::get('page_management/{status}/{block}',['uses'=>'AdminController@update_page_management','middleware'=>['permission:admin-page-management-listing']]);

        Route::get('admin_theme_shop',['uses'=>'AdminController@theme_shop','middleware'=>'permission:admin-theme-shop-listing|admin-theme-shop-create|admin-theme-shop-edit|admin-theme-shop-delete']);
        Route::get('add_theme_shop',['uses'=>'AdminController@add_theme_shop','middleware'=>['permission:admin-theme-shop-create']]);
        Route::post('add_theme_shop',['uses'=>'AdminController@save_theme_shop','middleware'=>['permission:admin-theme-shop-create']]);
        Route::get('edit_theme_shop/{id}',['uses'=>'AdminController@edit_theme_shop','middleware'=>['permission:admin-theme-shop-edit']]);
        Route::post('edit_theme_shop/{id}',['uses'=>'AdminController@update_theme_shop','middleware'=>['permission:admin-theme-shop-edit']]);
        Route::get('delete_theme_shop/{id}',['uses'=>'AdminController@delete_theme_shop','middleware'=>['permission:admin-theme-shop-delete']]);



        //allow admin to access route user
        Route::get('admin/shop/edit_product/{product_id}','AdminController@admin_edit_product_shop');
        Route::post('admin/shop/edit_product/{product_id}','AdminController@admin_update_product_shop');
        Route::get('admin/shop/disable_product/{product_id}','AdminController@admin_status_product_shop');
        Route::get('admin/shop/enable_product/{product_id}','AdminController@admin_status_product_shop');
        Route::get('admin/shop/delete_product/{product_id}','AdminController@admin_delete_product_shop');
        Route::get('admin/user_shop/{user_id}/admin_add_product','AdminController@admin_add_product');
        Route::post('admin/user_shop/{user_id}/admin_add_product','AdminController@admin_add_product_save');

        Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
        Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
        Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
        Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
        Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
        Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
        Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);
//    });

//    Route::group(['middleware' => 'user'], function () {

        Route::get('em-user/{user_id}/my_shop',['as'=>'shop.index','uses'=>'ShopController@list_user_product','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
        Route::get('em-user/shop/{userId}/new_product',['as'=>'itemCRUD2.create','uses'=>'ShopController@shop_new_product','middleware' => ['permission:item-create']]);
        Route::post('em-user/shop/{userId}/new_product',['as'=>'itemCRUD2.create','uses'=>'ShopController@save_shop_new_product','middleware' => ['permission:item-create']]);
        Route::get('em-user/shop/{user_id}/edit_product/{product_id}',['as'=>'itemCRUD2.edit','uses'=>'ShopController@edit_product','middleware' => ['permission:item-edit']]);
        Route::post('em-user/shop/{user_id}/edit_product/{product_id}',['as'=>'itemCRUD2.edit','uses'=>'ShopController@update_product','middleware' => ['permission:item-edit']]);
        Route::get('user_product/{userId}/delete_product/{product_id}',['as'=>'itemCRUD2.destroy','uses'=>'ShopController@delete_product_from_list','middleware' => ['permission:item-delete']]);
        Route::get('user_product/{userId}/disable_product/{product_id}',['as'=>'itemCRUD2.destroy','uses'=>'ShopController@delete_product','middleware' => ['permission:item-delete']]);
        Route::get('user_product/{userId}/enable_product/{product_id}',['as'=>'itemCRUD2.destroy','uses'=>'ShopController@delete_product','middleware' => ['permission:item-delete']]);
        Route::get('user_product/{userId}/renew_product/{product_id}','ShopController@renew_product');

        Route::get('em-user/{user_id}/shop_member',['uses'=>'ShopController@shop_member','middleware'=>['permission:member-list|member-create|member-edit|member-delete']]);
        Route::get('em-user/{user_id}/create_shop_member',['uses'=>'ShopController@create_shop_member','middleware'=>['permission:member-create']]);
        Route::post('em-user/{user_id}/create_shop_member',['uses'=>'ShopController@save_shop_member','middleware'=>['permission:member-create']]);



        Route::get('em-user/{user_id}/my_orders','ShopController@list_user_order');
        Route::get('em-user/{user_id}/customer_orders','ShopController@list_customer_order');
        Route::get('message/to_user/{user_id}/shop_id/{shop_id}/product_from/{product_from}/product_id/{product_id}','ShopController@message_from_shop');
        Route::post('message/to_user/{user_id}/shop_id/{shop_id}/product_from/{product_from}/product_id/{product_id}','ShopController@save_message_from_shop');
        Route::get('message/from_user/{user_id}/shop_id/{shop_id}/product_from/{product_from}/product_id/{product_id}','ShopController@message_to_shop');
        Route::post('message/from_user/{user_id}/shop_id/{shop_id}/product_from/{product_from}/product_id/{product_id}','ShopController@save_message_to_shop');
        Route::get('em-user/{user_id}/my_message_center','UserController@message_center');
        Route::get('em-user/{user_id}/my_wishList','ShopController@user_wish_list');
        Route::get('em-user/{user_id}/my_ecammall','UserController@my_ecammall');
        Route::get('em-user/{user_id}/new_shop','ShopController@new_shop')->name('new_shop');
        Route::post('em-user/{user_id}/new_shop','ShopController@save_new_shop');
        Route::get('em-user/{user_id}/my_shop_info','ShopController@user_shop');
        Route::post('em-user/{user_id}/my_shop_info','ShopController@update_shop_info');
        Route::get('em-user/{user_id}/my_account','UserController@my_account');
        Route::post('em-user/{user_id}/my_account','UserController@update_my_account');
        Route::get('em-user/{user_id}/my_promotion','ShopController@my_promotion');
        Route::get('em-user/{user_id}/new_promotion','ShopController@new_promotion');
        Route::post('em-user/{user_id}/new_promotion','ShopController@save_promotion');
        Route::get('em-user/{user_id}/edit/{promotion_id}','ShopController@edit_promotion');
        Route::post('em-user/{user_id}/edit/{promotion_id}','ShopController@update_promotion');
        Route::get('em-user/{user_id}/delete/{promotion_id}','ShopController@delete_promotion');
        Route::get('em-user/{user_id}/my_coupons','ShopController@my_coupon');
        Route::get('em-user/{user_id}/new_coupons','ShopController@new_coupon');
        Route::post('em-user/{user_id}/new_coupons','ShopController@save_coupon');
        Route::get('em-user/coupon/{user_id}/edit/{coupon_id}','ShopController@edit_coupon');
        Route::post('em-user/coupon/{user_id}/edit/{coupon_id}','ShopController@update_coupon');
        Route::get('em-user/coupon/{user_id}/delete/{coupon_id}','ShopController@delete_coupon');
        Route::get('em-user/{user_id}/my_shipping_address','ShopController@my_shipping_address');
        Route::post('em-user/{user_id}/my_shipping_address','ShopController@update_shipping_address');

        Route::get('em-user/{user_id}/membership_list','HomeController@membership_list');
        Route::get('em-user/{user_id}/membership/{packageId}','HomeController@membership_register');
        Route::post('em-user/{user_id}/membership/{packageId}','HomeController@membership_transaction');

        Route::get('admin/products/buy_now','UserController@admin_product_buy_now');
        Route::get('shop/products/buy_now','UserController@user_product_buy_now');
        Route::get('shopping_cart/buy_now_from_cart','UserController@shopping_cart_product_buy_now');
        Route::post('products/{product_id}/order','UserController@product_order');
        Route::post('products/order','UserController@product_order_from_cart');
        Route::get('orders/{order_id}/confirm_payment','UserController@confirm_payment');
        Route::post('orders/{order_id}/order_success','UserController@order_success');
        Route::get('orders/{order_id}/submit_payment','UserController@submit_payment');
        //ajax load choose method
        Route::get('/submit_payment/choose_method/{id}','UserController@choose_method');
        Route::get('/submit_payment/buyer_payment_info/{id}/{orderId}','UserController@buyer_payment_info');

        Route::post('orders/{order_id}/submit_payment','UserController@save_submit_payment');
        Route::get('orders/{order_id}/delete','UserController@delete_order');
        Route::post('orders/{order_id}/start_shipping','UserController@start_shipping');


        Route::get('shopping-cart','HomeController@shopping_cart');
        Route::post('shopping_cart/products/order','UserController@product_order');
        Route::get('remove_item_cart/{id}','HomeController@remove_item_cart');
        Route::get('remove_item_confirm/{id}/orderId/{orderId}','HomeController@remove_item_confirm');

        Route::get('pending_orders/confirm_all_payment','UserController@pending_confirm');
        Route::get('pending_order_delete_item/{id}','UserController@pending_order_delete_item');
        Route::post('pending_orders/order_success','UserController@pending_order_success');


        //chat route

        Route::post('chat-to-shop','ShopController@chat_form');

//Route::get('user_product','ShopController@list_user_product');
//Route::get('user_shop','ShopController@user_shop');
//Route::post('user_shop','ShopController@update_shop_info');
//Route::get('user_product/edit_product/{product_id}','ShopController@edit_product');
//Route::post('user_product/edit_product/{product_id}','ShopController@update_product');

//    });






