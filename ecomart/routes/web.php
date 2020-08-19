<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => '/',
    'namespace' => 'Frontend',
],function(){

    // login bằng facebook
    Route::get('/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback')->name('callback');
    // end login bằng facebook

    // login bằng google
    Route::get('/redirects/google', 'SocialController@redirectToProvider')->name('redirects');
    Route::get('/callbacks/google', 'SocialController@handleProviderCallback')->name('callback');
    // end login bằng google

    Route::get('logins','MemberController@getLogin')->name('login');
    Route::post('logins','MemberController@postLogin')->name('post.login');
    Route::get('registers','MemberController@getRegister')->name('register');
    Route::post('registers','MemberController@postRegister')->name('post.register');
    Route::get('logout','MemberController@postLogout')->name('logout');
    Route::get('reset-password','MemberController@getSendMailReset')->name('get.reset-password');
    Route::post('reset-password','MemberController@postSendMailReset')->name('get.reset-password');
    route::get('lay-lai-mat-khau','MemberController@getFormReset')->name('get.reset-password');
    route::post('lay-lai-mat-khau','MemberController@postFormReset')->name('get.reset-password');

    // profile

    Route::get('profile','ProfileController@getProfile')->name('get.profile.user');
    Route::get('update-profile','ProfileController@getUpdateProfile')->name('get.update-profile.user');
    Route::post('update-profile','ProfileController@postUpdateProfile')->name('post.update-profile.user');

    Route::group([
        'middleware' => 'member',
    ],function(){
        Route::get('wishlist','ShoppingController@getWishList');
        
        Route::get('checkout','ShoppingController@getCheckout')->name('get.checkout');
        Route::post('checkout','ShoppingController@postCheckout')->name('post.checkout');

    });

    Route::get('purchase-now','ShoppingController@getPurchaseNow')->name('get.purchase-now');
    Route::post('purchase-now','ShoppingController@postCheckout')->name('get.purchase-now');

    Route::get('/','HomeController@index')->name('index');
    Route::get('/product/{slug_deltail}','HomeController@getDetailProduct')->name('detail_product');
    Route::post('register_email','HomeController@postRegisterEmail')->name('post.register_email');
    Route::get('register_email','HomeController@getRegisterEmail')->name('post.register_email');


    // -search detail
    Route::get('search-detail','SearchController@getProductSearch');
    Route::post('search-detail','SearchController@postProductSearch')->name('get.search.product');
    // 
    Route::get('search/{slug_product_menu}&price={id_price}&other={others_id}','SearchController@searchProductPriceOthers')->name('get.search.product');
    Route::get('search/{slug_product_menu}&other={others_id}&price={id_price}','SearchController@searchProductOthersPrice')->name('get.search.product');
    Route::get('search/{slug_product_menu}&price={id_price}','SearchController@searchProductPrice')->name('get.search.product');
    Route::get('search/{slug_product_menu}&other={others_id}','SearchController@searchProductOther')->name('get.search.product');
    Route::get('search/{slug_product_menu}','SearchController@getDetailProductMenu')->name('get.detail.product_menu');
    

    // ajax add product
    Route::post('add_product/product','ShoppingController@postAddProduct')->name('post.add.product');
    Route::post('remove_product/product','ShoppingController@postRemoveProduct')->name('post.remove.product');
    Route::post('quantity_product/product','ShoppingController@postChangeQuantity')->name('post.change.product');

    // ajax province--district-ward
    Route::post('province/action','ShoppingController@getDistrictAjax')->name('post.ajax.district');
    Route::post('district/action','ShoppingController@getWardAjax')->name('post.ajax.ward');
    // end ajax 

    Route::get('shopping-cart','ShoppingController@getShoppingCart')->name('get.cart');
    // get agency(daily)
    Route::get('lien-he','DailyController@index')->name('get.dai-ly');
    Route::post('lien-he','DailyController@postSendInforDaily')->name('post.dai-ly');

    // ajax wishlist
    Route::get('wishlist','WishlistController@getWishlist');
    Route::post('wishlist/action','WishlistController@postAddWishlist')->name('ajax.wishlist');
    Route::post('/wishlist-remove/action','WishlistController@removeWishlist')->name('ajax.remove.wishlist');

    Route::get('cua-hang','ComboController@getCombo')->name('cua-hang.hot');
    Route::get('cua-hang&price={id_price}&other={other_id}','ComboController@searchComboPriceOther');
    Route::get('cua-hang&other={other_id}&price={id_price}','ComboController@searchComboOtherPrice');
    Route::get('cua-hang&price={id_price}','ComboController@searchComboPrice')->name('search.combo.price');
    Route::get('cua-hang&other={other_id}','ComboController@searchComboOther')->name('search.combo.other');

    Route::get('tin-tuc/detail/{id}','SaleController@getSaleDetail')->name('get.sale.detail');
    Route::get('tin-tuc/{slug}','SaleController@getSaleMonth')->name('get.sale.month');
    Route::get('tin-tuc','SaleController@getSale')->name('get.sale');
    // footer 
    Route::get('article/{slug_article}','ArticleController@getArticle')->name('get.article');

});

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {
    Route::get('/', 'LoginController@showLoginForm'); //ham showlogin la ham login mac dinh cua laravel, e muon biet no o dau thi mo router ẩn cua no len la thay. trong bai 5 co lenh show router ân. roi 
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');
});

