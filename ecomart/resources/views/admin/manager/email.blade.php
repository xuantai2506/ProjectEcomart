@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Đăng ký email</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Trang chủ</a>
                    </li>
                    <li>
                        Quản lý nội dung
                    </li>
                    <li>
                        Email đăng ký nhận tin khuyến mãi
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel-no-border khoangcach">
                        <div class="table-responsive">
                            <form  method="post" enctype="multipart/form-data" id="deleteArt">
                                @csrf
                                <div id="dataTablesList_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table class="table display table-manager dataTable no-footer" cellspacing="0" cellpadding="0" id="dataTablesList" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th width="100px" class="sorting_asc" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-sort="ascending" aria-label="STT: kích hoạt để sắp xếp cột giảm dần" style="width: 100px;">STT</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Email: kích hoạt để sắp xếp cột tăng dần" style="width: 442px;">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Ngày đăng ký: kích hoạt để sắp xếp cột tăng dần" style="width: 321px;">Ngày đăng ký</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Chọn" style="width: 105px;">Chọn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $stt = 0; ?>
                                            @foreach($get_register_email as $get_register_emails)
                                            <tr role="row" class="odd">
                                                <td align="center" class="sorting_1">{{++$stt}}</td>
                                                <td align="center">{{$get_register_emails['email']}}</td>
                                                <td align="center">{{ date("Y-m-d H:i:s", strtotime($get_register_emails['created_at'])) }}</td>
                                                <td class="details-control" align="center">
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="delete[]" value="{{$get_register_emails['register_email_id']}}">
                                                    </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6" align="right" style="padding: 7px 0;">
                                        <input type="button" class="btn btn-primary btn-xs" value="Xuất tất cả dữ liệu ra file Excel" name="exXls" onclick="Forward('export_excel.php');">
                                        <label class="radio-inline"><input type="checkbox" id="selecctall" data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả"></label>
                                        <input type="button" class="btn btn-primary btn-xs confirmManager" id="{{URL::to('admin/email_manager')}}" value="Xóa" name="delete">
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
                            "aTargets": [3, "no-sort"]
                        }],
                        "paging": false,
                        "info": false,
                        "order": [0, "asc"]
                    });
                });
            </script>
        </div>
      @endsection