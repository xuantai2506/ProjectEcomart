@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Thông tin cá nhân</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="/adminjet"> Trang chủ</a>
                    </li>
                    <li>
                        Thông tin cá nhân
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding-top: 0; padding-bottom: 0;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="">
                                    <a href="#info" data-toggle="tab">
                                        <i class="fa fa-user"></i> Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#pass" data-toggle="tab">
                                        <i class="fa fa-gear fa-fw"></i> Đổi mật khẩu
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade " id="info">
                                    <form id="change_info" action="update_profile" name="changeInfo" method="post" enctype="multipart/form-data">
                                    	@csrf
                                        <table class="table table-hover" style="width: 70%;">
                                            <tbody>
                                                <tr>
                                                    <td width="150px"><label>Tên đăng nhập:</label></td>
                                                    <td><input class="form-control" type="text" name="user_name" id="user_name" readonly="" value="{{$get_profile['user_name']}}"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Nhóm quản trị:</label></td>
                                                    @if($get_profile['role_id'] == 1)
                                                    <td><input class="form-control" type="text" name="role_id" id="role_id" readonly="" value="1">Administator</td>
                                                    @else 
                                                    <td><input class="form-control" type="text" name="role_id" id="role_id" readonly="" value="2">Khách</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><label>Họ và tên:</label></td>
                                                    <td><input class="form-control" type="text" name="full_name" id="full_name" value="{{$get_profile['full_name']}}" maxlength="150"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Giới tính:</label></td>
                                                    <td>
                                                        <select class="form-control" name="gender" id="gender" style="width: 120px;">
						                                    <option value="0">Khác...</option>
						                                    @if($get_profile['gender'] == 0)
						                                    <option value="1" selected="">Nam</option>
						                                    @else 
						                                    <option value="2" selected="">Nữ</option>
						                                    @endif
						                                </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Ngày sinh:</label></td>
                                                    <td><input class="form-control input-datetime" type="text" name="birthday" style="width: 120px;" value="{{ date('D-m-y', strtotime($get_profile['birthday'])) }}"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Vị trí (công ty):</label></td>
                                                    <td><input class="form-control" type="text" name="apply" id="apply" value="{{$get_profile['apply']}}" maxlength="255"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Email:</label></td>
                                                    <td><input class="form-control" type="email" name="email" id="email" value="{{$get_profile['email']}}" maxlength="200"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Số điện thoại:</label></td>
                                                    <td><input class="form-control" type="text" name="phone" id="phone" value="{{$get_profile['phone']}}" maxlength="20"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Facebook:</label></td>
                                                    <td><input class="form-control" type="text" name="address" id="address" value="{{$get_profile['address']}}" maxlength="255"></td>
                                                </tr>
                                                <tr>
                                                    <td class="ver-top"><label>Hình đại diện:</label></td>
                                                    <td><input class="form-control file file-img" type="file" name="images" data-show-upload="true" data-max-file-count="1" accept="image/*"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Trạng thái:</label></td>
                                                    <td>
                                                        <b>Mở</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Cập nhật gần nhất:</label></td>
                                                    <td>{{ date('D-m-y H:i:s', strtotime($get_profile['updated_at'])) }}&nbsp;&nbsp; - &nbsp;&nbsp;<b>Thực hiện:</b> admin</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" align="center">
                                                        <button type="submit"  class="btn btn-form-primary btn-form" id="btnChangeInfo">Đồng ý</button> &nbsp;
                                                        <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                        <button type="button" class="btn btn-form-info btn-form" onclick="location.href='/admin/home'">Thoát</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <script>
                                            window.onload = userChangeInfo();
                                            $('.input-datetime').datetimepicker({
                                                mask: '39/19/9999',
                                                lang: 'vi',
                                                timepicker: false,
                                                format: 'd/m/Y'
                                            });
                                            $('.file-img').fileinput({
                                                initialPreview: [
                                                    "<img src='../uploads/user/avatar.png' class='file-preview-image' title='avatar.png' alt='avatar.png'>"
                                                ],
                                                allowedFileExtensions: ['jpg', 'png', 'gif']
                                            });
                                        </script>
                                    </form>
                                </div>
                                <div class="tab-pane fade active in" id="pass">
                                    <form id="change_pass" action="change_password" name="changePass" method="post" enctype="multipart/form-data">
									@csrf
                                        <table class="table table-hover" style="width: 70%;">
                                            <tbody>
                                                <tr>
                                                    <td width="150px"><label>Mật khẩu hiện tại:</label></td>
                                                    <td><input class="form-control" type="password" name="password2old" id="password2old" autocomplete="off" maxlength="16"></td>
                                                </tr>
                                                <tr>
                                                    <td width="150px"><label>Mật khẩu mới:</label></td>
                                                    <td><input class="form-control" type="password" name="password" id="password" autocomplete="off" maxlength="16"></td>
                                                </tr>
                                                <tr>
                                                    <td width="150px"><label>Nhập lại mật khẩu:</label></td>
                                                    <td><input class="form-control" type="password" name="rePassword" id="rePassword" autocomplete="off" maxlength="16"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" align="center">
                                                        <button type="submit" name="updatePass" class="btn btn-form-primary btn-form" id="btnChangePass">Đồng ý</button> &nbsp;
                                                        <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                        <button type="button" class="btn btn-form-info btn-form" onclick="location.href='/adminjet'">Thoát</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <script>
                                            window.onload = userChangePassword();
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
        </div>
       @endsection