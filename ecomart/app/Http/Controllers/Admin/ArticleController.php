<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Article_menu;
use App\Models\Article;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Http\Requests\admin\RequestArticle;
use App\Http\Requests\admin\RequestAddArticle;
use App\Http\Controllers\Functions;
use Intervention\Image\ImageManagerStatic as Image;
class ArticleController extends Controller
{
    

    public function index()
    {      
        $functions = new Functions();
        // phân quyền       
        $check = $functions->loadPageAdmin('article_manager','category');

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        
        $sort_category = Category::where('type_id',1)->get()->pluck('sort')->count();
        $sort_article = Article_menu::get(['category_id','sort','parent']);
        $article_menu = Article_menu::OrderBy('sort','ASC')->get();
        $category_article = Category::where('type_id',1)->OrderBy('sort','ASC')->get();

        return view('admin.article.manager',compact('category_article','article_menu','sort_category','sort_article'));

    }
    // ajax
    public function showCategoryAricle(){

        $id_cat = $_POST['id'];
        $is_active = Category::where('category_id',$id_cat)->pluck('is_active')[0];
        if($is_active == 1){
            Category::where('category_id',$id_cat)->update(['is_active' => 0]);
        }else {
            Category::where('category_id',$id_cat)->update(['is_active' => 1]);
        }

    }
    public function hotCategoryAricle(){

        $id_cat = $_POST['id'];
        $hot = Category::where('category_id',$id_cat)->pluck('hot')[0];
        if($hot == 1){
            Category::where('category_id',$id_cat)->update(['hot' => 0]);
        }else {
            echo $id_cat;
            Category::where('category_id',$id_cat)->update(['hot' => 1]);
        }

    }
    public function showArticleMenu(){

        $id_art = $_POST['id'];
        $is_active = Article_menu::where('article_menu_id',$id_art)->pluck('is_active')[0];

        if($is_active == 1){
            Article_menu::where('article_menu_id',$id_art)->update(['is_active' => 0]);
        }else {
            Article_menu::where('article_menu_id',$id_art)->update(['is_active' => 1]);
        }

    }

    public function hotArticleMenu(){

        $id_art = $_POST['id'];
        $hot = Article_menu::where('article_menu_id',$id_art)->pluck('hot')[0];

        if($hot == 1){
            Article_menu::where('article_menu_id',$id_art)->update(['hot' => 0]);
        }else {
            Article_menu::where('article_menu_id',$id_art)->update(['hot' => 1]);
        }

    }

    public function showArticle(){

        $id_art = $_POST['id'];
        $is_active = Article::where('article_id',$id_art)->pluck('is_active')[0];
        
        if($is_active == 1){
            Article::where('article_id',$id_art)->update(['is_active' => 0]);
        }else {
            Article::where('article_id',$id_art)->update(['is_active' => 1]);
        }

    }

    public function hotArticle(){

        $id_art = $_POST['id'];
        $hot = Article::where('article_id',$id_art)->pluck('hot')[0];
        
        if($hot == 1){
            Article::where('article_id',$id_art)->update(['hot' => 0]);
        }else {
            Article::where('article_id',$id_art)->update(['hot' => 1]);
        }

    }

    public function sortCategoryArticle(){

        $sort = $_POST['sort'];

        $category_id = $_POST['category_id'];

        Category::where('category_id',$category_id)->update(['sort' => $sort]);

    }

    public function sortArticle(){

        $sort = $_POST['sort'];

        $art_id = $_POST['art_id'];
        
        Article_menu::where('article_menu_id',$art_id)->update(['sort' => $sort]);

    }


    // nhansh so 1
    public function getAddArticle($id_cat){

        
        $category = Category::where('category_id',$id_cat)->get()[0];

        return view('admin.article.add',compact('category'));

    }

