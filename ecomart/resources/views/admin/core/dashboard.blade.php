@extends('admin.master.master')
@section('content')
           
        <div id="page-wrapper" style="min-height: 536px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Nhóm quản trị</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('')}}"> Trang chủ</a>
                    </li>
                    <li>
                        <a href="core-role.html"> Quản trị hệ thống</a>
                    </li>
                    <li>
                        Nhóm quản trị
                    </li>
                    <li> Administrator </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group panel-tabs-line">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-edit fa-fw"></i> Quản lý nội dung</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Thể loại
                                                    </div>
                                                    <!-- /.panel-heading -->
                                                    <div class="panel-body">
                                                        <!-- Nav tabs -->
                                                        <ul class="nav nav-tabs">
                                                            <li class="active"><a href="#manager" data-toggle="tab">Chung</a>
                                                            </li>
                                                            <li><a href="#article" data-toggle="tab">Bài viết</a>
                                                            </li>
                                                            <li><a href="#gallery" data-toggle="tab">Hình ảnh</a>
                                                            </li>
                                                            <li><a href="#product" data-toggle="tab">Sản phẩm</a>
                                                            </li>
                                                            <li><a href="#others" data-toggle="tab">Dữ liệu khác</a>
                                                            </li>
                                                            <li><a href="#pages" data-toggle="tab">Phần bổ sung</a>
                                                            </li>
                                                        </ul>
                                                        <!-- Tab panes -->
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade in active" id="manager">
                                                                <form id="core_category" method="post" action="core_dashboard&coreAll&role_id={{$role_id}}" >
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <div style="padding: 10px; border-left: 1px solid #ddd;">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" id="selecctallCategory" value="ok"><b>Chọn tất cả / Hủy tất cả</b>
                                                                                </label>
                                                                            </div>

                                                                            @foreach($category[0]['get_category'] as $get_categories)
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox"
                                                                                    <?php echo (in_array($get_categories['slug'], $category[0]['get_category_privilege'])) ?  "checked"  : "" ?> 
                                                                                    class="checkboxCategory" name="variable[]"
                                                                                    value="{{$get_categories['slug']}}">{{$get_categories['name']}}              
                                                                                </label>
                                                                            </div>
                                                                            @endforeach

                                                                        </div>
                                                                        <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                                    </div>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('#selecctallCategory').click(function(event) {
                                                                                if (this.checked) {
                                                                                    $('.checkboxCategory').each(function() {
                                                                                        this.checked = true;
                                                                                    });
                                                                                } else {
                                                                                    $('.checkboxCategory').each(function() {
                                                                                        this.checked = false;
                                                                                    });
                                                                                }
                                                                            });
                                                                        });
                                                                    </script>
                                                                </form>
                                                            </div>


                                                            <div class="tab-pane fade" id="article">
                                                                <form id="core_article" method="post" action="core_dashboard&core_article&role_id={{$role_id}}">
                                                                    @csrf
                                                                    <input type="hidden" name="role_id" value="1">
                                                                    <div class="form-group">
                                                                    @foreach($article[0]['get_category'] as $row)
                                                                        <div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" id="selecctallArt<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$article[0]['get_article_privilege'])) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_menu_add;".$row['category_id'],$article[0]['get_article_privilege'])) ? "checked" : "" ?> value="article_menu_add;<?php echo $row['category_id']?>">Thêm mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_menu_edit;".$row['category_id'],$article[0]['get_article_privilege'])) ? "checked" : "" ?> value="article_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_menu_del;".$row['category_id'],$article[0]['get_article_privilege'])) ? "checked" : "" ?> value="article_menu_del;<?php echo $row['category_id']?>">Xóa mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_list;".$row['category_id'],$article[0]['get_article_privilege'])) ? "checked" : "" ?> value="article_list;<?php echo $row['category_id']?>">Danh sách bài viết
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_add;".$row['category_id'],$article[0]['get_article_privilege'])) ? "checked" : "" ?> value="article_add;<?php echo $row['category_id']?>">Thêm bài viết
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_edit;".$row['category_id'],$article[0]['get_article_privilege'])) ? "checked" : "" ?> value="article_edit;<?php echo $row['category_id']?>">Chỉnh sửa bài viết
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_del;".$row['category_id'],$article[0]['get_article_privilege'])) ? "checked" : "" ?> value="article_del;<?php echo $row['category_id']?>">Xóa bài viết
                                                                                </label>
                                                                            </div>
                                                                            <script>
                                                                            $(document).ready(function() {
                                                                                $('#selecctallArt<?php echo $row['slug']?>').click(function(event) {
                                                                                    if(this.checked) {
                                                                                        $('.checkboxArt<?php echo $row['slug']?>').each(function() {
                                                                                            this.checked = true;
                                                                                        });
                                                                                    }else{
                                                                                        $('.checkboxArt<?php echo $row['slug']?>').each(function() {
                                                                                            this.checked = false;
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            </script>
                                                                        </div>
                                                                        @endforeach
                                                                        
                                                                        <div class="clearfix"></div>
                                                                        <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                                    </div>
                                                                </form>
                                                            </div>



                                                            <div class="tab-pane fade" id="gallery">
                                                                <form id="core_gallery" method="post" action="core_dashboard&core_gallery&role_id={{$role_id}}">
                                                                    @csrf
                                                                    <input type="hidden" name="role_id" value="1">
                                                                    <div class="form-group">
                                                                        @foreach($gallery[0]['get_category'] as $row)
                                                                        <div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" id="selecctallGal<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$gallery[0]['get_gallery_privilege'])) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_menu_add;".$row['category_id'],$gallery[0]['get_gallery_privilege'])) ? "checked" : "" ?> value="gallery_menu_add;<?php echo $row['category_id']?>">Thêm mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_menu_edit;".$row['category_id'],$gallery[0]['get_gallery_privilege'])) ? "checked" : "" ?> value="gallery_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_menu_del;".$row['category_id'],$gallery[0]['get_gallery_privilege'])) ? "checked" : "" ?> value="gallery_menu_del;<?php echo $row['category_id']?>">Xóa mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_list;".$row['category_id'],$gallery[0]['get_gallery_privilege'])) ? "checked" : "" ?> value="gallery_list;<?php echo $row['category_id']?>">Danh sách hình ảnh
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_add;".$row['category_id'],$gallery[0]['get_gallery_privilege'])) ? "checked" : "" ?> value="gallery_add;<?php echo $row['category_id']?>">Thêm hình ảnh
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_edit;".$row['category_id'],$gallery[0]['get_gallery_privilege'])) ? "checked" : "" ?> value="gallery_edit;<?php echo $row['category_id']?>">Chỉnh sửa hình ảnh
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_del;".$row['category_id'],$gallery[0]['get_gallery_privilege'])) ? "checked" : "" ?> value="gallery_del;<?php echo $row['category_id']?>">Xóa hình ảnh
                                                                                </label>
                                                                            </div>
                                                                            <script>
                                                                            $(document).ready(function() {
                                                                                $('#selecctallGal<?php echo $row['slug']?>').click(function(event) {
                                                                                    if(this.checked) {
                                                                                        $('.checkboxGal<?php echo $row['slug']?>').each(function() {
                                                                                            this.checked = true;
                                                                                        });
                                                                                    }else{
                                                                                        $('.checkboxGal<?php echo $row['slug']?>').each(function() {
                                                                                            this.checked = false;
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            </script>
                                                                        </div>
                                                                        @endforeach
                                                                        
                                                                        <div class="clearfix"></div>
                                                                        <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                                    </div>
                                                                </form>
                                                            </div>


                                                            <div class="tab-pane fade" id="product">
                                                                <form id="core_product" method="post" action="core_dashboard&core_product&role_id={{$role_id}}">
                                                                    @csrf
                                                                    <input type="hidden" name="role_id" value="1">
                                                                    <div class="form-group">
                                                                        @foreach($product[0]['get_category'] as $row)
                                                                        <div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" id="selecctallPro<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$product[0]['get_product_privilege'])) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_menu_add;".$row['category_id'],$product[0]['get_product_privilege'])) ? "checked" : "" ?> value="product_menu_add;<?php echo $row['category_id']?>">Thêm mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_menu_edit;".$row['category_id'],$product[0]['get_product_privilege'])) ? "checked" : "" ?> value="product_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_menu_del;".$row['category_id'],$product[0]['get_product_privilege'])) ? "checked" : "" ?> value="product_menu_del;<?php echo $row['category_id']?>">Xóa mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_list;".$row['category_id'],$product[0]['get_product_privilege'])) ? "checked" : "" ?> value="product_list;<?php echo $row['category_id']?>">Danh sách sản phẩm
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_add;".$row['category_id'],$product[0]['get_product_privilege'])) ? "checked" : "" ?> value="product_add;<?php echo $row['category_id']?>">Thêm tin sản phẩm
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_edit;".$row['category_id'],$product[0]['get_product_privilege'])) ? "checked" : "" ?> value="product_edit;<?php echo $row['category_id']?>">Chỉnh sửa sản phẩm
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_del;".$row['category_id'],$product[0]['get_product_privilege'])) ? "checked" : "" ?> value="product_del;<?php echo $row['category_id']?>">Xóa sản phẩm
                                                                                </label>
                                                                            </div>
                                                                            <script>
                                                                            $(document).ready(function() {
                                                                                $('#selecctallPro<?php echo $row['slug']?>').click(function(event) {
                                                                                    if(this.checked) {
                                                                                        $('.checkboxPro<?php echo $row['slug']?>').each(function() {
                                                                                            this.checked = true;
                                                                                        });
                                                                                    } else{
                                                                                        $('.checkboxPro<?php echo $row['slug']?>').each(function() {
                                                                                            this.checked = false;
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            </script>
                                                                        </div>
                                                                        @endforeach
                                                                        <div class="clearfix"></div>
                                                                        <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            
                                                            <div class="tab-pane fade" id="others">
                                                                <form id="core_others" method="post" action="core_dashboard&core_others&role_id={{$role_id}}">
                                                                    @csrf
                                                                    <input type="hidden" name="role_id" value="1">
                                                                    <div class="form-group">
                                                                        @foreach($others[0]['get_category'] as $row)
                                                                        <div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" id="selecctallOthers<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$others[0]['get_other_privilege'])) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_menu_add;".$row['category_id'],$others[0]['get_other_privilege'])) ? "checked" : "" ?> value="others_menu_add;<?php echo $row['category_id']?>">Thêm mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_menu_edit;".$row['category_id'],$others[0]['get_other_privilege'])) ? "checked" : "" ?> value="others_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 10px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_menu_del;".$row['category_id'],$others[0]['get_other_privilege'])) ? "checked" : "" ?> value="others_menu_del;<?php echo $row['category_id']?>">Xóa mục
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_list;".$row['category_id'],$others[0]['get_other_privilege'])) ? "checked" : "" ?> value="others_list;<?php echo $row['category_id']?>">Danh sách nội dung
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_add;".$row['category_id'],$others[0]['get_other_privilege'])) ? "checked" : "" ?> value="others_add;<?php echo $row['category_id']?>">Thêm nội dung
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_edit;".$row['category_id'],$others[0]['get_other_privilege'])) ? "checked" : "" ?> value="others_edit;<?php echo $row['category_id']?>">Chỉnh sửa nội dung
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox" style="padding-left: 20px;">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_del;".$row['category_id'],$others[0]['get_other_privilege'])) ? "checked" : "" ?> value="others_del;<?php echo $row['category_id']?>">Xóa nội dung
                                                                                </label>
                                                                            </div>
                                                                            <script>
                                                                            $(document).ready(function() {
                                                                                $('#selecctallOthers<?php echo $row['slug']?>').click(function(event) {
                                                                                    if(this.checked) {
                                                                                        $('.checkboxOthers<?php echo $row['slug']?>').each(function() {
                                                                                            this.checked = true;
                                                                                        });
                                                                                    }else{
                                                                                        $('.checkboxOthers<?php echo $row['slug']?>').each(function() {
                                                                                            this.checked = false;
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            </script>
                                                                        </div>
                                                                        @endforeach
                                                                        
                                                                        <div class="clearfix"></div>
                                                                        <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade" id="pages">
                                                                <form id="core_pages" method="post" action="core_dashboard&core_plus&role_id={{$role_id}}">
                                                                    @csrf
                                                                    <input type="hidden" name="role_id" value="1">
                                                                    <div class="form-group">

                                                                        <div style="padding: 10px; border-left: 1px solid #ddd;">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" id="selecctallPages"><b>Chọn tất cả / Hủy tất cả</b>
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPages" name="variable[]" <?php echo (in_array("plugin_page_add",$pages[0]['get_pages_privilege'])) ? "checked" : "" ?> value="plugin_page_add">Thêm trang
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPages" name="variable[]" <?php echo (in_array("plugin_page_edit",$pages[0]['get_pages_privilege'])) ? "checked" : "" ?> value="plugin_page_edit">Chỉnh sửa trang
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" class="checkboxPages" name="variable[]" <?php echo (in_array("plugin_page_del",$pages[0]['get_pages_privilege'])) ? "checked" : "" ?> value="plugin_page_del">Xóa trang
                                                                                </label>
                                                                            </div> 
                                                                        </div>
                                                                        <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                                    </div>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('#selecctallPages').click(function(event) {
                                                                                if (this.checked) {
                                                                                    $('.checkboxPages').each(function() {
                                                                                        this.checked = true;
                                                                                    });
                                                                                } else {
                                                                                    $('.checkboxPages').each(function() {
                                                                                        this.checked = false;
                                                                                    });
                                                                                }
                                                                            });
                                                                        });
                                                                    </script>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.panel-body -->
                                                </div>
                                                <!-- /.panel -->
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="fa fa-database fa-fw"></i> Cơ sở dữ liệu</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form id="core_backup" method="post" action="core_dashboard&core_database&role_id={{$role_id}}">
                                                @csrf
                                                <!-- <input type="hidden" name="role_id" value="1"> -->
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" id="selecctallTwo" ><b>Chọn tất cả / Hủy tất cả</b>
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxBackup" name="variable[]" <?php echo (in_array("backup_data",$database[0]['get_database_privilege'])) ? "checked" : "" ?> value="backup_data">Sao lưu dữ liệu
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxBackup" name="variable[]" <?php echo (in_array("backup_config",$database[0]['get_database_privilege'])) ? "checked" : "" ?> value="backup_config">Cấu hình sao lưu
                                                        </label>
                                                    </div>
                                                    <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                </div>
                                                <script>
                                                $(document).ready(function() {
                                                    $('#selecctallTwo').click(function(event) {
                                                        if(this.checked) {
                                                            $('.checkboxBackup').each(function() {
                                                                this.checked = true;
                                                            });
                                                        }else{
                                                            $('.checkboxBackup').each(function() {
                                                                this.checked = false;
                                                            });
                                                        }
                                                    });
                                                });
                                                </script>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><i class="fa fa-cogs fa-fw"></i> Cấu hình</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form id="core_config" method="post" action="core_dashboard&core_config&role_id={{$role_id}}">
                                                @csrf
                                                <input type="hidden" name="role_id" value="1">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" id="selecctallThree" ><b>Chọn tất cả / Hủy tất cả</b>
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_general",$config[0]['get_config_privilege'])) ? "checked" : "" ?> value="config_general">Cấu hình chung
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_smtp",$config[0]['get_config_privilege'])) ? "checked" : "" ?> value="config_smtp">Cấu hình SMTP
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_datetime",$config[0]['get_config_privilege'])) ? "checked" : "" ?> value="config_datetime">Cấu hình thời gian
                                                        </label>
                                                    </div>
                                                    <!-- <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_plugins",$config[0]['get_config_privilege'])) ? "checked" : "" ?> value="config_plugins">Trình cắm bổ sung
                                                        </label>
                                                    </div> -->
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_socialnetwork",$config[0]['get_config_privilege'])) ? "checked" : "" ?> value="config_socialnetwork">Mạng xã hội
                                                        </label>
                                                    </div>
                                                    <!-- <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_search",$config[0]['get_config_privilege'])) ? "checked" : "" ?> value="config_search">Máy chủ tìm kiếm
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_upload",$config[0]['get_config_privilege'])) ? "checked" : "" ?> value="config_upload">Cấu hình upload
                                                        </label>
                                                    </div> -->
                                                    <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                </div>
                                                <script>
                                                $(document).ready(function() {
                                                    $('#selecctallThree').click(function(event) {
                                                        if(this.checked) {
                                                            $('.checkboxConfig').each(function() {
                                                                this.checked = true;
                                                            });
                                                        }else{
                                                            $('.checkboxConfig').each(function() {
                                                                this.checked = false;
                                                            });
                                                        }
                                                    });
                                                });
                                                </script>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><i class="fa fa-wrench fa-fw"></i> Công cụ hỗ trợ</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form id="core_tool" method="post" onsubmit="return coreDashboard('core_tool', 'tool');">

                                                <input type="hidden" name="role_id" value="1">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" id="selecctallFour"><b>Chọn tất cả / Hủy tất cả</b>
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxTool" name="variable[]" checked="" value="tool_delete">Dọn dẹp hệ thống
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxTool" name="variable[]" checked="" value="tool_site">Chuẩn đoán site
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxTool" name="variable[]" checked="" value="tool_keywords">Hạng site theo từ khóa
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxConfig" name="variable[]" checked="" value="tool_ipdie">Quản lý IP cấm
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxTool" name="variable[]" checked="" value="tool_update">Kiểm tra phiên bản
        </label>
                                                    </div>
                                                    <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#selecctallFour').click(function(event) {
                                                            if (this.checked) {
                                                                $('.checkboxTool').each(function() {
                                                                    this.checked = true;
                                                                });
                                                            } else {
                                                                $('.checkboxTool').each(function() {
                                                                    this.checked = false;
                                                                });
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </form>
                                        </div>
                                    </div>
                                </div> -->


                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><i class="fa fa-dashboard fa-fw"></i> Quản trị hệ thống</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form id="core_core" method="post" action="core_dashboard&core_admin&role_id={{$role_id}}">
                                                @csrf
                                                <input type="hidden" name="role_id" value="1">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" id="selecctallFive" ><b>Chọn tất cả / Hủy tất cả</b>
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxCore" name="variable[]" <?php echo (in_array("core_role",$core[0]['get_core_privilege'])) ? "checked" : "" ?> value="core_role">Nhóm quản trị
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxCore" name="variable[]" <?php echo (in_array("core_user",$core[0]['get_core_privilege'])) ? "checked" : "" ?> value="core_user">Quản lý thành viên
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxCore" name="variable[]" <?php echo (in_array("core_dashboard",$core[0]['get_core_privilege'])) ? "checked" : "" ?> value="core_dashboard">Phân quyền quản trị
                                                        </label>
                                                    </div>
                                                    <!-- <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkboxCore" name="variable[]" <?php echo (in_array("core_mail",$core[0]['get_core_privilege'])) ? "checked" : "" ?> value="core_mail">Gửi mail thành viên
                                                        </label>
                                                    </div> -->
                                                    <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                </div>
                                                <script>
                                                $(document).ready(function() {
                                                    $('#selecctallFive').click(function(event) {
                                                        if(this.checked) {
                                                            $('.checkboxCore').each(function() {
                                                                this.checked = true;
                                                            });
                                                        }else{
                                                            $('.checkboxCore').each(function() {
                                                                this.checked = false;
                                                            });
                                                        }
                                                    });
                                                });
                                                </script>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                                <!-- <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"><i class="fa fa-sitemap fa-fw"></i> Thông tin hệ thống</a>
                                        </h4>
                                    </div>
                                    <div id="collapseSix" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form id="core_info" method="post" onsubmit="return coreDashboard('core_info', 'info');">
                                                <input type="hidden" name="role_id" value="1">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" id="selecctallSix"><b>Chọn tất cả / Hủy tất cả</b>
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxInfo" name="variable[]" checked="" value="sys_info_diary">Thống kê hoạt động
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxInfo" name="variable[]" checked="" value="sys_info_site">Cấu hình site
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxInfo" name="variable[]" checked="" value="sys_info_php">Cấu hình PHP
        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
            <input type="checkbox" class="checkboxInfo" name="variable[]" checked="" value="sys_info_expansion">Tiện ích mở rộng
        </label>
                                                    </div>
                                                    <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#selecctallSix').click(function(event) {
                                                            if (this.checked) {
                                                                $('.checkboxInfo').each(function() {
                                                                    this.checked = true;
                                                                });
                                                            } else {
                                                                $('.checkboxInfo').each(function() {
                                                                    this.checked = false;
                                                                });
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </form>
                                        </div>
                                    </div>
                                </div> -->

                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
@endsection