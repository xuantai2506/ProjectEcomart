<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_menu;
use App\Models\Other;
use App\Models\OtherMenu;
use App\Models\Gallery_menu;
use App\Http\Requests\admin\RequestProduct;
use App\Http\Controllers\Functions;
use Intervention\Image\ImageManagerStatic as Image;
class ProductController extends Controller
{
    public function index()
    {   
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdmin('product_manager','category');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $sort_category = Category::where('type_id',6)->get()->pluck('sort');
        $sort_product = Product_menu::get(['category_id','sort','parent']);
        $category = Category::where("type_id",6)->get();
        $product_menu = Product_menu::OrderBy('sort','ASC')->get();

        return view('admin.product.manager',compact('category','product_menu','sort_product','sort_category'));
    }
    // ajax
    public function showProductMenu(){
        $id = $_POST['id'];
        $is_active = Product_menu::where('product_menu_id',$id)->pluck('is_active')[0];
        if($is_active == 1){
            Product_menu::where('product_menu_id',$id)->update(['is_active' => 0]);
        }else {
            Product_menu::where('product_menu_id',$id)->update(['is_active' => 1]);
        }
    }
    public function hotProductMenu(){
        $id = $_POST['id'];
        $hot = Product_menu::where('product_menu_id',$id)->pluck('hot')[0];
        if($hot == 1){
            Product_menu::where('product_menu_id',$id)->update(['hot' => 0]);
        }else {
            Product_menu::where('product_menu_id',$id)->update(['hot' => 1]);
        }
    }
    public function showProduct(){
        $id = $_POST['id'];
        $is_active = Product::where('product_id',$id)->pluck('is_active')[0];
        if($is_active == 1){
            Product::where('product_id',$id)->update(['is_active' => 0]);
        }else {
            Product::where('product_id',$id)->update(['is_active' => 1]);
        }
    }
    public function hotProduct(){
        $id = $_POST['id'];
        $hot = Product::where('product_id',$id)->pluck('hot')[0];
        if($hot == 1){
            Product::where('product_id',$id)->update(['hot' => 0]);
        }else {
            Product::where('product_id',$id)->update(['hot' => 1]);
        }
    }

    public function sortProduct(){
        $sort = $_POST['sort'];

        $product_menu_id = $_POST['product_menu_id'];
        
        Product_menu::where('product_menu_id',$product_menu_id)->update(['sort' => $sort]);
    }
    //end ajax  