    public function postAddArticle(Request $request , $id_cat){
        $functions = new Functions();
        $data = $request->all(); 
        $data['slug'] = $functions->convert($request->name);
        $data['parent'] = 0;
        if(Article_menu::where('category_id',$id_cat)->get('sort')->toArray() != []){
            $max_sort = Article_menu::where('category_id',$id_cat)->OrderBy('sort','DESC')->get(['sort'])->toArray()[0]['sort'];
            $data['sort'] = $max_sort + 1 ;
        }else {
            $data['sort'] = 1;
        }
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
        if($request->hot == null ){
            $data['hot'] = 0;
        }
        $data = self::checkImages($request,$data);
        $result = Article_menu::create($data);

        $str = "Bạn đã thêm bài viết thành công";
        $str_fail = "Bạn đã thêm bài viết thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str','url'));
        }
        
    }
    // nhánh số 2
    public function getAddArticle2($id_cat , $id_menu_art){

        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('article_menu_add','article',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $article_menu = Article_menu::where('article_menu_id',$id_menu_art)->get()[0];

        return view('admin.article.add',compact('article_menu'));

    }

    public function postAddArticle2(Request $request , $id_cat , $id_menu_art){

        $functions = new Functions();
        $data = $request->all(); 

        $data['slug'] = $functions->convert($request->name);

        $data['parent'] = $id_menu_art;

        if(Article_menu::where('parent',$id_menu_art)->get('sort')->toArray() != []){
            $max_sort = Article_menu::where('parent',$id_menu_art)->OrderBy('sort','DESC')->get(['sort'])->toArray()[0]['sort'];
            $data['sort'] = $max_sort + 1 ;
        }else {
            $data['sort'] = 1; 
        }

        $data['category_id'] = $id_cat;

        $data = self::checkImages($request,$data);

        if($request->is_active == null){
            $data['is_active'] = 0;
        }

        if($request->hot == null ){
            $data['hot'] = 0;
        }
        
        $result = Article_menu::create($data);

        $str = "Bạn đã thêm bài viết thành công";
        $str_fail = "Bạn đã thêm bài viết thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str','url'));
        }

    }
    // end nhanh
    // update article -> table(category)
    public function getEditCategory($id_edit){

        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('category_edit','article',$id_edit);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $category = Category::where('type_id',1)->where('category_id',$id_edit)->get();
        return view('admin.article.edit',compact('category'));

    }
    public function postEditCategory(Request $request,$id_edit){
        $functions = new Functions();
        $category_edit = Category::where('category_id',$id_edit)->get()->toArray();
        $data = request()->except(['_token']);
        $data['slug'] = $functions->convert($request->name);
        $data = self::checkImages($request,$data,$category_edit);
        $result = Category::where('type_id',1)->where('category_id',$id_edit)->update($data);

        $str = "Bạn đã chỉnh sửa danh mục thành công";
        $str_fail = "Bạn đã chỉnh sửa danh mục thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str','url'));
        }

    }

    public function postEditArticle(Request $request,$id_cat,$id_edit){
        $functions = new Functions();
        $article_menu = Article_menu::where('article_menu_id',$id_edit)->get();
        $data = request()->except(['_token']);
        $data['slug'] = $functions->convert($request->name);
        $data = self::checkImages($request,$data,$article_menu);
        $result = Article_menu::where('article_menu_id',$id_edit)->update($data);
        
        $str = "Bạn đã chỉnh sửa bài viết thành công";
        $str_fail = "Bạn đã chỉnh sửa bài viết thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str','url'));
        }

    }
    // update article_menu ->table(article_menu)
    public function getEditArticle($id_cat,$id_edit){

        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('article_menu_edit','article',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $article_menu = Article_menu::where('article_menu_id',$id_edit)->get();
        return view('admin.article.edit',compact('article_menu'));

    }

    public function postDelArticle ($id_cat,$id_del){

        // phân quyền
        $functions = new Functions();
        $check = $functions->loadPageAdminTwo('article_menu_del','article',$id_cat);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $result = Article_menu::where('article_menu_id',$id_del)->delete();
        $str = "Bạn đã xóa bài viết thành công";
        $str_fail = "Bạn đã xóa bài viết thất bại";
        $url = "admin/article_manager";

        if($result){
            $id_del_art = Article_menu::where('category_id',$id_del)->pluck('article_menu_id')->toArray();
            if($id_del_art != []){
                Article::where('article_menu_id',$id_del_art[0])->delete();
            }
            Article::where('article_menu_id',$id_del)->delete();
            Article_menu::where('parent',$id_del)->delete();
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return redirect('admin/article_manager');
        }

    }
    
    //article_list
    public function getArticleList($id_menu_art){

        
        // phân quyền
        $functions = new Functions();
        $id_cat = Article_menu::where('article_menu_id',$id_menu_art)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('article_list','article',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $list_article = Article::where('article_menu_id',$id_menu_art)->get()->toArray();
        return view('admin.article.list',compact('id_menu_art','list_article'));
        
    }

    // article add list
    public function getAddArticleList($id_menu_art){

        // phân quyền
        $functions = new Functions();
        $id_cat = Article_menu::where('article_menu_id',$id_menu_art)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('article_add','article',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền
        $article_menu = Article_menu::where('article_menu_id',$id_menu_art)->get()->toArray()[0];
        return view('admin.article.add_list',compact('article_menu'));

    }
    public function postAddArticleList(Request $request,$id_menu_art){
        $functions = new Functions();
        $data = $request->all();
        $data['content'] = html_entity_decode($request->content);
        $data['slug'] = $functions->convert($request->name);
        $data = self::checkImages($request,$data);
        if($request->is_active == null){
            $data['is_active'] = 0;
        }
         if($request->hot == null){
            $data['hot'] = 0;
        }
        $result = Article::create($data);
        $str = "Bạn đã thêm bài viết thành công";
        $str_fail = "Bạn đã thêm bài viết thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str','url'));
        }

    }

    // update article -> table(article)
    public function getEditArticleList($id_art){

        // phân quyền
        $functions = new Functions();
        $id_menu_art = Article::where('article_id',$id_art)->get()->pluck('article_menu_id')->toArray()[0];
        $id_cat = Article_menu::where('article_menu_id',$id_menu_art)->get()->pluck('category_id')->toArray()[0];

        $check = $functions->loadPageAdminTwo('article_edit','article',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $article = Article::where('article_id',$id_art)->get()->toArray()[0];
        $article_menu = Article_menu::where('article_menu_id',$article['article_menu_id'])->get()->toArray()[0];
        return view('admin.article.edit_list',compact('article','article_menu'));

    }

    public function postEditArticleList(RequestAddArticle $request ,$id_art){
        $functions = new Functions();
        $data = request()->except(['_token']);
        $data['slug'] = $functions->convert($request->name);
        $data['content'] = html_entity_decode($request->content);
        $article = Article::where('article_id',$id_art)->get()->toArray(); 
        
        $data = self::checkImages($request,$data,$article);

        $result = Article::where('article_id',$id_art)->update($data);
        $str = "Bạn đã chỉnh sửa bài viết thành công";
        $str_fail = "Bạn đã chỉnh sửa bài viết thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str','url'));
        }
    }


    public function postDelArticleList(Request $request,$id_menu_art){

        // phân quyền
        $functions = new Functions();
        $id_cat = Article_menu::where('article_menu_id',$id_menu_art)->get()->pluck('category_id')->toArray()[0];
        $check = $functions->loadPageAdminTwo('article_add','article',$id_cat);
        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

        $article_id_database = Article::where('article_menu_id',$id_menu_art)->pluck('article_id')->toArray();
        $article_remove = $request->delete;
        if($article_remove != null){
            foreach($article_remove as $remove){
                if(in_array($remove,$article_id_database)){
                    
                    $result = Article::where('article_id',$remove)->delete();

                }
            } 
        }else  {
            return redirect()->back();
        }
        

        $str = "Bạn đã xóa bài viết thành công";
        $str_fail = "Bạn đã xóa bài viết thất bại";
        $url = "admin/article_manager";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str','url'));
        }

    }

    
    // kiem tra hinh anh
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
            $path ='upload/article/' . $file_name;
            $images = Image::make($request->file('images')->getRealPath())->resize(870, 518)->save($path);

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
