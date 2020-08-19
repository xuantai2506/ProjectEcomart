@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 165px;">
            <div class="row">
                <h2 class="title_sp">Chỉnh sửa danh mục hình ảnh</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/gallery_manager')}}">Danh sách hình ảnh</a>
                    </li>
                    <li>
                        Chỉnh sửa danh mục hình ảnh
                    </li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-heading">
                            <i class="fa fa-files-o"></i> Chỉnh sửa Hình Ảnh
                        </div>
                        <div class="panel-body">
                            <div class="table-respon">
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

                                            <td align="right" class="ver-top"><label>Hình đại diện:</label></td>

                                            <td>
                                                @if($categories['images'] == 'no')
                                                <input required class="form-control file" type="file" name="images" data-show-upload="false" data-max-file-count="1" accept="image/*">
                                                @else
                                                <input required class="form-control file file-img" type="file" name="images" data-show-upload="true" data-max-file-count="1" accept="image/*">
                                                @endif
                                            </td>

                                        </tr>

                                        <tr>

                                            <td width="150px" align="right"><label>Tiêu đề - HOME:</label></td>

                                            <td><input class="form-control" type="text" value="{{$categories['title']}}" id="title" name="title" maxlength="200" ></td>

                                        </tr>

                                        <tr>

                                            <td width="150px" align="right"><label>Bổ sung:</label></td>

                                            <td><input class="form-control" type="text" value="{{$categories['plus']}}" id="plus" name="plus" maxlength="200"></td>

                                        </tr>

                                        <tr>

                                            <td align="right" class="ver-top"><label>Mô tả:</label></td>

                                            <td>
                                                <textarea class="form-control" name="comment"  rows="3">{{$categories['comment']}}</textarea>
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
                                                <a href="{{URL::to('admin/gallery_manager')}}">
                                                    <button class="btn btn-form-info btn-form" type="button">Thoát</button>
                                                </a>
                                            </td>

                                        </tr>

                                    </table>
                                    <script type="text/javascript">
                                        $('.file-img').fileinput({
                                            initialPreview: [
                                                "<img src='<?php echo asset('upload/gallery/'.$categories['images'])  ?>' class='file-preview-image' >"
                                            ],
                                            allowedFileExtensions: ['jpg', 'png', 'gif']
                                        });
                                    </script>
                                </form>
                                 @endforeach
                                    <!-- edit article_menu -->
                                @else 
                                @foreach($gallery_menu as $gallery_menus)
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <table class="table table-hover" style="width: 70%;">

                                        <tr>

                                            <td width="150px" align="right"><label>Tên chuyên mục:</label></td>

                                            <td><input class="form-control" type="text" value="{{$gallery_menus['name']}}" id="name" name="name" maxlength="200" required></td>

                                        </tr>

                                        <tr>

                                            <td align="right" class="ver-top"><label>Hình đại diện:</label></td>

                                            <td>
                                                @if($gallery_menus['images'] == 'no')
                                                <input class="form-control file" type="file" name="images" data-show-upload="false" data-max-file-count="1" accept="image/*">
                                                @else
                                                <input class="form-control file file-img" type="file" name="images" data-show-upload="true" data-max-file-count="1" accept="image/*">
                                                @endif
                                            </td>

                                        </tr>

                                        <tr>

                                            <td width="150px" align="right"><label>Tiêu đề - HOME:</label></td>

                                            <td><input class="form-control" type="text" value="{{$gallery_menus['title']}}" id="title" name="title" maxlength="200" ></td>

                                        </tr>
                                        

                                        <tr>

                                            <td align="right" class="ver-top"><label>Mô tả:</label></td>

                                            <td>
                                                <textarea class="form-control" name="comment"  rows="3">{{$gallery_menus['comment']}}</textarea>
                                            </td>

                                        </tr>


                                        <tr>

                                            <td align="right"><label>Hiển thị:</label></td>

                                            <td>

                                               @if($gallery_menus['is_active'] == 1)

                                                <label class="radio-inline">
                                                    <input type="radio" name="is_active" value="0">Đóng
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_active" value="1" checked>Mở
                                                </label>
                                                @else
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_active" value="0" checked>Đóng
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_active" value="1" >Mở
                                                </label>
                                                @endif

                                            </td>

                                        </tr>

                                        <tr>

                                            <td align="right"><label>Nổi bật:</label></td>

                                            <td>

                                                @if($gallery_menus['hot'] == 1)
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

                                            <td class="tth-gp-r"><input class="form-control" value="{{$gallery_menus['description']}}" type="text" name="description" maxlength="255"  ></td>

                                        </tr>

                                        <tr>

                                            <td align="right" class="tth-gp-l tth-gp-b"><label>Keywords:</label></td>

                                            <td class="tth-gp-r tth-gp-b">
                                                <input class="form-control" value="{{$gallery_menus['keywords']}}" type="text" name="keywords" data-role="tagsinput" >
                                            </td>

                                        </tr>

                                        <tr>

                                            <td colspan="2" align="center" class="kc_button">

                                                <button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;

                                                <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                <a href="{{URL::to('admin/gallery_manager')}}">
                                                    <button class="btn btn-form-info btn-form" type="button">Thoát</button>
                                                </a>
                                            </td>

                                        </tr>

                                    </table>

                                    <script type="text/javascript">
                                        $('.file-img').fileinput({
                                            initialPreview: [
                                                "<img src='<?php echo asset('upload/gallery/'.$gallery_menus['images'])  ?>' class='file-preview-image' >"
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
                $(".file-img").fileinput({
                    'allowedFileExtensions': ['jpg', 'png', 'gif']

                });

                $("#album").fileinput({
                    uploadUrl: "/uploads/upload.php?type=1&id=2915&lang=vi",
                    uploadAsync: false,
                    initialPreview: [],
                    initialPreviewConfig: []
                });
                
                $('.input-datetime').datetimepicker({
                    mask: '39/19/9999 29:59',
                    lang: 'vi',
                    format: 'd/m/Y H:i'
                });
            </script>
        </div>
@endsection