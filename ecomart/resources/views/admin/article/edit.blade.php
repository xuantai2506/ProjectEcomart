@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 165px;">
            <div class="row">
                @if(isset($category))
                <h2 class="title_sp">Chỉnh sửa danh mục</h2>
                @else 
                <h2 class="title_sp">Chỉnh sửa bài viết</h2>
                @endif
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Trang chủ</a>
                    </li>
                    <li>
                        <a href="baiviet.html">Quản lý nội dung</a>
                    </li>
                    <li>
                        <a href="baiviet.html"> Sản phẩm</a>
                    </li>
                    <li>
                        <a href="category-list.html">Combo</a>
                    </li>
                    @if(isset($category))
                    <li>
                        Chỉnh sửa danh mục
                    </li>
                    @else 
                    <li>
                        Chỉnh sửa bài viết
                    </li>
                    @endif
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-heading">
                            <i class="fa fa-files-o"></i> Nội dung sản phẩm
                        </div>
                        <div class="panel-body">
                            <div class="table-respon">

                                @if(session('success'))
                                    <div class="alert alert-success">
                                         <div class="alert-title">{{session('success')}}</div>
                                    </div>
                                @endif
                                @if(@session('fail'))
                                    <div class="alert alert-danger">
                                         <div class="alert-title">{{session('fail')}}</div>
                                    </div>
                                @endif

                                @if(isset($category))
                                    @foreach($category as $categories)
                                    <form method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <table class="table table-hover" style="width: 70%;">

                                            <tr>

                                                <td width="150px" align="right"><label>Tên chuyên mục:</label></td>

                                                <td><input class="form-control" type="text" value="{{$categories['name']}}" id="name" name="name" maxlength="200" required></td>

                                            </tr>

                                            <tr>

                                                <td width="150px" align="right"><label>Liên kết tĩnh:</label></td>

                                                <td class="element-relative" colspan="3">
                                                    <input class="form-control" value="{{$categories['slug']}}" type="text" disabled id="slug" name="slug" maxlength="255" value="">
                                                </td>

                                            </tr>
                                                <td align="right" class="ver-top"><label>Hình đại diện:</label></td>
                                                <td>
                                                    @if($categories['images'] == 'no')
                                                    <input  class="form-control file" type="file" name="images" accept="image/*" data-show-upload="false" data-max-file-count="1">
                                                    @else
                                                    <input  class="form-control file file-img" type="file" name="images" accept="image/*" data-show-upload="true" data-max-file-count="1">
                                                    @endif
                                                </td>
                                                

                                            </tr>

                                            <tr>

                                                <td align="right" class="ver-top"><label>Tiêu đề:</label></td>

                                                <td><input class="form-control" value="{{$categories['title']}}" type="text" name="title" maxlength="255" value></td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="ver-top"><label>Bổ sung:</label></td>

                                                <td><textarea class="form-control" value="{{$categories['plus']}}" name="plus" rows="1">

                                                    </textarea>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="ver-top"><label>Mô tả:</label></td>

                                                <td>
                                                    <textarea class="form-control" name="comment" rows="3"></textarea>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td align="right"><label>Hiển thị:</label></td>

                                                <td>
                                            
                                                    @if($categories['is_active'] == 1)
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_active" value="1" checked>Mở
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_active" value="0">Đóng
                                                    </label>
                                                    @else
                                                      <label class="radio-inline">
                                                        <input type="radio" name="is_active" value="1" >Mở
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_active" value="0" checked>Đóng
                                                    </label>
                                                    @endif

                                                </td>

                                            </tr>
                                            <tr>

                                                <td align="right"><label>Nổi bật:</label></td>

                                                <td>

                                                    @if($categories['hot'] == 1)
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hot" value="0">Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hot" value="1" checked>Mở
                                                    </label>
                                                    @else
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hot" value="0" checked>Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hot" value="1" >Mở
                                                    </label>
                                                    @endif

                                                    </td>

                                            </tr>

                                            <tr>

                                                <td class="tth-bg-df" colspan="2"><strong>SEO</strong> -<span class="tth-gp-text">Không bắt buộc phải nhập, dữ liệu được lấy tự động nếu rỗng.</span></td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="tth-gp-l"><label>Description:</label></td>

                                                <td class="tth-gp-r"><input class="form-control" value="{{$categories['description']}}" type="text" name="description" maxlength="255"  ></td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="tth-gp-l tth-gp-b"><label>Keywords:</label></td>

                                                <td class="tth-gp-r tth-gp-b">
                                                    <input class="form-control" value="{{$categories['keywords']}}" type="text" name="keywords" data-role="tagsinput" >
                                                </td>

                                            </tr>

                                            <tr>

                                                <td colspan="2" align="center" class="kc_button">

                                                    <button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;

                                                    <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                    <a href="{{URL::to('admin/article_manager')}}">
                                                        <button class="btn btn-form-info btn-form" type="button">Thoát</button>
                                                    </a>
                                                </td>

                                            </tr>

                                        </table>

                                        <script type="text/javascript">
                                            $('.file-img').fileinput({
                                                initialPreview: [
                                                    "<img src='<?php echo asset('upload/article/'.$categories['images'])  ?>' class='file-preview-image' >"
                                                ],
                                                allowedFileExtensions: ['jpg', 'png', 'gif']
                                            });
                                        </script>

                                    </form>
                                    @endforeach
                                @else
                                    @foreach($article_menu as $article_menus)
                                    <form method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <table class="table table-hover" style="width: 70%;">

                                            <tr>

                                                <td width="150px" align="right"><label>Tên chuyên mục:</label></td>

                                                <td><input class="form-control" type="text" value="{{$article_menus['name']}}" id="name" name="name" maxlength="200" required></td>

                                            </tr>

                                            <tr>

                                                <td width="150px" align="right"><label>Liên kết tĩnh:</label></td>

                                                <td class="element-relative" colspan="3">
                                                    <input class="form-control" value="{{$article_menus['slug']}}" type="text" disabled id="slug" name="slug" maxlength="255" value="">
                                                </td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="ver-top"><label>Hình đại diện:</label></td>

                                                <td>
                                                    @if($article_menus['images'] == 'no')
                                                    <input  class="form-control file" type="file" name="images" accept="image/*" data-show-upload="false" data-max-file-count="1">
                                                    @else
                                                    <input  class="form-control file file-img" type="file" name="images" accept="image/*" data-show-upload="true" data-max-file-count="1" accept="image/*">
                                                    @endif
                                                </td>
                              

                                            </tr>

                                            <tr>

                                                <td align="right" class="ver-top"><label>Tiêu đề:</label></td>

                                                <td><input class="form-control" value="{{$article_menus['title']}}" type="text" name="title" maxlength="255" value></td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="ver-top"><label>Bổ sung:</label></td>

                                                <td>

                                                    <textarea class="form-control" value="{{$article_menus['plus']}}" name="plus" rows="1">
                                                    </textarea>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="ver-top"><label>Mô tả:</label></td>

                                                <td>
                                                    <textarea class="form-control" name="comment" rows="3">{{$article_menus['comment']}}
                                                    </textarea>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td align="right"><label>Hiển thị:</label></td>

                                                <td>
                                            
                                                    @if($article_menus['is_active'] == 1)
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_active" value="1" checked>Mở
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_active" value="0">Đóng
                                                    </label>
                                                    @else
                                                      <label class="radio-inline">
                                                        <input type="radio" name="is_active" value="1" >Mở
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_active" value="0" checked>Đóng
                                                    </label>
                                                    @endif

                                                </td>

                                            </tr>

                                            <tr>

                                                <td align="right"><label>Nổi bật:</label></td>

                                                <td>

                                                    @if($article_menus['hot'] == 1)
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hot" value="0">Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hot" value="1" checked>Mở
                                                    </label>
                                                    @else
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hot" value="0" checked>Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hot" value="1" >Mở
                                                    </label>
                                                    @endif

                                                    </td>

                                            </tr>

                                            <tr>

                                                <td class="tth-bg-df" colspan="2"><strong>SEO</strong> -<span class="tth-gp-text">Không bắt buộc phải nhập, dữ liệu được lấy tự động nếu rỗng.</span></td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="tth-gp-l"><label>Description:</label></td>

                                                <td class="tth-gp-r"><input class="form-control" value="{{$article_menus['description']}}" type="text" name="description" maxlength="255"  ></td>

                                            </tr>

                                            <tr>

                                                <td align="right" class="tth-gp-l tth-gp-b"><label>Keywords:</label></td>

                                                <td class="tth-gp-r tth-gp-b">
                                                    <input class="form-control" value="{{$article_menus['keywords']}}" type="text" name="keywords" data-role="tagsinput" >
                                                </td>

                                            </tr>

                                            <tr>

                                                <td colspan="2" align="center" class="kc_button">

                                                    <button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;

                                                    <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                    <a href="{{URL::to('admin/article_manager')}}">
                                                        <button class="btn btn-form-info btn-form" type="button">Thoát</button>
                                                    </a>
                                                </td>

                                            </tr>

                                        </table>

                                        <script type="text/javascript">
                                            $('.file-img').fileinput({
                                                initialPreview: [
                                                     "<img src='<?php echo asset('upload/article/'.$article_menus['images'])  ?>' class='file-preview-image' >"
                                                ],
                                                allowedFileExtensions: ['jpg', 'png', 'gif']
                                            });
                                        </script>
                                    </form>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
            </div>

            <script>

                $("#album").fileinput({
                    uploadUrl: "/uploads/upload.php?type=1&id=2915&lang=vi",
                    uploadAsync: false,
                    initialPreview: [],
                    initialPreviewConfig: []
                });
                CKEDITOR.replace('content', {
                    height: 250
                });
                $('.input-datetime').datetimepicker({
                    mask: '39/19/9999 29:59',
                    lang: 'vi',
                    format: 'd/m/Y H:i'
                });
            </script>
        </div>
@endsection