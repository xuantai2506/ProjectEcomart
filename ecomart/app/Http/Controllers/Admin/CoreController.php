<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoreRole;
use App\Models\CoreUser;
use App\Models\Category;
use App\Models\Article_menu;
use App\Models\Gallery_menu;
use App\User;
use App\Http\Requests\admin\RequestCore;
use App\Http\Requests\admin\RequestCoreUser;
use App\Http\Controllers\Functions;
use Intervention\Image\ImageManagerStatic as Image;
class CoreController extends Controller
{
    public function getCoreRole(){
       
        // phân quyền       
        $functions = new Functions();

        $check = $functions->loadPageAdmin('core_role','core');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
    	$core_role = CoreRole::all();

    	return view('admin.core.core-role',compact('core_role'));

    }

    // ajax
    public function showCoreRole(){

    	$id = $_POST['id'];

    	$is_active = CoreRole::where('role_id',$id)->pluck('is_active')->toArray()[0];
    	
    	if($is_active == 1){
    		CoreRole::where('role_id',$id)->update(['is_active' => 0] );
    	}else {
    		CoreRole::where('role_id',$id)->update(['is_active' => 1] );
    	}

    }

    // -- ajax user 
    public function isActiveCoreUser(){

        $id = $_POST['id'];

        $is_active = CoreUser::where('user_id',$id)->pluck('is_active')->toArray()[0];
        
        if($is_active == 1){
            CoreUser::where('user_id',$id)->update(['is_active' => 0] );
        }else {
            CoreUser::where('user_id',$id)->update(['is_active' => 1] );
        }

    }

    public function showCoreUser(){

        $id = $_POST['id'];

        $is_show = CoreUser::where('user_id',$id)->pluck('is_show')->toArray()[0];
        
        if($is_show == 1){
            CoreUser::where('user_id',$id)->update(['is_show' => 0] );
        }else {
            CoreUser::where('user_id',$id)->update(['is_show' => 1] );
        }
    }

    // end ajax

    public function getCoreRoleAdd(){

    	return view('admin.core.role_add');

    }

    public function postCoreRoleAdd(RequestCore $request){

    	$data = request()->except(['_token']);
    	
    	if($request->is_active == null){
    		$data['is_active'] = 0 ;
    	}

    	$result = CoreRole::create($data);

    	$str = "Bạn đã thêm   thành công";
        $str_fail = "Bạn đã thêm thất bại";
        $url = "admin/core-role";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    // edit role
    public function getCoreRoleEdit($id_edit){

    	$get_core_role = CoreRole::where('role_id',$id_edit)->get()->toArray()[0];

    	return view('admin.core.role_edit',compact('get_core_role'));

    }

    public function postCoreRoleEdit(RequestCore $request,$id_edit){

    	$data = request()->except(['_token']);

    	$result = CoreRole::where('role_id',$id_edit)->update($data);

    	$str = "Bạn đã chỉnh sửa   thành công";
        $str_fail = "Bạn đã chỉnh sửa thất bại";
        $url = "admin/core-role";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function postDelCoreRole(Request $request){

        $str = "Bạn đã xóa   thành công";
        $str_fail = "Bạn đã xóa thất bại";
        $url = "admin/core-role";

        $core_role_database = CoreRole::get()->pluck('role_id')->toArray();

        $remove = $request->delete ;

        if($remove != null){

            foreach($remove as $removes){
                if(in_array($removes,$core_role_database)){

                    $result = CoreRole::where('role_id',$removes)->delete();

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


    // core_user
    public function getCoreUser(){

        // phân quyền       
        $functions = new Functions();

        $check = $functions->loadPageAdmin('core_user','core');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $core_role = CoreRole::all();

    	$core_user = CoreUser::all();

    	return view('admin.core.core-user',compact('core_user','core_role'));

    }

    public function getCoreUserAdd(){

    	$core_role = CoreRole::all();

    	return view('admin.core.user_add',compact('core_role'));

    }

    public function postCoreUserAdd(Request $request){

    	$data = request()->except(['_token']);

    	$data = self::checkImages($request,$data);

    	$data['birthday'] = $request->birthday;

    	$data['sort'] = 0;

        $data['password'] = bcrypt($request->password);

    	if($request->is_show == null){
    		$data['is_show'] = 0;
    	}

    	if($request->is_active == null){
    		$data['is_active'] = 0 ;
    	}

        $checkEmail = User::where('email',$request->email)->first();

        if($checkEmail){
            return redirect()->back()->with('fail','Tài khoản đã tồn tại ,Vui lòng nhập tài khoản khác');
        }else {

            if($request->role_id == 2){
                User::create([
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'level' => 0
                ]);
            }else {
                User::create([
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'level' => 0
                ]);
            }

            $result = CoreUser::create($data);

            $str = "Bạn đã thêm   thành công";
            $str_fail = "Bạn đã thêm thất bại";
            $url = "admin/core-user";
            if($result){
                return view('uploadFileSuccess',compact('str','url'));
            }else {
                return view('uploadFileFail',compact('str_fail','url'));
            }

        }

        
    }

    public function getCoreUserEdit($id_edit){

        $get_core_user = CoreUser::where('user_id',$id_edit)->get()->toArray()[0];

        $core_role = CoreRole::all();

        return view('admin.core.user_edit',compact('get_core_user','core_role'));

    }

    public function postCoreUserEdit(Request $request,$id_edit){

        $core_user = CoreUser::where('user_id',$id_edit)->get()->toArray();

        $data = request()->except(['_token']);

        $data = self::checkImages($request,$data,$core_user);

        $password = CoreUser::where('user_id',$id_edit)->pluck('password')->toArray()[0];

        if($request->password == null && $request->password_confirmation == null){

            $data['password'] = $password;

        }else {

            $password = bcrypt($request->password);

        }

        if($request->role_id == 1){
            User::where('email',$core_user[0]['email'])->update([
                'name' => $request->full_name,
                'email' => $core_user[0]['email'],
                'password' => bcrypt($request->password),
                'level' => 0
            ]);
        }else {
            User::where('email',$core_user[0]['email'])->update([
                'name' => $request->full_name,
                'email' => $core_user[0]['email'],
                'password' => bcrypt($request->password),
                'level' => 0
            ]);
        }
        
        $result = CoreUser::where('user_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa   thành công";
        $str_fail = "Bạn đã chỉnh sửa thất bại";
        $url = "admin/core-user";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }

    public function postDelCoreUser(Request $request){

        $str = "Bạn đã xóa   thành công";
        $str_fail = "Bạn đã xóathất bại";
        $url = "admin/core-user";
        $core_user_database = CoreUser::get()->pluck('user_id')->toArray();

        $remove = $request->delete ;

        if($remove != null){
            foreach($remove as $removes){
                if(in_array($removes,$core_user_database)){
                    $email = CoreUser::where('user_id',$removes)->get()->pluck('email')->toArray()[0];
                    $result = User::where('email',$email)->delete();
                    $result = CoreUser::where('user_id',$removes)->delete();
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
            $path ='upload/admin/user/' . $file_name;
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
}
