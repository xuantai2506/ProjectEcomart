@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 165px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Slider</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/others_manager')}}"><i class="fa fa-edit"></i>Quản lý danh mục khác</a>
                    </li>
                    <li>
                        <i class="fa fa-list"></i> Danh sách hình ảnh </li>

                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel-no-border">
                        <div class="table-responsive">
                            <a class="btn-add-new" href="{{URL::to('admin/others_add&id='.$id_others_menu)}}">Thêm bài viết</a>

                            <p>&nbsp;&nbsp;</p>

                            <form id="deleteArt"  method="post" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="list_id" value="30">
                                <div id="dataTablesList_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table class="table display table-manager dataTable no-footer" cellspacing="0" cellpadding="0" id="dataTablesList" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-sort="ascending" aria-label="STT: kích hoạt để sắp xếp cột giảm dần" style="width: 37px;">STT</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Tiêu đề: kích hoạt để sắp xếp cột tăng dần" style="width: 70px;">Tiêu đề</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Giá (đ): kích hoạt để sắp xếp cột tăng dần" style="width: 72px;">Hiển thị</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Nổi bật: kích hoạt để sắp xếp cột tăng dần" style="width: 57px;">Nổi bật</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Lượt xem: kích hoạt để sắp xếp cột tăng dần" style="width: 72px;">Lượt xem</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Ngày đăng: kích hoạt để sắp xếp cột tăng dần" style="width: 120px;">Ngày đăng</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Người đăng: kích hoạt để sắp xếp cột tăng dần" style="width: 89px;">Người đăng</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Chức năng" style="width: 75px;">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <?php $stt = 0 ?>
                                        @foreach($other as $others)
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td align="center" class="sorting_1">{{++$stt}}</td>
                                                
                                                <td><span class="tth-ellipsis">{{$others['name']}}</span></td>
												<td align="center">
													@if($others['is_active'] == 1)
                                                    <input type="checkbox" id="{{$others['others_id']}}" class="is_active_others" name="is_active" checked value="1">
                                                    @else 
                                                    <input type="checkbox" id="{{$others['others_id']}}" class="is_active_others" name="is_active" value="0">
                                                    @endif
												</td>

                                                <td align="center">
                                                    @if($others['hot'] == 1)
                                                    <input type="checkbox" id="{{$others['others_id']}}" class="hot_others" name="hot" checked value="1">
                                                    @else 
                                                    <input type="checkbox" id="{{$others['others_id']}}" class="hot_others" name="hot" value="0">
                                                    @endif
                                                </td>

                                                <td align="center">43</td>
                                                <td align="center">{{ date("Y-m-d H:i:s", strtotime($others['created_at'])) }}</td>
                                                <td align="center">admin</td>

                                                <td class="details-control" align="center">
                                                    <div class="checkbox">
                                                        <a href="{{URL::to('admin/others_edit&id_edit='.$others['others_id'])}}">
                                                            <img data-toggle="tooltip" data-placement="top" title="" src="images/setting.svg" data-original-title="Chỉnh sửa"></a>
                                                        &nbsp;&nbsp;
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="delete[]" value="{{$others['others_id']}}">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6" align="right" style="padding: 7px 0;">
                                        <label class="radio-inline">
                                        	<input type="checkbox" id="selecctall" data-toggle="tooltip" data-placement="top" name="delete_all" title="Chọn xóa tất cả">
                                        </label>
                                        <input type="button" class="btn btn-primary btn-xs confirmManager" name="deleteArt"  value="delete" name="">
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

        
@endsection