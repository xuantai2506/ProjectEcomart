@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 165px;">
            <div class="row">
                <h2 class="title_sp">Thêm danh mục hình ảnh</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/product_manager')}}">Danh sách sản phẩm</a>
                    </li>
                    <li>
                        Chỉnh sửa danh mục sản phẩm
                    </li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-heading">
                            <i class="fa fa-files-o"></i> Chỉnh sửa Sản Phẩm
                        </div>
                        <div class="panel-body">
                            <div class="table-respon">

                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <table class="table table-hover" style="width: 70%;">

                                        <tr>

                                            <td width="150px" align="right"><label>Tên chuyên mục:</label></td>

                                            <td><input class="form-control" type="text" id="name" value="{{$category['name']}}" name="name" maxlength="200" required></td>

                                        </tr>

                                       <!--  <tr>

                                            <td width="150px" align="right"><label>Liên kết tĩnh:</label></td>

                                            <td class="element-relative" colspan="3">
                                                <input class="form-control" type="text" id="slug" name="slug" maxlength="255" value="">
                                                <div data-toggle="tooltip" data-placement="top" title="Tạo liên kết tĩnh" class="btn-get-slug" onclick="return getSlug2(0);"></div>
                                            </td>

                                        </tr> -->

                                      <!--   <tr>

                                            <td align="right"><label>Mục cha:</label></td>

                                            <td>
                                                <select  name="category_id" class="form-control form-control-line">
                                                    @if(isset($category))
                                                    <option value="{{$category['category_id']}}" selected>{{$category['name']}}</option>
                                                    @endif
                                                </select>
                                            </td>

                                        </tr> -->

                                        <tr>

                                            <td align="right" class="ver-top"><label>Hình đại diện:</label></td>
                                            <td>
                                                @if($category['images'] == 'no')
                                                <input class="form-control file" type="file" name="images" data-show-upload="false" data-max-file-count="1" accept="image/*">
                                                @else
                                                <input class="form-control file file-img" type="file" name="images" data-show-upload="true" data-max-file-count="1" accept="image/*">
                                                @endif
                                            </td>

                                        </tr>
                                        @if(!isset($product_menu))
                                        <tr>

                                            <td align="right" class="ver-top"><label>Mô tả:</label></td>

                                            <td>
                                                <textarea class="form-control" name="comment" rows="3">{{$category['comment']}}
                                                </textarea>
                                            </td>

                                        </tr>
                                        @endif
                                        <tr>

                                            <td align="right"><label>Hiển thị:</label></td>

                                            <td>

                                                @if($category['is_active'] == 1)
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
                                                    <input type="radio" name="is_active" value="1">Mở
                                                </label>
                                                @endif

                                            </td>

                                        </tr>

                                        <tr>

                                            <td align="right"><label>Nổi bật:</label></td>

                                            <td>

                                                @if($category['hot'] == 1)
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
                                                    <input type="radio" name="hot" value="1">Mở
                                                </label>
                                                @endif

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="tth-bg-df" colspan="2"><strong>SEO</strong> -<span class="tth-gp-text">Không bắt buộc phải nhập, dữ liệu được lấy tự động nếu rỗng.</span></td>

                                        </tr>

                                        <tr>

                                            <td align="right" class="tth-gp-l"><label>Title:</label></td>

                                            <td class="tth-gp-r"><input class="form-control" type="text" value="{{$category['title']}}"  name="title" maxlength="255"  ></td>

                                        </tr>

                                        <tr>

                                            <td align="right" class="tth-gp-l"><label>Description:</label></td>

                                            <td class="tth-gp-r"><input class="form-control" value="{{$category['description']}}" type="text" name="description" maxlength="255"  ></td>

                                        </tr>

                                        <tr>

                                            <td align="right" class="tth-gp-l tth-gp-b"><label>Keywords:</label></td>

                                            <td class="tth-gp-r tth-gp-b">
                                                <input class="form-control" type="text" name="keywords" value="{{$category['keywords']}}" data-role="tagsinput" >
                                            </td>

                                        </tr>

                                        <tr>

                                            <td colspan="2" align="center" class="kc_button">

                                                <button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;

                                                <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                <a href="{{URL::to('admin/product_manager')}}">
                                                    <button class="btn btn-form-info btn-form" type="button">Thoát</button>
                                                </a>
                                            </td>

                                        </tr>

                                    </table>
                                </form>
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
            <script type="text/javascript">
                $('.file-img').fileinput({
                    initialPreview: [
                        "<img src='<?php echo asset('upload/product/'.$category['images'])  ?>' class='file-preview-image' >"
                    ],
                    allowedFileExtensions: ['jpg', 'png', 'gif']
                });
            </script>
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