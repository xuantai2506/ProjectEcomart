@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Thư liên hệ</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}"> Trang chủ</a>
                    </li>
                    <li>
                        Quản lý nội dung
                    </li>
                    <li>
                        Thư liên hệ
                    </li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel-no-border khoangcach">
                        <div class="table-responsive">
                            <form  method="post" enctype="multipart/form-data" id="deleteArt">
                            	@csrf
                                <div id="dataTablesList_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table class="table display table-manager lienhe dataTable no-footer" cellspacing="0" cellpadding="0" id="dataTablesList" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th width="50px" class="sorting_asc" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-sort="ascending" aria-label="STT: kích hoạt để sắp xếp cột giảm dần" style="width: 50px;">STT</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Tên khách hàng: kích hoạt để sắp xếp cột tăng dần" style="width: 139px;">Tên khách hàng</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Email: kích hoạt để sắp xếp cột tăng dần" style="width: 198px;">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Điện thoại: kích hoạt để sắp xếp cột tăng dần" style="width: 105px;">Điện thoại</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Hiển thị: kích hoạt để sắp xếp cột tăng dần" style="width: 138px;">Hiển thị</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Ngày gửi: kích hoạt để sắp xếp cột tăng dần" style="width: 144px;">Ngày gửi</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Chọn" style="width: 171px;">Chọn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($get_contact as $get_contacts)
                                            <tr role="row" class="odd">
                                                <td align="center" class="sorting_1">1</td>
                                                <td>{{$get_contacts['fullname']}}</td>
                                                <td>{{$get_contacts['email']}}</td>
                                                <td>0766708619</td>
                                                <td align="center">
                                                    <!--  onclick="status_view($(this), 11, 'is_active', 'contact');"  -->
                                                    @if($get_contacts['is_active'] == 0)
                                                    <button type="button" id="{{$get_contacts['contact_id']}}" class="btn btn-sm-sm btn-warning is_active_contact" data-toggle="tooltip" data-placement="top" title=""  rel="0" data-original-title="Chuyển sang: Đã xem">Chưa xem</button>
                                                    @else
                                                    <button type="button" id="{{$get_contacts['contact_id']}}" class="btn btn-success btn-sm-sm is_active_contact" data-toggle="tooltip" data-placement="top" title=""rel="1" data-original-title="Chuyển sang: Chưa xem">Đã xem</button>
                                                    @endif
                                                </td>
                                                <td align="center">{{ date("Y-m-d H:i:s", strtotime($get_contacts['created_at'])) }}</td>
                                                <td class="details-control" align="center">
                                                    <span class="btn btn-primary btn-sm-sm" data-toggle="modal" data-target="#_contact_{{$get_contacts['contact_id']}}" >Xem</span>&nbsp;
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="delete[]" value="{{$get_contacts['contact_id']}}">
                                                    </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- modal -->
                                @include('admin.manager.modal_agency')
                                <!-- end modal -->
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6" align="right" style="padding: 7px 0;">
                                        <label class="radio-inline"><input id="selecctall" type="checkbox" name="delete_all"  data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả"></label>
                                        <input type="button" class="btn btn-primary btn-xs confirmManager" id="{{URL::to('admin/agency_manager')}}" value="Xóa" name="delete">
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
                        "order": [0, "asc"]
                    });
                });
                
            </script>
        </div>
    @endsection