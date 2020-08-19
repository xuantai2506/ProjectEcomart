<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Models\Constant;
use App\Http\Controllers\Functions;
class ConfigController extends Controller
{

    // public function loadPageAdmin($str,$arr_privilege_slug){

    //     $check = !in_array($str,$arr_privilege_slug) ;

    //     return $check;

    // }

    // config general
    public function getConfigGeneral(){

        // phân quyền
        $functions  = new Functions();

        $check = $functions->loadPageAdmin('config_general','config');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

    	$getConstant = Constant::where('type',0)->orderBy('sort','ASC')->get();

    	return view('admin.config.config-general',compact('getConstant'));

    }

    public function postConfigGeneral(Request $request){

    	$data = $request->all();

    	$data_name = $data['name_constant'];

    	$data_value = $data['value_constant'];

    	foreach ($data_name as $key => $name) {

    		$result = Constant::where('constant',$name)->update(['value' => $data_value[$key]]);

    	}

    	$str = "Bạn đã chỉnh sửa   thành công";
        $str_fail = "Bạn đã chỉnh sửa thất bại";
        $url = "admin/config-general";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }
    // config-smtp
    public function getConfigSMTP(){

        // phân quyền
        $functions  = new Functions();
        $check = $functions->loadPageAdmin('config_smtp','config');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $getConstant = Constant::where('type',1)->orderBy('constant_id','DESC')->get();

    	return view('admin.config.config-smtp',compact('getConstant'));

    }

    public function postConfigSMTP(Request $request){

        $data = $request->all();

        $data_name = $data['name_constant'];

        $data_value = $data['value_constant'];

        foreach ($data_name as $key => $name) {

            if($name == "SMTP_password"){

                $data_value_pass = bcrypt($data_value[$key]);

                $result = Constant::where('constant',$name)->update(['value' => $data_value_pass]);

            }

            $result = Constant::where('constant',$name)->update(['value' => $data_value[$key]]);

        }

        $str = "Bạn đã chỉnh sửa   thành công";
        $str_fail = "Bạn đã chỉnh sửa thất bại";
        $url = "admin/config-smtp";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
    }
    // config-time
    public function getConfigTime(){

        // phân quyền
        $functions  = new Functions();

        $check = $functions->loadPageAdmin('config_datetime','config');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $getConstant = Constant::where('type',3)->orderBy('sort','ASC')->get();

    	return view('admin.config.config-time',compact('getConstant'));

    }

    public function postConfigTime(Request $request){

        $data = $request->all();

        $data_name = $data['name_constant'];

        $data_value = $data['value_constant'];

        foreach ($data_name as $key => $name) {

            $result = Constant::where('constant',$name)->update(['value' => $data_value[$key]]);

        }

        $str = "Bạn đã chỉnh sửa   thành công";
        $str_fail = "Bạn đã chỉnh sửa thất bại";
        $url = "admin/config-time";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }


    }

    public function getConfigNetwork(){

        // phân quyền
        $functions  = new Functions();

        $check = $functions->loadPageAdmin('config_socialnetwork','config');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $getConstant = Constant::where('type',5)->orderBy('sort','ASC')->get();

    	return view('admin.config.config-network',compact('getConstant'));

    }

    public function postConfigNetwork(Request $request){

        $data = $request->all();

        $data_name = $data['name_constant'];

        $data_value = $data['value_constant'];

        foreach ($data_name as $key => $name) {

            $result = Constant::where('constant',$name)->update(['value' => $data_value[$key]]);

        }


        $str = "Bạn đã chỉnh sửa   thành công";
        $str_fail = "Bạn đã chỉnh sửa thất bại";
        $url = "admin/config-network";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }
}
