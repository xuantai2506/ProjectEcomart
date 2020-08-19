@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 165px;">
            <div class="row">
                <h2 class="title_sp">Thêm phần bổ sung</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        Thêm phần  bổ sung
                    </li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-heading">
                            <i class="fa fa-files-o"></i>Thêm phần bổ sung
                        </div>
                        <div class="panel-body">
                            <div class="table-respon">

                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <table class="table table-hover" style="width: 70%;">

                                        <tr>

                                            <td width="150px" align="right"><label>Alias</label></td>

                                            <td><input class="form-control" value="{{old('alias')}}" type="text" id="alias" name="alias" maxlength="200" required></td>

                                        </tr>

                                        <tr>

                                            <td align="right" class="ver-top"><label>Tên trang:</label></td>

                                            <td><input class="form-control" type="text" value="{{old('name')}}" id="name" name="name" maxlength="200" required></td>

                                        </tr>

                                        <tr>

                                            <td align="right" class="ver-top"><label>Mô tả:</label></td>

                                            <td>
                                                <textarea class="form-control" name="comment" rows="3">{{old('comment')}}</textarea>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="ver-top"><label>Nội dung:</label></td>
                                            <td colspan="3">
                                                <textarea class="form-control" id="content" name="content" style="visibility: hidden; display: none;"></textarea>
                                            </td>
                                        </tr>

                                        <tr>

                                            <td align="right"><label>Hiển thị:</label></td>

                                            <td>

                                                <label class="radio-inline">
                                                    <input type="radio" name="is_active" value="0"> Đóng
                                                </label>

                                                <label class="radio-inline">
                                                    <input type="radio" name="is_active" value="1"  > Mở
                                                </label>

                                            </td>

                                        </tr>
                                       
                                        <tr>

                                            <td colspan="2" align="center" class="kc_button">

                                                <button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;

                                                <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                <a href="{{URL::to('admin/plus_manager')}}">
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