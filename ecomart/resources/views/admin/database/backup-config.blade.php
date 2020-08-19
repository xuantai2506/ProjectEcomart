@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Cấu hình sao lưu</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}"> Trang chủ</a>
                    </li>
                    <li>
                        Cơ sở dữ liệu (CSDL)
                    </li>
                    <li>
                        Cấu hình sao lưu
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <script type="text/javascript" language="javascript">
                function IsNumberInt(str) {
                    for (var i = 0; i < str.length; i++) {
                        var temp = str.substring(i, i + 1);
                        if (!(temp == "," || temp == "." || (temp >= 0 && temp <= 9))) {
                            alert("Chỉ được nhập kiểu số nguyên dương vào ô này.");
                            return str.substring(0, i);
                        }
                        if (temp == " " || temp == "," || temp == ".")
                            return str.substring(0, i);
                    }
                    return str;
                }
            </script>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
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
                                <form action="{{URL::to('admin/backup-config/'.$getBackupEdit['constant_id'])}}"  method="post">
                                	@csrf
                                    <table class="table table-hover" style="width: 70%;">
                                        <tbody>
                                            <tr>
                                                <td width="250px"><label>Tự động sao lưu:</label></td>
                                                <td>
                                                    <select disabled name="backup_auto" class="form-control">
                                                        <option value="none">Không</option>
                                                        <option value="day">Hằng ngày</option>
                                                        <option value="week">Hằng tuần</option>
                                                        <option value="month">Hằng tháng</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Định dạng lưu file CSDL:</label></td>
                                                <td>
                                                    <select disabled name="backup_filetype" class="form-control">
                                                        <option value="sql" selected="">.zip</option>
                                                        <option value="sql.gz">.gz</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td><label>Số file CSDL lưu lại:</label></td>
                                                <td><input class="form-control" type="text" maxlength="3" onblur="if(this.value=='' || this.value==1) {this.value=1;}" onkeyup="this.value = IsNumberInt(this.value);" name="backup_filecount" value="5"></td>
                                            </tr> -->
                                            <tr>
                                                <td><label>Email nhận thông báo và file:</label><br>(để trống khi không muốn gửi)</td>
                                                <td><input class="form-control" type="email" maxlength="200" name="backup_email" value="{{$getBackupEdit['value']}}"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="center" class="kc_button">
                                                    <button type="submit" name="update" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
                                                    <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                    <a href="{{URL::to('admin/home')}}">
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
        </div>
        @endsection