    // get trang "chỉnh sửa" danh mucj category
    public function getEditCategory($id_edit){
        $functions = new Functions();
        // phân quyền
        $check = $functions->loadPageAdminTwo('category_edit','product',$id_edit);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $category = Category::where('category_id',$id_edit)->get()->toArray()[0];
        return view('admin.product.edit',compact('category'));

    }
    public function postEditCategory(RequestProduct $request ,$id_edit){
        $functions = new Functions();
        $data = request()->except(['_token']);
        $category = Category::where('category_id',$id_edit)->get()->toArray();
        $data = self::checkImages($request,$data,$category);
        $data['slug'] = $functions->convert($request->name);
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        
        $result = Category::where('category_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa  danh mục sản phẩm thành công";
        $str_fail = "Bạn đã chỉnh sửa danh mục sản phẩm thất bại";
        $url = "admin/product_manager";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }

    // get trang "thêm" danh mục sản phẩm
    public function getAddProductMenu($id_cat){

        $category = Category::where('category_id',$id_cat)->get()->toArray()[0];
        return view('admin.product.add',compact('category'));

    }  

    public function postAddProductMenu(RequestProduct $request , $id_cat) {
        $functions = new Functions();
        $data = request()->except(['_token']);
        $data = self::checkImages($request,$data);
        $data['parent'] = 0;
        $data['slug'] = $functions->convert($request->name);
        
        if(Product_menu::where('category_id',$id_cat)->get('sort')->toArray() != []){
            $max_sort = Product_menu::where('category_id',$id_cat)->OrderBy('sort','DESC')->get(['sort'])->toArray()[0]['sort'];
            $data['sort'] = $max_sort + 1 ;
        }else {
            $data['sort'] = 1;
        }
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = Product_menu::create($data);

        $str = "Bạn đã thêm  danh mục sản phẩm thành công";
        $str_fail = "Bạn đã thêm danh mục sản phẩm thất bại";
        $url = "admin/product_manager";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function getAddProductMenu2($id_cat,$id_product){
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('product_menu_add','product',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $category = Category::where('category_id',$id_cat)->get()->toArray()[0];
        return view('admin.product.add',compact('category'));

    }
    public function postAddProductMenu2(RequestProduct $request , $id_cat , $id_product){
        $functions = new Functions();
        $data = request()->except(['_token']);
        $data = self::checkImages($request, $data);
        $data['parent'] = $id_product ;
        $data['slug'] = $functions->convert($request->name);
        $check = Product_menu::where('category_id',$id_cat)->where('parent',$id_product)->get('sort')->toArray() ;
        if($check != []){
            $max_sort = Product_menu::where('category_id',$id_cat)->where('parent',$id_product)->OrderBy('sort','DESC')->get(['sort'])->toArray()[0]['sort'];
            $data['sort'] = $max_sort + 1 ;
        }else {
            $data['sort'] = 1;
        }

        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        
        $result = Product_menu::create($data);

        $str = "Bạn đã thêm  danh mục sản phẩm thành công";
        $str_fail = "Bạn đã thêm danh mục sản phẩm thất bại";
        $url = "admin/product_manager";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
    // 
    // get trang "chỉnh sửa" danh mucj product_menu
    public function getEditProductMenu($id_edit){

        // phân quyền
        $functions = new Functions();
        $id_cat = Product_menu::where('product_menu_id',$id_edit)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('product_menu_edit','product',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $product_menu = Product_menu::where('product_menu_id',$id_edit)->get()->toArray()[0];
        $id_cat = $product_menu['category_id'];
        $category = Category::where('category_id',$id_cat)->get()->toArray()[0];
        return view('admin.product.edit_menu',compact('product_menu','category'));

    }
    public function postEditProductMenu(RequestProduct $request , $id_edit){
        $functions = new Functions();
        $product_menu = Product_menu::where('product_menu_id',$id_edit)->get()->toArray();
        $data = request()->except(['_token']);
        $data = self::checkImages($request,$data,$product_menu);
        $data['slug'] = $functions->convert($request->name);
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }

        $result = Product_menu::where('product_menu_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa  danh mục sản phẩm thành công";
        $str_fail = "Bạn đã chỉnh sửa danh mục sản phẩm thất bại";
        $url = "admin/product_manager";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
    // delete product_menu
    public function postDelProductMenu($id_del){
        // phân quyền
        $functions = new Functions();
        $product_del = Product_menu::where('product_menu_id',$id_del)->get()->toArray();

        if($product_del != []){
           $id_cat = Product_menu::where('product_menu_id',$id_del)->get()->pluck('category_id')->toArray()[0];
            $check = $functions->loadPageAdminTwo('product_menu_del','product',$id_cat);
            if($check){
                $str = 'Bạn không được cấp quyền vào trang này !';
                $url = 'home';
                return view('loadPage.loadPageAdmin',compact('str','url'));
            } 
        }
        
        // hết phân quyền

        $str = "Bạn đã xóa  danh mục sản phẩm thành công";
        $str_fail = "Bạn đã xóa danh mục sản phẩm thất bại";
        $url = "admin/product_manager";

        $result = Product_menu::where('product_menu_id',$id_del)->delete();

        if($result){
            Product_menu::where('parent',$id_del)->delete();
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return redirect('admin/product_manager');
        }

    }

    // get danh sachs product cua tung dnah muc (table:products)
    public function getProduct($id_product_menu){
        // phân quyền
        $functions = new Functions();
        $id_cat = Product_menu::where('product_menu_id',$id_product_menu)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('product_list','product',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        if(Gallery_menu::where('name','Partner')->get()->toArray() != []){
            $id_gal_partner = Gallery_menu::where('name','Partner')->get()->toArray()[0]['gallery_menu_id'];
        }else {
            $id_gal_partner = 6;
        }
        
        $product = Product::where('product_menu_id',$id_product_menu)->get();
        return view('admin.product.list',compact('id_product_menu','product','id_gal_partner'));
        
    }
    // add product list
    public function getAddProduct($id_product_menu){
        // phân quyền
        $functions = new Functions();
        $id_cat = Product_menu::where('product_menu_id',$id_product_menu)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('product_add','product',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $producer = Other::where('others_menu_id',71)->get();
        $product_menu = Product_menu::where('product_menu_id',$id_product_menu)->get()->toArray()[0];
        return view('admin.product.add_list',compact('product_menu','producer'));

    }

    function formatNumberToInt($text) {

        $text = str_replace(".", "", $text);

        return $text+0;

    }


    public function postAddProduct(RequestProduct $request,$id_product_menu){
        $functions = new Functions();
        $data = request()->except(['_token']);
        $data = self::checkImages($request,$data);
        $data['content'] = html_entity_decode($request->content);
        $data['slug'] = $functions->convert($request->name);
        $price = $request->price;
        $sale = $request->sale;

        if($price == null || $price == 0){
            $data['price'] = 0;
        }else{
            $data['price'] = self::formatNumberToInt($price);
        }

        if($sale == null || $sale == 0){
            $data['sale'] = 0;
        }else {
            $data['sale'] = self::formatNumberToInt($sale);
        }


        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        if($request->combo == null){
            $data['combo'] = 0;
        }
        if($request->pin == null){
            $data['pin'] = 0;
        }

        $result = Product::create($data);

        $str = "Bạn đã thêm sản phẩm thành công";
        $str_fail = "Bạn đã thêm sản phẩm thất bại";
        $url = "admin/product_manager";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
    // edit product list
    public function getEditProduct($id_edit){
        // phân quyền
        $functions = new Functions();
        $id_product_menu = Product::where('product_id',$id_edit)->get()->pluck('product_menu_id')->toArray()[0];
        $id_cat = Product_menu::where('product_menu_id',$id_product_menu)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('product_edit','product',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $product = Product::where('product_id',$id_edit)->get()->toArray()[0];
        $product_menu = Product_menu::where('product_menu_id',$product['product_menu_id'])->get()->toArray()[0];
        $producer = Other::where('others_menu_id',71)->get();
        return view('admin.product.edit_list',compact('product','product_menu','producer'));
    }
    public function postEditProduct(RequestProduct $request,$id_edit){
        $functions = new Functions();
        $product = Product::where('product_id',$id_edit)->get()->toArray();
        $data = request()->except(['_token']);
        $data = self::checkImages($request,$data,$product);
        $data['slug'] = $functions->convert($request->name);
        $price = $request->price;
        $sale = $request->sale;
        if($price == null || $price == 0){
            $data['price'] = 0;
        }else{
            $data['price'] = self::formatNumberToInt($price);
        }
        if($sale == null || $sale == 0){
            $data['sale'] = 0;
        }else {
            $data['sale'] = self::formatNumberToInt($sale);
        }
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        if($request->combo == null){
            $data['combo'] = 0;
        }
        if($request->pin == null){
            $data['pin'] = 0;
        }
        $result = Product::where('product_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa sản phẩm thành công";
        $str_fail = "Bạn đã chỉnh sửa sản phẩm thất bại";
        $url = "admin/product_manager";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }
    // delete product list
    public function postDelProduct(Request $request,$id_product_menu){
         // phân quyền
        $functions = new Functions();
        $product = Product::where('product_menu_id',$id_product_menu)->get()->pluck('product_id');
        if($product != ''){
            $id_cat = Product_menu::where('product_menu_id',$id_product_menu)->get()->pluck('category_id')->toArray()[0];
            $check = $functions->loadPageAdminTwo('product_del','product',$id_cat);
            if($check){
                $str = 'Bạn không được cấp quyền vào trang này !';
                $url = 'home';
                return view('loadPage.loadPageAdmin',compact('str','url'));
            }
        }
        // hết phân quyền
        $product_database = Product::where('product_menu_id',$id_product_menu)->get()->pluck('product_id')->toArray();
        $remove = $request->delete ;

        if($remove != null){

            foreach($remove as $removes){
                if(in_array($removes,$product_database)){

                    $result = Product::where('product_id',$removes)->delete();

                }
            }

        }else {
            return redirect()->back();
        }

        $str = "Bạn đã xóa  sản phẩm thành công";
        $str_fail = "Bạn đã xóa sản phẩm thất bại";
        $url = "admin/product_manager";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return redirect('admin/product_manager');
        }
    }
    // kiểm tra hình ảnh
    public function checkImages($request,$data,$database = ''){
        if($request->hasFile('images')){
            $file = $request->images;
            // Tên files (Name)
            $file_name = $file->getClientOriginalName();
            // đuôi file (Extension)
            $file_tail = $file->getClientOriginalExtension();
            // đường dẫn tạm thời
            $file_temp = $file->getRealPath();
            // kích cỡ file
            $file_syze = $file->getSize();
            // Kiểu file 
            $file_type = $file->getMimeType();
            // =----------UPLOAD----------
            $data['images'] = $file_name ;
            $path ='upload/product/' . $file_name;
            $images = Image::make($request->file('images')->getRealPath())->resize(300, 300)->save($path);
        }else if($database != ''){
            if($database[0]['images'] !== 'no' && isset($database[0]['images']))
            {
                $data['images'] = $database[0]['images'];
            }else {
                $data['images'] = 'no';
            }
            
        }else {
            $data['images'] = 'no';
        }
        // ---------------- File upload (nhieu hinh)-----------
        if($request->hasFile('upload_images')){
            $upload_images = [];
            foreach ($request->upload_images as $key => $images) {
                $file = $images;
                // Tên files (Name)
                $file_name = $file->getClientOriginalName();
                // đuôi file (Extension)
                $file_tail = $file->getClientOriginalExtension();
                // đường dẫn tạm thời
                $file_temp = $file->getRealPath();
                // kích cỡ file
                $file_syze = $file->getSize();
                // Kiểu file 
                $file_type = $file->getMimeType();

                // =----------UPLOAD----------
                array_push($upload_images,$file_name);

                $path ='upload/product/' . $file_name;

                $images = Image::make($images->getRealPath())->resize(300, 300)->save($path);
            }

            $data['upload_images'] = json_encode($upload_images);
        }else if($database != ''){
            if($database[0]['upload_images'] !== 'no' && isset($database[0]['upload_images']))
            {
                $data['upload_images'] = $database[0]['upload_images'];
            }else {
                $data['upload_images'] = 'no';
            }
            
        }else{
            $data['upload_images'] = 'no';
        }

        return $data;
    }
    
}
