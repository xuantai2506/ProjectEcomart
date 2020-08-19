@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Cấu hình SMTP</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html"> Trang chủ</a>
                    </li>
                    <li>
                        Cấu hình
                    </li>
                    <li>
                        Cấu hình SMTP
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-body">
                            <div class="table-respon">
                                <form  method="post">
                                    @csrf
                                    <table class="table table-hover" style="width: 70%;">
                                       
                                        <tbody>
                                         @foreach($getConstant as $getConstants)
                                            @csrf
                                            <input type="hidden" name="name_constant[]" value="{{$getConstants['constant']}}" >
                                            @if($getConstants['constant'] == 'SMTP_password')
                                            <tr>
                                                <td><label>{{$getConstants['name']}}:</label></td>
                                                <td>
                                                    <input class="form-control" type="password" maxlength="200" name="value_constant[]" value="{{$getConstants['value']}}" required="required">
                                                </td>
                                            </tr>
                                            @else 
                                            <tr>
                                                <td width="200px"><label>{{$getConstants['name']}}:</label></td>
                                                <td><input class="form-control" type="text" name="value_constant[]" value="{{$getConstants['value']}}" required="required"></td>
                                            </tr>
                                            @endif
                                        @endforeach
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