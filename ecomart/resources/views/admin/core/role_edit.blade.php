@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Thêm nhóm</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        Quản trị hệ thống
                    </li>
                    <li>
                        Nhóm quản trị
                    </li>
                    <li>
                        Thêm nhóm
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">

                        <div class="panel-body">
                            <form  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="panel-show-error">
                                </div>
                                <table class="table table-hover" style="width: 70%;">
                                    <tbody>
                                        <tr>
                                            <td width="150px"><label>Tên nhóm:</label></td>
                                            <td><input class="form-control"  value="{{$get_core_role['name']}}" type="text" name="name" maxlength="255" value="" required=""></td>
                                        </tr>
                                        <tr>
                                            <td class="ver-top"><label>Mô tả:</label></td>
                                            <td>
                                                <textarea class="form-control" rows="3" name="comment">{{$get_core_role['comment']}}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Trạng thái:</label></td>
                                            <td>
                                                @if($get_core_role['is_active'] == 1)
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
                                            <td colspan="2" align="center" class="kc_button">
                                                <button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
                                                <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                <button type="button" class="btn btn-form-info btn-form" onclick="location.href='/admin/core-role'">Thoát</button>
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
@endsection