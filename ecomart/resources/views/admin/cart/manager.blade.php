@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Booking</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Trang chủ</a>
                    </li>
                    <li>
                        Quản lý nội dung
                    </li>
                    <li>
                        Booking online
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
                                                <th width="50px" class="sorting_asc" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-sort="ascending" aria-label="STT: kích hoạt để sắp xếp cột giảm dần" style="width: 50px;">STT</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Tên khách hàng: kích hoạt để sắp xếp cột tăng dần" style="width: 163px;">Tên khách hàng</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Điện thoại: kích hoạt để sắp xếp cột tăng dần" style="width: 119px;">Điện thoại</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Trạng thái: kích hoạt để sắp xếp cột tăng dần" style="width: 156px;">Trạng thái</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Thanh toán: kích hoạt để sắp xếp cột tăng dần" style="width: 121px;">Thanh toán</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Ngày đặt" style="width: 164px;">Ngày đặt</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Chọn: kích hoạt để sắp xếp cột tăng dần" style="width: 194px;">Chọn</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($get_cart as $get_carts)
                                            <tr role="row" class="odd">
                                                <td align="center" class="sorting_1">1</td>
                                                <td align="center">{{$get_carts['name']}}</td>
                                                <td align="center">{{$get_carts['phone']}}</td>
                                                <td align="center" id="view_{{$get_carts['order_id']}}">
                                                @if($get_carts['is_view'] == 0)
                                                
                                                    <button type="button" id="{{$get_carts['order_id']}}" class="btn btn-sm-sm btn-warning is_view_cart" data-toggle="tooltip" data-placement="top" title="" rel="0" data-original-title="Chuyển sang: Đã xem">Chưa xem</button>
                                                
                                                @else

                                                    <button type="button" id="{{$get_carts['order_id']}}" class="btn btn-sm-sm btn-success is_view_cart" data-toggle="tooltip" data-placement="top" title="Chuyển sang: Chưa xem"  rel="1" data-original-title="Chuyển sang: Chưa xem">Đã xem</button>       
                                                @endif
                                                </td>

                                                <td align="center" >
                                                    @if($get_carts['is_show'] == 1)
                                                    <input type="checkbox" id="{{$get_carts['order_id']}}" class="is_show_cart" name="is_show" value="Mở" checked value="1">
                                                    @else 
                                                    <input type="checkbox" id="{{$get_carts['order_id']}}" class="is_show_cart" name="is_show" value="Đóng" value="0">
                                                    @endif
                                                </td>
                                                <td align="center">{{ date("Y-m-d H:i:s", strtotime($get_carts['created_at'])) }}</td>
                                                <td class="details-control" align="center">
                                                    <span class="btn btn-primary btn-sm-sm" data-toggle="modal" data-target="#_order_{{$get_carts['order_id']}}" >Xem</span>&nbsp;
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="delete[]" value="{{$get_carts['order_id']}}">
                                                    </label>
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
                                <!-- modal -->
                                @include('admin.cart.modal')
                                <!-- end modal -->
                                <div class="row check_xoa">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6" align="right" style="padding: 7px 0;">
                                        <label class="radio-inline"><input type="checkbox" data-toggle="tooltip" name="delete_all" id="selecctall" data-placement="top" title="Chọn xóa tất cả"></label>
                                        <input type="button" class="btn btn-primary btn-xs confirmManager" value="Xóa" name="delete">
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
                            "aTargets": [5, "no-sort"]
                        }],
                        "paging": false,
                        "info": false,
                        "order": [0, "asc"]
                    });

                });=
            </script>
        </div>
@endsection