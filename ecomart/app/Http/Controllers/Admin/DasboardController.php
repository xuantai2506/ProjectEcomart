<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Http\Controllers\Functions;
class DasboardController extends Controller
{
    
    public function getCoreDasboard(Request $request,$role_id){
        // phân quyền       
        $functions = new Functions();

        $check = $functions->loadPageAdmin('core_dashboard','core');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

    	// category

    	$category  = self::getCategory($role_id);

        $article = self::getArticle($role_id);

        $gallery = self::getGallery($role_id);

        $product = self::getProduct($role_id);

        $others = self::getOther($role_id);

        $pages = self::getPage($role_id);

        $database = self::getDatabase($role_id);

        $config = self::getConfig($role_id);

        $core = self::getCore($role_id);

        return view('admin.core.dashboard',compact('role_id','category','article','gallery','product','others','pages','database','config','core'));

    }

    public function getCategory($role_id){
       
        $stt = 0 ;

        $category = [];

        $privilege_category = [];

        $get_category = CategoryType::where('is_active',1)->get();

        $get_category_privilege = CorePrivilege::where('role_id',$role_id)->where('type','category')->get();

        foreach ($get_category_privilege as $row) {

            $privilege_category[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($category ,['get_category' => $get_category , 'get_category_privilege' => $privilege_category]);

        return $category;

    }

    public function getArticle($role_id){
        $stt = 0 ;

        $article = [];

        $privilege_article = [];

        $get_category = Category::where('type_id',1)->get();

        $get_article_privilege = CorePrivilege::where('role_id',$role_id)->where('type','article')->get();

        foreach ($get_article_privilege as $row) {

            $privilege_article[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($article ,['get_category' => $get_category , 'get_article_privilege' => $privilege_article]);

        return $article;

    }

    public function getGallery($role_id){
        $stt = 0 ;

        $gallery = [];

        $privilege_gallery = [];

        $get_category = Category::where('type_id',2)->get();

        $get_gallery_privilege = CorePrivilege::where('role_id',$role_id)->where('type','gallery')->get();

        foreach($get_gallery_privilege as $row){

            $privilege_gallery[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($gallery,['get_category' => $get_category , 'get_gallery_privilege' => $privilege_gallery]);

        return $gallery;
    }

    public function getProduct($role_id){

        $stt = 0 ;

        $product = [];

        $privilege_product = [];

        $get_category = Category::where('type_id',6)->get();

        $get_product_privilege = CorePrivilege::where('role_id',$role_id)->where('type','product')->get();

        foreach($get_product_privilege as $row){

            $privilege_product[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($product,['get_category' => $get_category , 'get_product_privilege' => $privilege_product]);

        return $product;

    }

    public function getOther($role_id){

        $stt = 0 ;

        $others = [];

        $privilege_others = [];

        $get_category = Category::where('type_id',15)->get();

        $get_other_privilege = CorePrivilege::where('role_id',$role_id)->where('type','others')->get();

        foreach($get_other_privilege as $row){

            $privilege_others[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($others,['get_category' => $get_category , 'get_other_privilege' => $privilege_others]);

        return $others;

    }

    public function getPage($role_id){

        $stt = 0; 

        $pages = [];

        $privilege_pages = [];

        $get_pages_privilege = CorePrivilege::where('role_id',$role_id)->where('type','pages')->get();

        foreach($get_pages_privilege as $row){

            $privilege_pages[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($pages,['get_pages_privilege' => $privilege_pages]);

        return $pages;

    }

    public function getDatabase($role_id){

        $stt = 0; 

        $database = [];

        $privilege_database = [];

        $get_database_privilege = CorePrivilege::where('role_id',$role_id)->where('type','backup')->get();

        foreach($get_database_privilege as $row){

            $privilege_database[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($database,['get_database_privilege' => $privilege_database]);

        return $database;
        
    }

    public function getConfig($role_id){

        $stt = 0 ;

        $config = [];

        $privilege_config = [];

        $get_config_privilege = CorePrivilege::where('role_id',$role_id)->where('type','config')->get();

        foreach($get_config_privilege as $row){

            $privilege_config[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($config,['get_config_privilege' => $privilege_config]);

        return $config ;

    }

    public function getCore($role_id){

        $stt = 0 ;

        $core = [];

        $privilege_core = [];

        $get_core_privilege = CorePrivilege::where('role_id',$role_id)->where('type','core')->get();

        foreach($get_core_privilege as $row){

            $privilege_core[$stt] = $row['privilege_slug'];
            $stt++;

        }

        array_push($core,['get_core_privilege' => $privilege_core]);

        return $core ;

    }

    // Khoong can quan tam function nay

    public function getCoreDasboardFilter($role_id){
        return redirect('admin/core_dasboard&role_id='.$role_id);
    }

    // phân quyền phần category --> các manager (article_manager,......);

    public function postCoreAll(Request $request,$role_id){

        $arr_category = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'category'; 

        self::postDelCoreAll($role_id);

        if($arr_category != ''){
            foreach ($arr_category as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }
        }else {
            $result = true ;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=1";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }

    public function postDelCoreAll($role_id){

        $core_category_database = CorePrivilege::where('role_id',$role_id)->where('type','category')->get()->toArray();

        if($core_category_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','category')->delete();

        }

    }

    // phân quyền bài viết ,cacs phần edit add trong article
    public function postCoreArticle(Request $request,$role_id){

        $arr_article = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'article'; 

        self::postDellArticle($role_id);

        if($arr_article != []){

            foreach ($arr_article as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }

        }else{
            $result = true;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=1";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
        
    }

    public function postDellArticle($role_id){

        $core_article_database = CorePrivilege::where('role_id',$role_id)->where('type','article')->get()->toArray();

        if($core_article_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','article')->delete();

        }

    }
    // phân quyền hình ảnh 

    public function postCoreGallery(Request $request,$role_id){

        $arr_gallery = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'gallery';

        self::postDelGallery($role_id);

        if($arr_gallery != []){

            foreach ($arr_gallery as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }

        }else{
            $result = true;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=$role_id";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function postDelGallery($role_id){

        $core_gallery_database = CorePrivilege::where('role_id',$role_id)->where('type','gallery')->get()->toArray();

        if($core_gallery_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','gallery')->delete();

        }

    }
    // phana quyền sản phẩm -> 

    public function postCoreProduct(Request $request,$role_id){

        $arr_product = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'product';

        self::postDelProduct($role_id);

        if($arr_product != []){

            foreach ($arr_product as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }

        }else{
            $result = true;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=$role_id";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function postDelProduct($role_id){

        $core_product_database = CorePrivilege::where('role_id',$role_id)->where('type','product')->get()->toArray();

        if($core_product_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','product')->delete();

        }

    }

    // phana quyen muc khac

    public function postCoreOther(Request $request,$role_id){

        $arr_others = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'others';

        self::postDelOther($role_id);

        if($arr_others != []){

            foreach ($arr_others as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }

        }else{
            $result = true;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=$role_id";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function postDelOther($role_id){

        $core_other_database = CorePrivilege::where('role_id',$role_id)->where('type','others')->get()->toArray();

        if($core_other_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','others')->delete();

        }

    }

    // phân quyền phần bổ sung

    public function postCorePlus(Request $request,$role_id){

        $arr_plus = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'pages';

        self::postDelPlus($role_id);

        if($arr_plus != []){

            foreach ($arr_plus as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }

        }else{
            $result = true;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=$role_id";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function postDelPlus($role_id){

        $core_page_database = CorePrivilege::where('role_id',$role_id)->where('type','pages')->get()->toArray();

        if($core_page_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','pages')->delete();

        }

    }

    public function postCoreDatabase(Request $request ,$role_id){

        $arr_database = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'backup';

        self::postDelDatabase($role_id);

        if($arr_database != []){

            foreach ($arr_database as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }

        }else{
            $result = true;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=$role_id";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function postDelDatabase($role_id){

        $core_backup_database = CorePrivilege::where('role_id',$role_id)->where('type','backup')->get()->toArray();

        if($core_backup_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','backup')->delete();

        }

    }

    // phân quyền config
    public function postCoreConfig(Request $request,$role_id){
        $arr_config = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'config';

        self::postDelConfig($role_id);

        if($arr_config != []){

            foreach ($arr_config as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }

        }else{
            $result = true;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=$role_id";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }

    public function postDelConfig($role_id){

        $core_config_database = CorePrivilege::where('role_id',$role_id)->where('type','config')->get()->toArray();

        if($core_config_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','config')->delete();

        }

    }

    // Phana quyen dashboard

    public function postCoreDashboardAdmin(Request $request,$role_id){

        $arr_config = $request->variable;

        $data['role_id'] = $role_id;

        $data['type'] = 'core';

        self::postDelDashboard($role_id);

        if($arr_config != []){

            foreach ($arr_config as $key => $privilege_slug) {
                $data['privilege_slug'] = $privilege_slug;
                $result = CorePrivilege::create($data);
            }

        }else{
            $result = true;
        }

        $str = "Bạn đã cấp quyền thành công";
        $str_fail = "Bạn đã cấp quyền thất bại";
        $url = "admin/core_dasboard&role_id=$role_id";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function postDelDashboard($role_id){

        $core_dashboard_database = CorePrivilege::where('role_id',$role_id)->where('type','core')->get()->toArray();

        if($core_dashboard_database != []){

            CorePrivilege::where('role_id',$role_id)->where('type','core')->delete();

        }

    }
}
