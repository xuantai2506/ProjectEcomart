<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Models\Category;
use App\Models\Gallery_menu;
use App\Models\Gallery;
use App\Http\Requests\admin\RequestGalleryMenu;
use App\Http\Controllers\Functions;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryController extends Controller
{
    
    public function index()
    {

        // phân quyền  
        $functions = new Functions();     

        $check = $functions->loadPageAdmin('gallery_manager','category');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $sort_category = Category::where('type_id',2)->get()->pluck('sort')->count();
        $sort_gallery = Gallery_menu::get(['category_id','sort','parent']);
        // nếu thương hiệu cho từng sản phẩm thì xài cái dưới (dòng 38)
        // $category = Category::where('type_id',2)->OrderBy('sort','ASC')->whereNotIn('name',['Partner'])->get();
        $category = Category::where('type_id',2)->OrderBy('sort','ASC')->get();
        $gallery_menu = Gallery_menu::OrderBy('sort','ASC')->get();

        return view('admin.gallery.manager',compact('category','gallery_menu','sort_category','sort_gallery'));

    }

    // ajax
    public function showCategoryGallery(){

        $id_cat = $_POST['id'];
        $is_active = Category::where('category_id',$id_cat)->pluck('is_active')[0];
        if($is_active == 1){
            Category::where('category_id',$id_cat)->update(['is_active' => 0]);
        }else {
            Category::where('category_id',$id_cat)->update(['is_active' => 1]);
        }

    }
    public function hotCategoryGallery(){

        $id_cat = $_POST['id'];
        $hot = Category::where('category_id',$id_cat)->pluck('hot')[0];
        if($hot == 1){
            Category::where('category_id',$id_cat)->update(['hot' => 0]);
        }else {
            echo $id_cat;
            Category::where('category_id',$id_cat)->update(['hot' => 1]);
        }

    }

    public function showGalleryMenu(){

        $id_gal = $_POST['id'];
        $is_active = Gallery_menu::where('gallery_menu_id',$id_gal)->pluck('is_active')[0];
        if($is_active == 1){
            Gallery_menu::where('gallery_menu_id',$id_gal)->update(['is_active' => 0]);
        }else {
            Gallery_menu::where('gallery_menu_id',$id_gal)->update(['is_active' => 1]);
        }

    }

    public function hotGalleryMenu(){

        $id_gal = $_POST['id'];
        $hot = Gallery_menu::where('gallery_menu_id',$id_gal)->pluck('hot')[0];
        if($hot == 1){
            Gallery_menu::where('gallery_menu_id',$id_gal)->update(['hot' => 0]);
        }else {
            Gallery_menu::where('gallery_menu_id',$id_gal)->update(['hot' => 1]);
        }

    }

    public function showGallery(){

        $id_gal = $_POST['id'];
        $is_active = Gallery::where('gallery_id',$id_gal)->pluck('is_active')[0];
        if($is_active == 1){
            Gallery::where('gallery_id',$id_gal)->update(['is_active' => 0]);
        }else {
            Gallery::where('gallery_id',$id_gal)->update(['is_active' => 1]);
        }

    }

    public function hotGallery(){

        $id_gal = $_POST['id'];
        $hot = Gallery::where('gallery_id',$id_gal)->pluck('hot')[0];
        if($hot == 1){
            Gallery::where('gallery_id',$id_gal)->update(['hot' => 0]);
        }else {
            Gallery::where('gallery_id',$id_gal)->update(['hot' => 1]);
        }

    }

    public function sortCategoryGallery(){

        $sort = $_POST['sort'];

        $category_id = $_POST['category_id'];

        Category::where('category_id',$category_id)->update(['sort' => $sort]);
    }

    public function sortGallery(){

        $sort = $_POST['sort'];

        $gal_id = $_POST['gal_id'];
        
        Gallery_menu::where('gallery_menu_id',$gal_id)->update(['sort' => $sort]);

    }

    // end ajax


    // edit category gallery (table : category)
    public function getEditCategory($id_edit){
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('category_edit','gallery',$id_edit);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $category = Category::where('type_id',2)->where('category_id',$id_edit)->get();
        return view('admin.gallery.edit',compact('category'));

    }

    // add gallery_menu (table : gallery_menu)
    public function getAddGalleryMenu($id_cat){

        $category = Category::where('category_id',$id_cat)->get()->toArray()[0];
        return view('admin.gallery.add_menu',compact('category'));

    }
    public function postAddGalleryMenu(RequestGalleryMenu $request,$id_cat){
        $functions = new Functions();

        $data = request()->except(['_token']);
        $data = self::checkImages($request , $data );
        $data['slug'] = $functions->convert($request->name);
        $data['parent'] = 0;
        if(Gallery_menu::where('category_id',$id_cat)->get('sort')->toArray() != []){
            $max_sort = Gallery_menu::where('category_id',$id_cat)->OrderBy('sort','DESC')->get(['sort'])->toArray()[0]['sort'];
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
        
        $result = Gallery_menu::create($data);

        $str = "Bạn đã thêm  danh mục hình ảnh thành công";
        $str_fail = "Bạn đã thêm danh mục hình ảnh thất bại";
        $url = "admin/gallery_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
    public function getAddGalleryMenu2($id_cat,$id_menu_gal){
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('gallery_menu_add','gallery',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $gallery_menu = Gallery_menu::where('gallery_menu_id',$id_menu_gal)->get()->toArray()[0];
        return view('admin.gallery.add_menu',compact('gallery_menu'));
    }

    public function postAddGalleryMenu2(RequestGalleryMenu $request ,$id_cat,$id_menu_gal){

        $functions = new Functions();
        $data = request()->except(['_token']);
        $data = self::checkImages($request,$data);
        $data['slug'] = $functions->convert($request->name);
        $data['parent'] = $id_menu_gal;

        if(Gallery_menu::where('parent',$id_menu_gal)->get('sort')->toArray() != []){
            $max_sort = Gallery_menu::where('parent',$id_menu_gal)->OrderBy('sort','DESC')->get(['sort'])->toArray()[0]['sort'];
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

        $result = Gallery_menu::create($data);

        $str = "Bạn đã thêm danh mục hình ảnh thành công";
        $str_fail = "Bạn đã thêm danh mục hình ảnh thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
     public function postEditCategory(Request $request,$id_edit){
        $functions = new Functions();
        $category_edit = Category::where('category_id',$id_edit)->get()->toArray();
        $data = request()->except(['_token']);
        $data['slug'] = $functions->convert($request->name);
        $data = self::checkImages($request,$data,$category_edit);

        $result = Category::where('type_id',2)->where('category_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa danh mục hình ảnh thành công";
        $str_fail = "Bạn đã chỉnh sửa danh mục hình ảnh thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
    // edit gallery_menu (table : gallery_menu)
    public function getEditGalleryMenu($id_edit){
        // phân quyền
        $functions = new Functions();
        $id_cat = Gallery_menu::where('gallery_menu_id',$id_edit)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('gallery_menu_edit','gallery',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $gallery_menu = Gallery_menu::where('gallery_menu_id',$id_edit)->get();
        return view('admin.gallery.edit',compact('gallery_menu'));

    }
    public function postEditGalleryMenu(Request $request ,$id_edit){
        $functions = new Functions();
        $data = request()->except(['_token']);
        $data['slug'] = $functions->convert($request->name);
        $gallery_menu = Gallery_menu::where('gallery_menu_id',$id_edit)->get()->toArray();
        $data = self::checkImages($request , $data , $gallery_menu);
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = Gallery_menu::where('gallery_menu_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa danh mục hình ảnh thành công";
        $str_fail = "Bạn đã chỉnh sửa danh mục hình ảnh thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
    // Xoas gallery_menu
    public function postDelGallery($id_del){

        // phân quyền
        $functions = new Functions();
        $id_cat = Gallery_menu::where('gallery_menu_id',$id_del)->get()->pluck('category_id')->toArray();
        if($id_cat != []){
           $check = $functions->loadPageAdminTwo('gallery_menu_del','gallery',$id_cat[0]); 
        }else {
            $check = false ;
        }

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $str = "Bạn đã xóa danh mục hình ảnh thành công";
        $str_fail = "Bạn đã xóa danh mục hình ảnh thất bại";
        $url = "admin/article_manager";

        $result = Gallery_menu::where('gallery_menu_id',$id_del)->delete();
        if($result){
            
            $id_del_gal = Gallery_menu::where('category_id',$id_del)->pluck('gallery_menu_id')->toArray();
            if($id_del_gal != []){
                Gallery::where('gallery_menu_id',$id_del_gal[0])->delete();
            }
            Gallery::where('gallery_menu_id',$id_del)->delete();
            Gallery_menu::where('parent',$id_del)->delete();

            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return redirect('admin/gallery_manager');
        }

    }

    // gallery_list (table :gallery)
    public function getGalleryList($id_menu_gal,$id_product = 0){
        // phân quyền
        $functions = new Functions();
        $id_cat = Gallery_menu::where('gallery_menu_id',$id_menu_gal)->get()->pluck('category_id')->toArray();
        if($id_cat != []){
            $id_cat = $id_cat[0];
        }else {
            $id_cat = 1 ;
        }
        
        $check = $functions->loadPageAdminTwo('gallery_list','gallery',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $gallery_list = Gallery::where('gallery_menu_id',$id_menu_gal)->where('product_menu_id',$id_product)->get();
        return view('admin.gallery.list',compact('id_menu_gal','gallery_list','id_product'));

    }


    public function getGalleryAdd( $id_menu_gal , $id_product){

        // phân quyền
        $functions = new Functions();
        $id_cat = Gallery_menu::where('gallery_menu_id',$id_menu_gal)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('gallery_add','gallery',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $gallery_menu = Gallery_menu::where('gallery_menu_id',$id_menu_gal)->get()->toArray()[0];
        return view('admin.gallery.add_list',compact('gallery_menu'));

    }
    public function postGalleryAdd(RequestGalleryMenu $request, $id_menu_gal ,$id_product ){
        $functions = new Functions();
        $data = request()->except(['_token']);
        $data = self::checkImages($request,$data,$database = '',$id_menu_gal);
        $data['product_menu_id'] = $id_product;
        $data['slug'] = $functions->convert($request->name);
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = Gallery::create($data);

        $str = "Bạn đã thêm hình ảnh thành công";
        $str_fail = "Bạn đã thêm hình ảnh thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }

    public function getGalleryEdit($id_edit , $id_menu_gal){
        // phân quyền
        $functions = new Functions();
        $id_cat = Gallery_menu::where('gallery_menu_id',$id_menu_gal)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('gallery_edit','gallery',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $gallery_menu = Gallery_menu::where('gallery_menu_id',$id_menu_gal)->get()->toArray()[0];
        $gallery = Gallery::where('gallery_id',$id_edit)->get()->toArray()[0];
        return view('admin.gallery.edit_list',compact('gallery_menu','gallery'));
    }

    public function postGalleryEdit(RequestGalleryMenu $request , $id_edit , $id_menu_gal){
        $functions = new Functions();
        $data = request()->except(['_token']);
        $gallery = Gallery::where('gallery_id',$id_edit)->get()->toArray();
        $data = self::checkImages($request , $data , $gallery,$id_menu_gal);
        $data['slug'] = $functions->convert($request->name);
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = Gallery::where('gallery_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa  hình ảnh thành công";
        $str_fail = "Bạn đã chỉnh sửa  hình ảnh thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }


    // xoas gallery 
    public function postDellGallery(Request $request ,$id_menu_gal){
        // phân quyền
        $functions = new Functions();
        $id_cat = Gallery_menu::where('gallery_menu_id',$id_menu_gal)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('gallery_del','gallery',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $str = "Bạn đã xóa  hình ảnh thành công";
        $str_fail = "Bạn đã xóa  hình ảnh thất bại";
        $url = "admin/article_manager";

        $gallery_database = Gallery::where('gallery_menu_id',$id_menu_gal)->get()->pluck('gallery_id')->toArray();
        $remove = $request->delete ;

        if($remove != null){

            foreach($remove as $removes){
                if(in_array($removes,$gallery_database)){

                    $result = Gallery::where('gallery_id',$removes)->delete();

                }
            }

        }else {
            return redirect()->back();
        }

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
        
    }


    // kiểm tra hình ảnh
    public function checkImages($request,$data,$database = '',$id_menu_gal = ''){

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
            $path ='upload/gallery/' . $file_name;
            if($id_menu_gal == 1){
                Image::make($request->file('images')->getRealPath())->resize(1600, 600)->save($path);
            }else if($id_menu_gal == 2){
                Image::make($request->file('images')->getRealPath())->resize(740, 420)->save($path);
            }else if($id_menu_gal ==3){
                Image::make($request->file('images')->getRealPath())->resize(570, 300)->save($path);
            }else if($id_menu_gal == 6){
                Image::make($request->file('images')->getRealPath())->resize(340, 170)->save($path);
            }else {
                Image::make($request->file('images')->getRealPath())->resize(150, 150)->save($path);
            }
            
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
        return $data;
    }

}
