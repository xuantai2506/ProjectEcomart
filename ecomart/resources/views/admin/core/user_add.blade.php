@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Thêm thành viên</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}"> Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/core-user')}}"> Quản lý thành viên</a>
                    </li>
                    <li>
                        Thêm thành viên
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-body">
                            
                            @if(session('fail'))
                                <div class="alert alert-danger">
                                     <div class="alert-title">{{session('fail')}}</div>
                                </div>
                            @endif
                            <form method="post" enctype="multipart/form-data" name="member" id="memberUser">
                                @csrf
                                <div class="panel-show-error">
                                </div>
                                <table class="table table-hover" style="width: 70%;">
                                    <tbody>
                                        <tr>
                                            <td><label>Tên đăng nhập(email):</label></td>
                                            <td><input class="form-control" type="email" name="email" id="email" value="{{old('email')}}" autocomplete="off" maxlength="200"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Mật khẩu mới:</label></td>
                                            <td><input class="form-control" type="password" name="password" id="password" value="" autocomplete="off" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Nhập lại mật khẩu:</label></td>
                                            <td><input class="form-control" type="password_confirmation" name="rePassword" id="rePassword" value="" autocomplete="off" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Nhóm quản trị:</label></td>
                                            <td>
                                                <select class="form-control" required="required" name="role_id">
                                                    @foreach($core_role as $core_roles)
                                                    <option value="{{$core_roles['role_id']}}">{{$core_roles['name']}}</option>
                                                    @endforeach
                                                </select> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Họ và tên:</label></td>
                                            <td><input class="form-control" type="text" name="full_name" value="{{old('full_name')}}" id="full_name" value="" autocomplete="off" maxlength="150"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Giới tính:</label></td>
                                            <td>
                                                <select class="form-control" name="gender" id="gender" style="width: 120px;">
                                                <option value="0" selected="">Khác...</option>
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Ngày sinh:</label></td>
                                            <td><input class="form-control input-datetime" type="text" value="{{old('birthday')}}" name="birthday" style="width: 120px;"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Vị trí (công ty):</label></td>
                                            <td><input class="form-control" type="text" name="apply" id="apply" value="{{old('apply')}}" autocomplete="off" maxlength="255"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Số điện thoại:</label></td>
                                            <td><input class="form-control" type="text" name="phone" id="phone" value="{{old('phone')}}" autocomplete="off" maxlength="20"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Địa chỉ:</label></td>
                                            <td><input class="form-control" type="text" name="address" id="address" value="{{old('address')}}" autocomplete="off" maxlength="255"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Tỉnh/ Thành phố:</label></td>
                                            <td>
                                                <input class="form-control" type="text" name="asd" id="" value="" autocomplete="off" maxlength="255" disabled="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Quận/ huyện:</label></td>
                                            <td id="billing_country11">
                                                <!-- <select name="district" data-placeholder="Chọn quận huyện… " class=" chosen-select " tabindex="-1 ">
                                                <option value="">Chọn quận huyện…</option>
                                                                             <option value="" selected></option> -->
                                                <input class="form-control" type="text" name="asd" id="" value="" autocomplete="off" maxlength="255" disabled="">
                                                <!-- </select> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Phường/ xã:</label></td>
                                            <td id="billing_country111">
                                                <!-- <select name="ward" id="billing_country " data-placeholder="Chọn phường xã…" class=" chosen-select " tabindex="-1 ">
                                                <option value="Chọn phường xã…">Chọn phường xã…</option>
                                                                                    <option value="" selected></option> -->
                                                <input class="form-control" type="text" name="asd" id="" value="" autocomplete="off" maxlength="255" disabled="">
                                                <!-- </select>  -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Giới thiệu:</label></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <textarea class="form-control" value="{{old('comment')}}" name="comment" id="comment"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ver-top"><label>Hình đại diện:</label></td>
                                            <td>
                                                <input class="form-control file file-img" type="file" name="images" data-show-upload="false" data-max-file-count="1" accept="image/*">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Hiển thị:</label> <i>(giới thiệu)</i></td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" name="is_show" value="0"> Đóng</label>
                                                <label class="radio-inline"><input type="radio" name="is_show" value="1" checked=""> Mở</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Sao *:</label></td>
                                            <td>
                                                <select class="form-control" name="vote" style="width: 150px; color: #fcdf26; font-size: 1.3em; line-height: 1em;">
                                                <option value="1">★</option>
                                                <option value="2">★ ★</option>
                                                <option value="3" selected="">★ ★ ★</option>
                                                <option value="4">★ ★ ★ ★</option>
                                                <option value="5">★ ★ ★ ★ ★</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Trạng thái:</label></td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" name="is_active" value="0"> Đóng</label>
                                                <label class="radio-inline"><input type="radio" name="is_active" value="1" checked=""> Mở</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center" class="kc_button">
                                                <button type="submit" class="btn btn-form-primary btn-form" id="user">Đồng ý</button> &nbsp;
                                                <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                <button type="button" class="btn btn-form-info btn-form" onclick="location.href='/admin/core-user'">Thoát</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <script>
                                window.onload = checkAddUser();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                CKEDITOR.replace('comment', {
                    height: 400
                });
                $('.input-datetime').datetimepicker({
                    mask: '39/19/9999',
                    lang: 'vi',
                    timepicker: false,
                    format: 'd/m/Y',
                    closeOnDateSelect: true
                });
                $('.file-img').fileinput({
                    allowedFileExtensions: ['jpg', 'png', 'gif']
                });
            </script>
        </div>
@endsection