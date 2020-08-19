<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Models\Category;
use App\Models\OtherMenu;
use App\Models\Other;
use App\Http\Requests\admin\RequestOtherMenu;
use App\Http\Controllers\Functions;
use Intervention\Image\ImageManagerStatic as Image;
class OtherController extends Controller
{

    public function index()
    {
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdmin('others_manager','category');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $sort_category = Category::where('type_id',15)->get()->pluck('sort')->count();
        $sort_other = OtherMenu::get(['category_id','sort','parent']);
        $category = Category::where('type_id',15)->OrderBy('sort','ASC')->get();
        $other_menu = OtherMenu::OrderBy('sort','ASC')->get();

        return view('admin.other.manager',compact('category','other_menu','sort_category','sort_other'));
    }

    // ajax
    public function showOtherMenu(){
        $id_others_menu = $_POST['id'];
        $is_active = OtherMenu::where('others_menu_id',$id_others_menu)->pluck('is_active')[0];
        if($is_active == 1){
            OtherMenu::where('others_menu_id',$id_others_menu)->update(['is_active' => 0]);
        }else {
            OtherMenu::where('others_menu_id',$id_others_menu)->update(['is_active' => 1]);
        }
    }
    public function hotOtherMenu(){
        $id_others_menu = $_POST['id'];
        $hot = OtherMenu::where('others_menu_id',$id_others_menu)->pluck('hot')[0];
        if($hot == 1){
            OtherMenu::where('others_menu_id',$id_others_menu)->update(['hot' => 0]);
        }else {
            OtherMenu::where('others_menu_id',$id_others_menu)->update(['hot' => 1]);
        }
    }
    public function showOther(){
        $id_others = $_POST['id'];
        $is_active = Other::where('others_id',$id_others)->pluck('is_active')[0];
        if($is_active == 1){
            Other::where('others_id',$id_others)->update(['is_active' => 0]);
        }else {
            Other::where('others_id',$id_others)->update(['is_active' => 1]);
        }
    }
    public function hotOther(){
        $id_others = $_POST['id'];
        $hot = Other::where('others_id',$id_others)->pluck('hot')[0];
        if($hot == 1){
            Other::where('others_id',$id_others)->update(['hot' => 0]);
        }else {
            Other::where('others_id',$id_others)->update(['hot' => 1]);
        }
    }

    public function sortCategory(){

        $sort = $_POST['sort'];

        $category_id = $_POST['category_id'];

        Category::where('category_id',$category_id)->update(['sort' => $sort]);

    }

