@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Mạng xã hội</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        Cấu hình
                    </li>
                    <li>
                        Mạng xã hội
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-body">
                            <div class="table-respon">
                                <form enctype="multipart/form-data" method="post">
                                    @csrf
                                    <table class="table table-hover" style="width: 70%;">
                                        <tbody>
                                            @foreach($getConstant as $getConstants)
                                            <input type="hidden" name="name_constant[]" value="{{$getConstants['constant']}}" >
                                            <tr>
                                                <td width="200px"><label>{{$getConstants['name']}}:</label></td>
                                                <td>
                                                    <input class="form-control" type="text" name="value_constant[]" value="{{$getConstants['value']}}">
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2" align="center" class="kc_button">
                                                    <button type="submit" name="update" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
                                                    <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                    <button type="button" class="btn btn-form-info btn-form" onclick="location.href='/admin/home'">Thoát</button>
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