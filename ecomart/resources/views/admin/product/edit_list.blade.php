@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 165px;">
            <div class="row">
                <h2 class="title_sp">Chỉnh sửa sản phẩm</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/product_manager')}}">Danh mục sản phẩm</a>
                    </li>
                    <li>
                        Chỉnh sửa sản phẩm
                    </li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-heading">
                            <i class="fa fa-files-o"></i> Chỉnh sửa sản phẩm
                        </div>
                        <div class="panel-body">
                            <div class="table-respon">
                                <form  method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="panel-show-error">
                                    </div>
                                    <table class="table table-hover">
                                        <tbody>

                                            <tr>
                                                <td width="12%"><label>Tiêu đề:</label></td>
                                                <td width="88%" colspan="3"><input class="form-control" type="text" id="name" name="name" maxlength="255" value="{{$product['name']}}" required="required"></td>
                                            </tr>

                                            <tr>
                                                <td><label>Mục:</label></td>
                                                <td colspan="3">
                                                    <select name="product_menu_id" class="form-control">
                                                        @if(isset($category))
                                                        <option value="{{$category['category_id']}}" selected>{{$category['name']}}</option>
                                                        @endif
                                                        @if(isset($product_menu))
                                                        <option value="{{$product_menu['product_menu_id']}}" selected>{{$product_menu['name']}}</option>
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="12%" class="ver-top"><label>Hình đại diện:</label>
                                                </td>
                                                <td>
                                                    @if($product['images'] == 'no')
                                                    <input class="form-control file" type="file" name="images" data-show-upload="false" data-max-file-count="1" accept="image/*">
                                                    @else
                                                    <input class="form-control file file-img" type="file" name="images" data-show-upload="true" data-max-file-count="1" accept="image/*">
                                                    @endif
                                                </td>
                                                <td width="12%" class="ver-top"><label>Ghi chú hình:</label></td>
                                                <td width="38%" class="ver-top"><input class="form-control" type="text" value="{{$product['images_note']}}" name="images_note" maxlength="255" value=""></td>
                                            </tr>
                                            <tr>
                                                <td><label>Giá:</label></td>
                                                <td><input class="form-control auto-number" value="{{$product['price']}}" type="text" name="price" data-a-sep="." data-a-dec="," data-v-max="9999999999" data-v-min="0" maxlength="15" placeholder="0 =  Liên hệ" value=""></td>
                                                <td><label>Giá khuyến mãi:</label></td>
                                                <td><input class="form-control auto-number" type="text" value="{{$product['sale']}}" name="sale" data-a-sep="." data-a-dec="," data-v-max="9999999999" data-v-min="0" maxlength="15" placeholder="0 =  Không khuyến mãi" value=""></td>
                                            </tr>
                                            <tr>
                                                <td><label>Nhà sản xuất:</label></td>
                                                <td colspan="3">
                                                    <select name="producer" class="form-control">
                                                        @foreach($producer as $producers)
                                                            <option <?php echo $product['producer'] == $producers['others_id'] ? "selected" : '' ?> value="{{$producers['others_id']}}">{{$producers['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Mô tả:</label></td>
                                                <td colspan="3">
                                                    <textarea class="form-control"  rows="3" name="comment">{{$product['comment']}}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ver-top"><label>Nội dung:</label></td>
                                                <td colspan="3">
                                                    <textarea class="form-control" id="content" name="content" style="visibility: hidden; display: none;">
                                                        {!! Request::old('content', $product['content']) !!}
                                                    </textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ver-top"><label>Upload photos:</label></td>
                                                <td colspan="3">
                                                    <input id="album" class="form-control file-upload" type="file" name="upload_images[]" data-max-file-count="15" accept="image/*" multiple>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Combo:</label></td>
                                                <td colspan="3">
                                                    @if($product['combo'] == 0)
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="combo" value="0" checked>Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="combo" value="1">Mở
                                                    </label>
                                                    @else
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="combo" value="0">Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="combo" value="1" checked>Mở
                                                    </label>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Trạng thái:</label></td>
                                                <td colspan="3">
                                                    @if($product['is_active'] == 1)
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="is_active" value="0">Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="is_active" value="1" checked>Mở
                                                    </label>
                                                    @else 
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="is_active" value="0" checked>Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="is_active" value="1">Mở
                                                    </label>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Nổi bật:</label></td>
                                                <td colspan="3">
                                                    @if($product['hot'] == 1)
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="hot" value="0">Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="hot" value="1" checked>Mở
                                                    </label>
                                                    @else 
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="hot" value="0" checked>Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="hot" value="1">Mở
                                                    </label>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Flash Sale:</label></td>
                                                <td colspan="3">
                                                    @if($product['pin'] == 1)
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="pin" value="0">Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="pin" value="1" checked>Mở
                                                    </label>
                                                    @else 
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="pin" value="0" checked>Đóng
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="pin" value="1">Mở
                                                    </label>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="tth-bg-df" colspan="4"><strong>SEO</strong> -<span class="tth-gp-text">Không bắt buộc phải nhập, dữ liệu được lấy tự động nếu rỗng.</span></td>
                                            </tr>
                                            <tr>
                                                <td class="tth-gp-l"><label>Title:</label></td>
                                                <td class="tth-gp-r" colspan="3"><input class="form-control" value="{{$product['title']}}" type="text" name="title" maxlength="255" value=""></td>
                                            </tr>
                                            <tr>
                                                <td class="tth-gp-l"><label>Description:</label></td>
                                                <td class="tth-gp-r" colspan="3"><input class="form-control" value="{{$product['description']}}" type="text" name="description" maxlength="255" value=""></td>
                                            </tr>
                                            <tr>
                                                <td class="tth-gp-l tth-gp-b"><label>Keywords:</label></td>
                                                <td class="tth-gp-r tth-gp-b" colspan="3"><input class="form-control" value="{{$product['keywords']}}" type="text" name="keywords" data-role="tagsinput" value="" style="display: none;">
                                                    <div class="bootstrap-tagsinput"><input type="text" placeholder="" style="width: 3em !important;"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="center" class="kc_button">
                                                    <button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
                                                    <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                    <a href="{{URL::to('admin/product_list&id_product_menu='.$product_menu['product_menu_id'])}}">
                                                        <button type="button" class="btn btn-form-info btn-form" >Thoát</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
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
                        "<img src='<?php echo asset('upload/product/'.$product['images'])  ?>' class='file-preview-image' >"
                    ],
                    allowedFileExtensions: ['jpg', 'png', 'gif']
                });
            </script>

            <script>

                $("#album").fileinput({
                    uploadUrl: "/uploads/product/",
                    uploadAsync: false,

                    <?php $product = json_decode($product['upload_images']); ?>

                    

                        initialPreview: [
                            <?php if($product != null){ 
                                    foreach ($product as $key => $row) {
                            ?>  

                                "<img src='<?php echo asset('upload/product/'.$row)  ?>' class='file-preview-image' >",

                            <?php 
                                    }
                                } 
                            ?>
                        ],

                    

                        initialPreviewConfig: [
                            <?php if($product != null){ 
                                    foreach ($product as $key => $row) {
                            ?>  

                                "<img src='<?php echo asset('upload/product/'.$row)  ?>' class='file-preview-image' >",

                            <?php 
                                    }
                                } 
                            ?>
                        ]

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