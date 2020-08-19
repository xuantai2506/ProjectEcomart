<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\admin\RequestCategory;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.category.manager',compact('category'));
    }

    public function getAddCategory(){
        return view('admin.category.add');
    }
    public function postAddCategory(RequestCategory $request){
        $functions = new Functions();
        $data = request()->except(['_token']);
        $data['slug'] = $functions->convert($request->name);
        $data['sort'] = 1;
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = Category::create($data);
        if($result){
            return redirect()->back()->with('success','Thêm Thành Công');
        }else {
            return redirect()->back()->with('fail','Thêm Thất Bại');
        }

    }
}
