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
                        <a href="{{URL::to('admin/product_manager')}}"><i class="fa fa-edit"></i>Danh mục sản phẩm</a>
                    </li>
                    <li>
                        <i class="fa fa-list"></i> Danh sách sản phẩm </li>

                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel-no-border">
                        <div class="table-responsive">

                            <a class="btn-add-new" href="{{URL::to('admin/product_add&id_product_menu='.$id_product_menu)}}">Thêm bài viết</a>

                           <!--  <a class="btn-add-new" href="{{URL::to('admin/gallery_list&id_menu_gal='.$id_gal_partner.'&id_product='.$id_product_menu)}}">Thêm thương hiệu</a>
 -->
                            <p>&nbsp;&nbsp;</p>

                            <form id="deleteArt"  method="post" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="list_id" value="30">
                                <div id="dataTablesList_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table class="table display table-manager dataTable no-footer" cellspacing="0" cellpadding="0" id="dataTablesList" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-sort="ascending" aria-label="STT: kích hoạt để sắp xếp cột giảm dần" style="width: 37px;">STT</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Hình" style="width: 39px;">Hình</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Tiêu đề: kích hoạt để sắp xếp cột tăng dần" style="width: 301px;">Tiêu đề</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Giá (đ): kích hoạt để sắp xếp cột tăng dần" style="width: 72px;">Giá (đ)</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Trạng thái: kích hoạt để sắp xếp cột tăng dần" style="width: 78px;">Trạng thái</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Nổi bật: kích hoạt để sắp xếp cột tăng dần" style="width: 57px;">Nổi bật</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Lượt xem: kích hoạt để sắp xếp cột tăng dần" style="width: 72px;">Lượt xem</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Ngày đăng: kích hoạt để sắp xếp cột tăng dần" style="width: 120px;">Ngày đăng</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTablesList" rowspan="1" colspan="1" aria-label="Người đăng: kích hoạt để sắp xếp cột tăng dần" style="width: 89px;">Người đăng</th>
                                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Chức năng" style="width: 75px;">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <?php $stt = 0 ?>

                                        @foreach($product as $products)
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td align="center" class="sorting_1">{{++$stt}}</td>

                                                @if($products['images'] == 'no')
                                                <td align="center">
                                                    <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                                </td>
                                                @else 
                                                <td align="center">
                                                    <img class="popover-3" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                                    <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                        <div class="arrow"></div>
                                                        <h3 class="popover-title">Sản phẩm</h3>
                                                        <div class="popover-content"><img src="{{asset('upload/product/'.$products['images'])}}"></div>
                                                    </div>
                                                    <script>
                                                        var image = '<img src="{{asset('upload/product/'.$products['images'])}}">';
                                                        $('.popover-3').popover({
                                                            placement: 'bottom',
                                                            content: image,
                                                            html: true
                                                        });
                                                    </script>
                                                </td>
                                                @endif

                                                <td><span class="tth-ellipsis">{{$products['name']}}</span></td>
                                                <td><?php echo number_format($products['price']); ?> VND</td>
                                                <td align="center">
                                                    @if($products['is_active'] == 1)
                                                    <input type="checkbox" id="{{$products['product_id']}}" class="is_active_product" name="is_active" checked value="1">
                                                    @else 
                                                    <input type="checkbox" id="{{$products['product_id']}}" class="is_active_product" name="is_active" value="0">
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    @if($products['hot'] == 1)
                                                    <input type="checkbox" id="{{$products['product_id']}}" class="hot_product" name="hot" checked value="1">
                                                    @else 
                                                    <input type="checkbox" id="{{$products['product_id']}}" class="hot_product" name="hot" value="0">
                                                    @endif
                                                    </td>
                                                <td align="center">42</td>
                                                <td align="center">{{ date("Y-m-d H:i:s", strtotime($products['created_at'])) }}</td>
                                                <td align="center">admin</td>
                                                <td class="details-control" align="center">
                                                    <div class="checkbox">
                                                        <a href="{{URL::to('admin/product_edit&id_edit='.$products['product_id'])}}">
                                                            <img data-toggle="tooltip" data-placement="top" title="" src="images/setting.svg" data-original-title="Chỉnh sửa"></a>
                                                        &nbsp;&nbsp;
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="delete[]" value="{{$products['product_id']}}">
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
                                        <label class="radio-inline"><input type="checkbox" id="selecctall" name="delete_all" data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả"></label>
                                        <input type="button" class="btn btn-primary btn-xs confirmManager " value="Xóa" name="deleteArt">
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