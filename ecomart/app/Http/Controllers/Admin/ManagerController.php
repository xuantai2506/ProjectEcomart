<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Models\RegisterEmail;
use App\Models\Page;
use App\Models\Contact;
use App\Http\Controllers\Functions;

class ManagerController extends Controller
{
    // public function loadPageAdmin($str){
        
    //     $role_id = CoreUser::where('email',Auth::user()->email)->get()->pluck('role_id')->toArray()[0];

    //     $category_privilege = CorePrivilege::where('role_id',$role_id)->where('type','category')->get()->pluck('privilege_slug')->toArray();

    //     $check = !in_array($str,$category_privilege) ;

    //     return $check;

    // }

    public function getAgencyManager(){
        $functions = new Functions();
        // phân quyền

        $check = $functions->loadPageAdmin('contact_list','category');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $get_contact = Contact::all();

    	return view('admin.manager.agency',compact('get_contact'));

    }

    public function postIsActiveContact(){

        $contact_id = $_POST['id_contact'];

        $is_active = Contact::where('contact_id',$contact_id)->get()->pluck('is_active')[0];

        if($is_active == 0){
            Contact::where('contact_id',$contact_id)->update(['is_active' => 1]);
        }else {
            Contact::where('contact_id',$contact_id)->update(['is_active' => 0]);
        }

    }

    public function postDelAgency(Request $request){

        $str = "Bạn đã xóa đại lý thành công";
        $str_fail = "Bạn đã  xóa đại lý thất bại";
        $url = "admin/agency_manager";

        $agency_database = Contact::get()->pluck('contact_id')->toArray();
        $remove = $request->delete ;
        if($remove != null){ 
            foreach($remove as $removes){
                if(in_array($removes,$agency_database)){

                    $result = Contact::where('contact_id',$removes)->delete();

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

    public function getEmailManager(){

        // phân quyền
        $functions = new Functions();

        $check = $functions->loadPageAdmin('register_email','category');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

    	$get_register_email = RegisterEmail::all();

    	return view('admin.manager.email',compact('get_register_email'));

    }

    public function postDelEmailManager(Request $request){
    	$str = "Bạn đã xóa email thành công";
        $str_fail = "Bạn đã xóa  email thất bại";
        $url = "admin/home";

        $email_database = RegisterEmail::get()->pluck('register_email_id')->toArray();
        $remove = $request->delete ;

        if($remove != null){
            foreach($remove as $removes){
                if(in_array($removes,$email_database)){

                    $result = RegisterEmail::where('register_email_id',$removes)->delete();

                }
            }
        }else  {
            return redirect()->back();
        }
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }

    public function getPlusManager(){
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdmin('plus_list','category');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $get_page = Page::all();

    	return view('admin.manager.plus',compact('get_page'));

    }

    public function postDelPlus(Request $request){
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdmin('plugin_page_del','pages');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $str = "Bạn đã xóa phần bổ sung thành công";
        $str_fail = "Bạn đã xóa phần bổ sung thất bại";
        $url = "admin/home";

        $plus_database = Page::get()->pluck('page_id')->toArray();
        $remove = $request->delete ;
        
        if($remove != null){
            foreach($remove as $removes){
                if(in_array($removes,$plus_database)){

                    $result = Page::where('page_id',$removes)->delete();

                }
            }
        }else{
            return redirect()->back();
        }

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }


    public function getPlusAdd(){
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdmin('plugin_page_add','pages');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        return view('admin.manager.plus_add');
    }

    public function postPlusAdd(Request $request){

        $functions = new Functions();

        $data = request()->except(['_token']);

        $data['alias'] = $functions->convert($request->alias);

        if($request->is_active == null){
            $data['is_active'] = 0;
        }

        $result = Page::create($data);

        $str = "Bạn đã thêm phần bổ sung thành công";
        $str_fail = "Bạn đã thêm phần bổ sung thất bại";
        $url = "admin/home";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }

    public function getPlusEdit(Request $request , $id_edit){
        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdmin('plugin_page_edit','pages');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $get_page_edit = Page::where('page_id',$id_edit)->get()->toArray()[0];

        return view('admin.manager.plus_edit',compact('get_page_edit'));

    }

    public function postPlusEdit(Request $request,$id_edit){

        $data = request()->except(['_token']);

        $result = Page::where('page_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa phần bổ sung thành công";
        $str_fail = "Bạn đã chỉnh sửa phần bổ sung thất bại";
        $url = "admin/home";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function getIsActivePage(){
        $id = $_POST['id'];
        $is_active = Page::where('page_id',$id)->get()->pluck('is_active')[0];
        if($is_active == 1){
            Page::where('page_id',$id)->update(['is_active'=>0]);
        }else {
            Page::where('page_id',$id)->update(['is_active'=>1]);
        }
    }


}
