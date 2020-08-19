@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Nhóm quản trị</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}"> Trang chủ</a>
                    </li>
                    <li>
                        Quản trị hệ thống
                    </li>
                    <li>
                        Nhóm quản trị
                    </li>

                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel-no-border">
                        <div class="table-responsive">
                            <a class="btn-add-new" href="{{URL::to('admin/core_role_add')}}">Thêm nhóm</a>
                            <form method="post" id="deleteArt">
                                @csrf
                                <div id="dataTablesList_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table class="table display table-manager dataTable no-footer" cellspacing="0" cellpadding="0" id="dataTablesList" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-sort="ascending" aria-label="STT: kích hoạt để sắp xếp cột giảm dần" style="width: 56px;">STT</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Tên nhóm: kích hoạt để sắp xếp cột tăng dần" style="width: 137px;">Tên nhóm</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Trạng thái: kích hoạt để sắp xếp cột tăng dần" style="width: 115px;">Trạng thái</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Số thành viên: kích hoạt để sắp xếp cột tăng dần" style="width: 149px;">Số thành viên</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Ngày cập nhật: kích hoạt để sắp xếp cột tăng dần" style="width: 175px;">Ngày cập nhật</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Người cập nhật: kích hoạt để sắp xếp cột tăng dần" style="width: 165px;">Người cập nhật</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Chức năng" style="width: 145px;">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $stt = 0 ?>
                                        @foreach($core_role as $core_roles)
                                            <tr role="row" class="odd">
                                                <td align="center" class="sorting_1">{{++$stt}}</td>
                                                <td align="center">{{$core_roles['name']}}</td>
                                                <td align="center">
                                                    <input type="checkbox"
                                                    {{$core_roles->is_active == 1 ? "checked" : ""}}
                                                    id="show_{{$core_roles['role_id']}}" 
                                                    class="is_active_core_roles" 
                                                    value="{{$core_roles['role_id']}}"
                                                    name="is_active">
                                                    <!-- <div class="btn-event-open" data-toggle="tooltip" data-placement="top" title="Đóng" onclick="edit_status_core($(this), 1, 'is_active', 'core_role', 'role');" rel="0">1</div> -->
                                                </td>
                                                <td align="center">{{count($core_role)}}</td>
                                                <td align="center">{{$core_roles['updated_at']->format('d/m/y H:i')}}</td>
                                                <td align="center">admin</td>
                                                <td class="details-control" align="center">
                                                    <div class="checkbox">
                                                        <a href="{{URL::to('admin/core_role_edit&id_edit='.$core_roles['role_id'])}}"><img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg"></a> &nbsp;
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="delete[]" value="{{$core_roles['role_id']}}">
                                                    </label>&nbsp;&nbsp;
                                                        <a href="{{URL::to('admin/core_dasboard&role_id='.$core_roles['role_id'])}}"><img data-toggle="tooltip" data-placement="top" title="Quyền quản trị" src="images/view.svg"></a>
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
                                        <label class="radio-inline"><input type="checkbox" data-toggle="tooltip" data-placement="top" id="selecctall" name="delete_all" title="Chọn xóa tất cả"></label>
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
                            "aTargets": [6, "no-sort"]
                        }],
                        "paging": false,
                        "info": false,
                        "order": [
                            [0, "asc"]
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