@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Quản lý thành viên</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}"> Trang chủ</a>
                    </li>
                    <li>
                        Quản trị hệ thống
                    </li>
                    <li>
                        Quản lý thành viên
                    </li>

                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel-no-border">
                        <div class="table-responsive">
                            <a class="btn-add-new" href="{{URL::to('admin/core_user_add')}}">Thêm thành viên</a>
                            <form  method="post" id="deleteArt">
                                @csrf
                                <div id="dataTablesList_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table class="table display table-manager dataTable no-footer" cellspacing="0" cellpadding="0" id="dataTablesList" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-sort="ascending" aria-label="STT: kích hoạt để sắp xếp cột giảm dần" style="width: 43px;">STT</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Hình" style="width: 45px;">Hình</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Tên đăng nhập: kích hoạt để sắp xếp cột tăng dần" style="width: 126px;">Tên đăng nhập</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Trang thái: kích hoạt để sắp xếp cột tăng dần" style="width: 90px;">Trang thái</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Hiển thị: kích hoạt để sắp xếp cột tăng dần" style="width: 71px;">Hiển thị</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Sắp xếp: kích hoạt để sắp xếp cột tăng dần" style="width: 73px;">Sắp xếp</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Nhóm quản trị: kích hoạt để sắp xếp cột tăng dần" style="width: 122px;">Nhóm quản trị</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Họ và tên: kích hoạt để sắp xếp cột tăng dần" style="width: 109px;">Họ và tên</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Ngày tạo: kích hoạt để sắp xếp cột tăng dần" style="width: 139px;">Ngày tạo</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Chức năng" style="width: 114px;">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $stt = 0 ?>
                                            @foreach($core_user as $core_users)
                                            <tr role="row" class="odd">
                                                <td align="center" class="sorting_1">1</td>
                                                @if($core_users['images'] == 'no')
                                                <td align="center">
                                                    <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                                </td>
                                                @else 
                                                <td align="center">
                                                    <img class="popover-1" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                                    <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                        <div class="arrow"></div>
                                                        <h3 class="popover-title">Sản phẩm</h3>
                                                        <div class="popover-content"><img src="{{asset('upload/admin/user/'.$core_users['images'])}}"></div>
                                                    </div>
                                                    <script>
                                                        var image = '<img src="{{asset('upload/admin/user/'.$core_users['images'])}}">';
                                                        $('.popover-1').popover({
                                                            placement: 'bottom',
                                                            content: image,
                                                            html: true
                                                        });
                                                    </script>
                                                </td>
                                                @endif
                                                <td align="center">{{$core_users['email']}}</td>
                                                <td align="center">
                                                    <input type="checkbox" 
                                                    {{$core_users->is_active == 1 ? "checked" : ""}}
                                                    id="is_active_{{$core_users['user_id']}}" 
                                                    class="is_active_core_user" 
                                                    value="{{$core_users['user_id']}}"
                                                    name="is_active">
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" 
                                                    {{$core_users->is_show == 1 ? "checked" : ""}}
                                                    id="show_{{$core_users['user_id']}}" 
                                                    class="is_show_core_user" 
                                                    value="{{$core_users['user_id']}}"
                                                    name="is_show">
                                                </td>
                                                <td align="center">
                                                    <select onchange="performSortUser(1, this.value, 'core_user')" name="sort_1" class="form-control select-manager" style="width:90%;">
                                                        <option value="1" selected="">1</option>
                                                        <option value="2">2</option>	
                                                    </select>
                                                </td>
                                                @foreach($core_role as $core_roles)
                                                @if($core_roles['role_id'] == $core_users['role_id'])
                                                <td>
                                                    {{$core_roles['name']}}
                                                </td>
                                                @endif
                                                @endforeach
                                                <td>
                                                    {{$core_users['full_name']}}
                                                </td>
                                                <td align="center">
                                                    {{$core_users['created_at']->format('d/m/y H:i')}}
                                                </td>
                                                <td class="details-control" align="center">
                                                    <div class="checkbox">
                                                        <a href="{{URL::to('admin/core_user_edit&id_edit='.$core_users['user_id'])}}"><img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg"></a> &nbsp;

                                                        <label class="checkbox-inline">

                                                        <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="delete[]" value="{{$core_users['user_id']}}">
                                                    
                                                        </label>&nbsp;&nbsp;

                                                 <!--        <a href="{{URL::to('admin/core_dasboard&id_edit='.$core_roles['role_id'])}}"><img data-toggle="tooltip" data-placement="top" title="Quyền quản trị" src="images/view.svg"></a> -->
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-6"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6" align="right" style="padding: 7px 0;">
                                        <label class="radio-inline"><input type="checkbox" name="delete_all" id="selecctall" data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả"></label>
                                        <input type="button" class="btn btn-primary btn-xs confirm" value="Xóa" name="deleteArt">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            
            <script>
                $(document).ready(function() {
                    $('#dataTablesList').dataTable({
                        "language": {
                            "url": "/adminjet/js/plugins/dataTables/de_DE.txt"
                        },
                        "aoColumnDefs": [{
                            "bSortable": false,
                            "aTargets": [1, 9, "no-sort"]
                        }],
                        "paging": false,
                        "info": false,
                        "order": [0, "asc"],
                        "columns": [
                            null,
                            null,
                            null,
                            null,
                            null, {
                                "orderDataType": "dom-select"
                            },
                            null,
                            null,
                            null,
                            null
                        ]
                    });

                    $('#selecctall').click(function(event) {
                        if (this.checked) {
                            $('.checkboxArt').each(function() {
                                this.checked = true;
                            });
                        } else {
                            $('.checkboxArt').each(function() {
                                this.checked = false;
                            });
                        }
                    });
                });
                $(".confirm").click(function() {
                    var element = $(this);
                    var action = element.attr("id");
                    confirm("Tất cả các dữ liệu liên quan sẽ được xóa và không thể phục hồi.\nBạn có muốn thực hiện không?", function() {
                        if (this.data == true) document.getElementById("deleteArt").submit();
                    });
                });
            </script>
        </div>
@endsection