Route::group([
    'prefix' => 'admin',
	'namespace' => 'Admin',
    'middleware' => ['admin']
],function(){
    Route::post('get_post_chartjs_data/admin','HomeController@getAllMonthCount')->name('ajax.chart.js');
    
    Route::get('home&month={month}','HomeController@index');
  	Route::get('home', 'HomeController@index')->name('home');

    // profile 
    Route::get('profile','ProfileController@getProfile')->name('get_profile');
    Route::get('update_profile','ProfileController@getUpdateProfile');
    Route::post('update_profile','ProfileController@postUpdateProfile')->name('post.update_profile');
    Route::get('change_password','ProfileController@getchangePassword2');
    Route::get('/change-password','ProfileController@getChangePassword');
    Route::post('change_password','ProfileController@postChangePassword')->name('post.change-password');
      //add category
    Route::get('category_manager','CategoryController@index');
    Route::get('category_add','CategoryController@getAddCategory');
    Route::post('category_add','CategoryController@postAddCategory');

    Route::get('article_manager','ArticleController@index')->name('article_manager');
    // ajax artivle hot show
    Route::post('show_category/article','ArticleController@showCategoryAricle')->name('ajax.show.category');
    Route::post('hot_category/article','ArticleController@hotCategoryAricle')->name('ajax.show.category');
    Route::post('show/article','ArticleController@showArticleMenu')->name('ajax.show_article.article_menu');
    Route::post('hot/article','ArticleController@hotArticleMenu')->name('ajax.hot_article.article_menu');
    Route::post('is_active/article','ArticleController@showArticle')->name('ajax.show_article.article');
    Route::post('hot_article/article','ArticleController@hotArticle')->name('ajax.hot_article.article');
    Route::post('sort_category/sort','ArticleController@sortCategoryArticle')->name('ajax.sort.category');
    Route::post('sort_article/sort','ArticleController@sortArticle')->name('ajax.sort.category');

    // add article (thêm bài viết)
    Route::get('article_menu_add&id_cat={id_cat}&id_menu_art={id_menu_art}','ArticleController@getAddArticle2')->name('article');
    Route::post('article_menu_add&id_cat={id_cat}&id_menu_art={id_menu_art}','ArticleController@postAddArticle2')->name('article');
    Route::get('article_menu_add&id_cat={id_cat}','ArticleController@getAddArticle')->name('add.article');
    Route::post('article_menu_add&id_cat={id_cat}','ArticleController@postAddArticle')->name('post.add.article');
    // edit article(chỉnh sửa bài viết)
    Route::get('category_edit&id_edit={id_edit}','ArticleController@getEditCategory')->name('edit.category.article');
    Route::post('category_edit&id_edit={id_edit}','ArticleController@postEditCategory')->name('post.edit.category');
    Route::get('article_menu_edit&id_cat={id_cat}&id_edit={id_edit}','ArticleController@getEditArticle')->name('edit.article');
    Route::post('article_menu_edit&id_cat={id_cat}&id_edit={id_edit}','ArticleController@postEditArticle')->name('edit.article');
    // delete article(xóa bài viết)
    Route::get('article_manager&id_cat={id_cat}&del={id_del}','ArticleController@postDelArticle')->name('del.article');
    // list article
    Route::get('article_list&id_menu_art={id_menu_art}','ArticleController@getArticleList')->name('get.list.article');
    Route::post('article_list&id_menu_art={id_menu_art}','ArticleController@postDelArticleList')->name('get.list.article');
    // add_list article
    Route::get('article_add&id_menu_art={id_menu_art}','ArticleController@getAddArticleList')->name('get.add.list.article');
    Route::post('article_add&id_menu_art={id_menu_art}','ArticleController@postAddArticleList')->name('get.add.list.article');
    // edit_list article
    Route::get('article_edit&id_art={id_art}','ArticleController@getEditArticleList')->name('get.edit.list.article');
    Route::post('article_edit&id_art={id_art}','ArticleController@postEditArticleList')->name('get.edit.list.article');




    // gallery_manager
    Route::get('gallery_manager','GalleryController@index')->name('get.gallery.manager');

    // ajax
    Route::post('is_active_category_gallery/gallery','GalleryController@showCategoryGallery')->name('ajax.is_active');
    Route::post('hot_category_gallery/gallery','GalleryController@hotCategoryGallery')->name('ajax.is_active');
    Route::post('show_gallery/gallery','GalleryController@showGalleryMenu')->name('ajax.is_active.gallery_menu');
    Route::post('hot_gallery_menu/gallery','GalleryController@hotGalleryMenu')->name('ajax.is_active.gallery_menu');
    Route::post('is_active_gallery/gallery','GalleryController@showGallery')->name('ajax.is_active.gallery');
    Route::post('hot_gallery/gallery','GalleryController@hotGallery')->name('ajax.hot.gallery');

    Route::post('sort_category/gallery','GalleryController@sortCategoryGallery')->name('ajax.sort.category.gallery');
    Route::post('sort_gallery/sort','GalleryController@sortGallery')->name('ajax.sort.gallery');
    // end ajax

    // add gallery_menu (table : gallery_menu)
    Route::get('gallery_menu_add&id_cat={id_cat}&id_menu_gal={id_menu_gal}','GalleryController@getAddGalleryMenu2')->name('add.gallery_menu_2');
    Route::post('gallery_menu_add&id_cat={id_cat}&id_menu_gal={id_menu_gal}','GalleryController@postAddGalleryMenu2')->name('add.gallery_menu_2');
    Route::get('gallery_menu_add&id_cat={id_cat}','GalleryController@getAddGalleryMenu')->name('add.gallery_menu');
    Route::post('gallery_menu_add&id_cat={id_cat}','GalleryController@postAddGalleryMenu')->name('add.gallery_menu');
    

    //edit category gallery
    Route::get('category_gallery_edit&id_edit={id_edit}','GalleryController@getEditCategory')->name('get.edit.category.gallery');
    Route::post('category_gallery_edit&id_edit={id_edit}','GalleryController@postEditCategory')->name('post.edit.category.gallery');
    Route::get('gallery_menu_edit&id_edit={id_edit}','GalleryController@getEditGalleryMenu')->name('edit.gallery_menu');
    Route::post('gallery_menu_edit&id_edit={id_edit}','GalleryController@postEditGalleryMenu')->name('edit.gallery_menu');
    // delete gallery_menu (table : gallery_menu)
    Route::get('gallery_manager&id_del={id_del}','GalleryController@postDelGallery')->name('delete.gallery_menu');

    // gallery_list (table : gallery)
    Route::get('gallery_list&id_menu_gal={id_menu_gal}&id_product={id_product}','GalleryController@getGalleryList')->name('get.gallery_list');
    Route::post('gallery_list&id_menu_gal={id_menu_gal}&id_product={id_product}','GalleryController@postDellGallery')->name('post.delete.gallery_list');
    Route::get('gallery_list&id_menu_gal={id_menu_gal}','GalleryController@getGalleryList')->name('get.gallery_list');
    Route::post('gallery_list&id_menu_gal={id_menu_gal}','GalleryController@postDellGallery')->name('post.delete.gallery_list');

    Route::get('gallery_add&id_menu_gal={id_menu_gal}&id_product={id_product}','GalleryController@getGalleryAdd')->name('get.add.gallery');
    Route::post('gallery_add&id_menu_gal={id_menu_gal}&id_product={id_product}','GalleryController@postGalleryAdd')->name('get.add.gallery');

    Route::get('gallery_edit&id_edit={id_edit}&id_menu_gal={id_menu_gal}','GalleryController@getGalleryEdit')->name('get.edit.gallery');
    Route::post('gallery_edit&id_edit={id_edit}&id_menu_gal={id_menu_gal}','GalleryController@postGalleryEdit')->name('get.edit.gallery');




    // product
    Route::get('product_manager','ProductController@index')->name('get.product.index');
    Route::get('product_manager&id_del={id_del}','ProductController@postDelProductMenu')->name('post.delete.product_menu');

    // ajax
    Route::post('is_active_product_menu/is_active','ProductController@showProductMenu')->name('ajax.is_active.product_menu');
    Route::post('hot_product_menu/hot','ProductController@hotProductMenu')->name('ajax.is_active.product_menu');
    Route::post('is_active_product/is_active','ProductController@showProduct')->name('ajax.is_active.product_menu');
    Route::post('hot_product/hot','ProductController@hotProduct')->name('ajax.is_active.product_menu');
    Route::post('sort_product/product','ProductController@sortProduct')->name('ajax.post.sort.product');
    // end ajax

    // add muc product (table:product_menu)
    // -> nhanh 1 + nhanh 2
    Route::get('product_menu_add&id_cat={id_cat}&id_product={id_product}','ProductController@getAddProductMenu2')->name('get.product_menu2');
    Route::post('product_menu_add&id_cat={id_cat}&id_product={id_product}','ProductController@postAddProductMenu2')->name('get.product_menu2');
    Route::get('product_menu_add&id_cat={id_cat}','ProductController@getAddProductMenu')->name('get.product_menu');
    Route::post('product_menu_add&id_cat={id_cat}','ProductController@postAddProductMenu')->name('post.product_menu');
    // edit muc category
    Route::get('category_product_edit&id_edit={id_edit}','ProductController@getEditCategory')->name('get.edit.category');
    Route::post('category_product_edit&id_edit={id_edit}','ProductController@postEditCategory')->name('get.edit.category');
    //edit muc product_menu
    Route::get('product_menu_edit&id_edit={id_edit}','ProductController@getEditProductMenu')->name('get.edit.product_menu');
    Route::post('product_menu_edit&id_edit={id_edit}','ProductController@postEditProductMenu')->name('get.edit.product_menu');
    // edit muc product
    Route::get('product_edit&id_edit={id_edit}','ProductController@getEditProduct')->name('get.edit.product');
    Route::post('product_edit&id_edit={id_edit}','ProductController@postEditProduct')->name('get.edit.product');
    //list product ('table:product')
    Route::get('product_list&id_product_menu={id_product_menu}','ProductController@getProduct')->name('get.product');
    // add product list 
    Route::get('product_add&id_product_menu={id_product_menu}','ProductController@getAddProduct')->name('get.add.product');
    Route::post('product_add&id_product_menu={id_product_menu}','ProductController@postAddProduct')->name('get.add.product');
    //
    Route::post('product_list&id_product_menu={id_product_menu}','ProductController@postDelProduct')->name('post.del.product_list');




    // others ,danh mục others
    Route::get('others_manager','OtherController@index');
    Route::get('others_manager&id_del={id_del}','OtherController@postDelOtherMenu')->name('get.delete.other_menu');
    // ajax
    Route::post('is_active_others_menu/others','OtherController@showOtherMenu')->name('ajax.post.show.others_menu');
    Route::post('hot_others_menu/others','OtherController@hotOtherMenu')->name('ajax.post.hot.others_menu');
    Route::post('is_active_others/others','OtherController@showOther')->name('ajax.post.hot.others_menu');
    Route::post('hot_others/others','OtherController@hotOther')->name('ajax.post.hot.others_menu');
    Route::post('sort_category/others','OtherController@sortCategory')->name('ajax.post.sort.category.others');
    Route::post('sort_others/others','OtherController@sortOthersMenu')->name('ajax.post.sort.others.menu');
    // end ajax
    // thêm danh mục other_menu 
    Route::get('others_menu_add&id_cat={id_cat}','OtherController@getAddOtherMenu')->name('get.add.other_menu');
    Route::post('others_menu_add&id_cat={id_cat}','OtherController@postAddOtherMenu')->name('get.add.other_menu');
    //edit danh muc other_menu
    Route::get('other_menu_edit&id_edit={id_edit}','OtherController@getEditOtherMenu')->name('get.edit.other_menu');
    Route::post('other_menu_edit&id_edit={id_edit}','OtherController@postEditOtherMenu')->name('get.edit.other_menu');
    //edit danh muc category
    Route::get('category_other_edit&id_edit={id_edit}','OtherController@getEditCategory')->name('get.edit.category.other_menu');
    Route::post('category_other_edit&id_edit={id_edit}','OtherController@postEditCategory')->name('get.edit.category.other_menu');
    // list danh sach others
    Route::get('others_list&id_others_menu={id_others_menu}','OtherController@getListOther')->name('get.list.others');
    // add danh sach others
    Route::get('others_add&id={id_others_menu}','OtherController@getAddListOther')->name('get.add.list.others');
    Route::post('others_add&id={id_others_menu}','OtherController@postAddListOther')->name('post.add.list.others');
    // edit danh sach others
    Route::get('others_edit&id_edit={id_edit}','OtherController@getEditListOther')->name('get.edit.list.others');
    Route::post('others_edit&id_edit={id_edit}','OtherController@postEditListOther')->name('get.edit.list.others');
    // delete danh sach others
    Route::post('others_list&id_others_menu={id_others_menu}','OtherController@postDelOthers')->name('post.del.list.others');

    Route::get('cart_manager','CartController@index')->name('get.cart.manager');
    Route::post('cart_manager','CartController@postDellCart');
    // ajax cart 
    Route::post('/is_view_cart/action','CartController@getIsViewCart')->name('ajax.is_view.cart');
    Route::post('is_show_cart/action','CartController@getIsShowCart')->name('ajax.is_show_cart');
    // end ajax

    // manager 
    Route::get('agency_manager','ManagerController@getAgencyManager')->name('get.agency.manager');
    Route::post('agency_manager','ManagerController@postDelAgency')->name('post.del.agency');
    // ajax agency
    Route::post('is_active_contact/action','ManagerController@postIsActiveContact')->name('post.contact');


    Route::get('email_manager','ManagerController@getEmailManager')->name('get.email.manager');
    Route::post('email_manager','ManagerController@postDelEmailManager')->name('post.email.manager');

    Route::get('plus_manager','ManagerController@getPlusManager')->name('get.plus.manager');
    Route::post('plus_manager','ManagerController@postDelPlus')->name('post.del.plus.manager');
    Route::get('plus_add','ManagerController@getPlusAdd')->name('get.add.plus');
    Route::post('plus_add','ManagerController@postPlusAdd')->name('post.add.plus');
    Route::get('page_edit&id_edit={id_edit}','ManagerController@getPlusEdit')->name('post.edit.plus');
    Route::post('page_edit&id_edit={id_edit}','ManagerController@postPlusEdit')->name('post.edit.plus');
    // ajax 
    Route::post('is_active_page/page','ManagerController@getIsActivePage')->name('ajax');


    // backup database
    Route::get('backup-data',['as'=>'backup-data','uses'=>'DatabaseController@index'])->name('get.data.backup');
    Route::get('backup-data/create','DatabaseController@create')->name('get.data.create.backup');
    Route::get('backup-data/download/{file_name}','DatabaseController@download')->name('get.data.create.backup');
    Route::get('backup-data/delete/{file_name}','DatabaseController@delete')->name('get.data.create.backup');
    // end backup

    //database-backup
    Route::get('backup-config','DatabaseController@getBackupConfig')->name('get.backup_config');
    Route::post('backup-config/{id_edit}','DatabaseController@postBackupConfig')->name('get.backup_config');


    // config
    Route::get('config-general','ConfigController@getConfigGeneral')->name('get.config-general');
    Route::post('config-general','ConfigController@postConfigGeneral')->name('post.config-general');
    
    Route::get('config-smtp','ConfigController@getConfigSMTP')->name('get.config-smtp');
    Route::post('config-smtp','ConfigController@postConfigSMTP')->name('post.config.smtp');

    Route::get('config-time','ConfigController@getConfigTime')->name('get.config-time');
    Route::post('config-time','ConfigController@postConfigTime')->name('post.config-time');
    
    Route::get('config-network','ConfigController@getConfigNetwork')->name('get.config-network');
    Route::post('config-network','ConfigController@postConfigNetwork')->name('post.config-network');
   


    // * core_role
    Route::get('core-role','CoreController@getCoreRole')->name('get.core-role');
    Route::post('core-role','CoreController@postDelCoreRole')->name('post.delete.core-role');

    //core ajax
    Route::post('is_active_core_role/core','CoreController@showCoreRole');

    //add 
    Route::get('core_role_add','CoreController@getCoreRoleAdd')->name('get.role.add');
    Route::post('core_role_add','CoreController@postCoreRoleAdd')->name('get.role.add');

    Route::get('core_role_edit&id_edit={id_edit}','CoreController@getCoreRoleEdit')->name('get.role.edit');
    Route::post('core_role_edit&id_edit={id_edit}','CoreController@postCoreRoleEdit')->name('get.role.edit');

    // * core_user
    Route::get('core-user','CoreController@getCoreUser')->name('get.core-user');
    Route::post('core-user','CoreController@postDelCoreUser')->name('post.delete.core.user');
    //core user ajax 
    Route::post('is_active_core_user/core','CoreController@isActiveCoreUser')->name('post.ajax.is_active.user');
    Route::post('is_show_core_user/core','CoreController@showCoreUser')->name('post.ajax.show.user');
    // core user ajax

    Route::get('core_user_add','CoreController@getCoreUserAdd')->name('get.user.add');
    Route::post('core_user_add','CoreController@postCoreUserAdd')->name('get.user.add');

    Route::get('core_user_edit&id_edit={id_edit}','CoreController@getCoreUserEdit')->name('get.user.edit');
    Route::post('core_user_edit&id_edit={id_edit}','CoreController@postCoreUserEdit')->name('get.user.edit');

    // phân quyền thôi
    Route::get('core_dasboard&role_id={role_id}','DasboardController@getCoreDasboard');

    Route::get('core_dashboard&coreAll&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dasboard.category');
    Route::post('core_dashboard&coreAll&role_id={role_id}','DasboardController@postCoreAll')->name('post.dasboard.category');

    Route::get('core_dashboard&core_article&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dashboard.article');
    Route::post('core_dashboard&core_article&role_id={role_id}','DasboardController@postCoreArticle')->name('post.dasboard.article');

    Route::get('core_dashboard&core_gallery&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dashboard.gallery');
    Route::post('core_dashboard&core_gallery&role_id={role_id}','DasboardController@postCoreGallery')->name('post.dasboard.article');

    Route::get('core_dashboard&core_product&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dashoard.product');
    Route::post('core_dashboard&core_product&role_id={role_id}','DasboardController@postCoreProduct')->name('post.dashboard.product');

    Route::get('core_dashboard&core_others&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dashoard.other');
    Route::post('core_dashboard&core_others&role_id={role_id}','DasboardController@postCoreOther')->name('post.dashboard.other');

    Route::get('core_dashboard&core_plus&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dashoard.other');
    Route::post('core_dashboard&core_plus&role_id={role_id}','DasboardController@postCorePlus')->name('post.dashboard.plus');

    Route::get('core_dashboard&core_database&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dashoard.other');
    Route::post('core_dashboard&core_database&role_id={role_id}','DasboardController@postCoreDatabase')->name('post.database'); 

    Route::get('core_dashboard&core_config&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dashoard.other');
    Route::post('core_dashboard&core_config&role_id={role_id}','DasboardController@postCoreConfig')->name('post.database');

    Route::get('core_dashboard&core_admin&role_id={role_id}','DasboardController@getCoreDasboardFilter')->name('get.dashboard.admin');
    Route::post('core_dashboard&core_admin&role_id={role_id}','DasboardController@postCoreDashboardAdmin')->name('get.dashboard.admin');
});