    public function sortOthersMenu(){

        $sort = $_POST['sort'];

        $others_menu_id = $_POST['others_menu_id'];

        OtherMenu::where('others_menu_id',$others_menu_id)->update(['sort' => $sort]);

    }
    //end ajax
    // them danh muc other_menu
    public function getAddOtherMenu($id_cat){
        $category = Category::where('category_id',$id_cat)->get()->toArray()[0];
        return view('admin.other.add_menu',compact('category'));

    }
    public function postAddOtherMenu(RequestOtherMenu $request,$id_cat){

        $data = request()->except(['_token']);
        $data['parent'] = 0;
        
        if(OtherMenu::where('category_id',$id_cat)->get('sort')->toArray() != []){
            $max_sort = OtherMenu::where('category_id',$id_cat)->OrderBy('sort','DESC')->get(['sort'])->toArray()[0]['sort'];
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
        
        $result = OtherMenu::create($data);

        $str = "Bạn đã thêm  danh mục  thành công";
        $str_fail = "Bạn đã thêm danh mục thất bại";
        $url = "admin/others_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }
    // edit danh muc other_menu
    public function getEditOtherMenu($id_edit){

        $id_cat = OtherMenu::where('others_menu_id',$id_edit)->get()->toArray()[0]['category_id'];
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('others_menu_edit','others',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $category = Category::where('category_id',$id_cat)->get()->toArray()[0];
        $other_menu = OtherMenu::where('others_menu_id',$id_edit)->get()->toArray()[0];
        return view('admin.other.edit_menu',compact('other_menu','category'));

    }
    public function postEditOtherMenu(RequestOtherMenu $request, $id_edit){

        $data = request()->except(['_token']);

        if($request->is_active == null){
            $data['is_active'] = 0;
        }
        if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = OtherMenu::where('others_menu_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa  danh mục thành công";
        $str_fail = "Bạn đã chỉnh sửa danh mục thất bại";
        $url = "admin/others_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
    // edit danh muc category -> other_menu
    public function getEditCategory($id_edit){
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('category_edit','others',$id_edit);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $category = Category::where('category_id',$id_edit)->get();
        return view('admin.other.edit',compact('category'));

    }
    public function postEditCategory(RequestOtherMenu $request,$id_edit){

        $category = Category::where('category_id',$id_edit)->get()->toArray();
        $data = request()->except(['_token']);
        $data = self::checkImages($request,$data,$category);
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = Category::where('category_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa  danh mục thành công";
        $str_fail = "Bạn đã chỉnh sửa danh mục thất bại";
        $url = "admin/others_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
    // delete danh muc other_menu
    public function postDelOtherMenu($id_del){

        // phân quyền
        $functions = new Functions();
        $other_del = OtherMenu::where('others_menu_id',$id_del)->get()->toArray();
        if($other_del != []){
            $id_cat = OtherMenu::where('others_menu_id',$id_del)->get()->toArray()[0]['category_id'];
            $check = $functions->loadPageAdminTwo('others_menu_del','others',$id_cat);

            if($check){
                $str = 'Bạn không được cấp quyền vào trang này !';
                $url = 'home';
                return view('loadPage.loadPageAdmin',compact('str','url'));
            }
        }
        
        // hết phân quyền
        $str = "Bạn đã xóa  thành công";
        $str_fail = "Bạn đã xóa hình ảnh thất bại";
        $url = "admin/others_manager";

        $result = OtherMenu::where('others_menu_id',$id_del)->delete();
        if($result){
            Other::where('others_menu_id',$id_del)->delete();
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return redirect('admin/others_manager');
        }
        
    }

    // list danh sach others
    public function getListOther($id_others_menu){

        // phân quyền
        $functions = new Functions();
        $id_cat = OtherMenu::where('others_menu_id',$id_others_menu)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('others_list','others',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $other = Other::where('others_menu_id',$id_others_menu)->get()->toArray();
        return view('admin.other.list',compact('other','id_others_menu'));

    }
    // add danh sach others
    public function getAddListOther($id_others_menu){
        // phân quyền
        $functions = new Functions();
        $id_cat = OtherMenu::where('others_menu_id',$id_others_menu)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('others_add','others',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $other_menu = OtherMenu::where('others_menu_id',$id_others_menu)->get()->toArray()[0];
        return view('admin.other.add_list',compact('other_menu'));

    }
    public function postAddListOther(RequestOtherMenu $request ,$id_others_menu){
        $data = request()->except(['_token']);
        $data['sort'] = 0;
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
        if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = Other::create($data);

        $str = "Bạn đã thêm thành công";
        $str_fail = "Bạn đã thêm thất bại";
        $url = "admin/others_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }
    // edit danh sach others
    public function getEditListOther($id_edit){
        // phân quyền
        $functions = new Functions();
        $id_others_menu = Other::where('others_id',$id_edit)->get()->pluck('others_menu_id')->toArray()[0];
        $id_cat = OtherMenu::where('others_menu_id',$id_others_menu)->get()->pluck('category_id')->toArray()[0];

        $check = $functions->loadPageAdminTwo('others_edit','others',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $other = Other::where('others_id',$id_edit)->get()->toArray()[0];
        $id_others_menu = $other['others_menu_id'];
        $other_menu = OtherMenu::where('others_menu_id',$id_others_menu)->get()->toArray()[0];
        return view('admin.other.edit_list',compact('other','other_menu'));

    }
    public function postEditListOther(RequestOtherMenu $request,$id_edit){

        $data = request()->except(['_token']);

        if($request->is_active == null){
            $data['is_active'] = 0;
        }
        if($request->hot == null){
            $data['hot'] = 0;
        }

        $result = Other::where('others_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa   thành công";
        $str_fail = "Bạn đã chỉnh sửa  thất bại";
        $url = "admin/others_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    // delete danh sach other
    public function postDelOthers(Request $request,$id_others_menu){
         // phân quyền
        $functions = new Functions();
        $other = Other::where('others_menu_id',$id_others_menu)->get()->pluck('others_id');

        if($other != ''){
            $id_cat = OtherMenu::where('others_menu_id',$id_others_menu)->get()->pluck('category_id')->toArray()[0];
            $check = $functions->loadPageAdminTwo('others_del','others',$id_cat);
            if($check){
                $str = 'Bạn không được cấp quyền vào trang này !';
                $url = 'home';
                return view('loadPage.loadPageAdmin',compact('str','url'));
            }
        }
        // hết phân quyền

        $str = "Bạn đã xóa  thành công";
        $str_fail = "Bạn đã xóa hình ảnh thất bại";
        $url = "admin/others_manager";

        $others_database = Other::where('others_menu_id',$id_others_menu)->get()->pluck('others_id')->toArray();
        $remove = $request->delete ;

        if($remove != null){
            foreach($remove as $removes){
                if(in_array($removes,$others_database)){

                    $result = Other::where('others_id',$removes)->delete();

                }
            }
        }else {
            return redirect()->back();
        }
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return redirect('admin/others_manager');
        }
    }

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
            $path ='upload/others/' . $file_name;
            $images = Image::make($request->file('images')->getRealPath())->resize(100, 100)->save($path);
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
