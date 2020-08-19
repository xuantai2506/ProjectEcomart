@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 475px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Sản Phẩm</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        Sản phẩm
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="table-responsive">
                            <table class="table table-manager table-hover khoangcach">
                                <thead>
                                    <tr>
                                        <th colspan="2">Chuyên mục</th>
                                        <th>Sắp xếp</th>
                                        <th>Hiển thị</th>
                                        <th>Nổi bật</th>
                                        <th>Hình ảnh</th>
                                        <th>Chức năng</th>
                                        <th>Nội dung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- nhanh goc -->
                                    @foreach($category as $categories)

                                    <tr class="category">
                                        <td>{{$categories['name']}}</td>
                                        <td>&nbsp;</td>
                                        <td align="right">
                                            <select name="sortcat5" class="form-control select-manager" style="width:90%; font-weight:bold; color: #1d92af;">
                                                @foreach($sort_category as $sort)
                                                <option value="{{$sort}}" <?php echo ($sort == $categories['sort']) ? 'selected':'' ?>>
                                                {{$sort}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td align="center">
                                            <input 
                                            type="checkbox" 
                                            {{$categories->is_active == 1 ? "checked" : ""}}
                                            id="show_{{$categories['category_id']}}"
                                            class="is_active_category_gallery" 
                                            value="{{$categories['category_id']}}"
                                            name="show_article"
                                            data-placement="top"
                                            data-toggle="tooltip">
                                        </td>
                                        <td align="center">
                                            <input 
                                            type="checkbox"
                                            {{$categories->hot == 1 ? "checked" : ""}}
                                            id="hot_{{$categories['category_id']}}"
                                            class="hot_category_gallery"
                                            value="{{$categories['category_id']}}"
                                            name="impressed_article"
                                            data-toggle="tooltip"
                                            data-placement="top">
                                        </td>
                                        @if($categories['images'] == 'no')
                                        <td align="center">
                                            <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                        </td>
                                        @else 
                                        <td align="center">
                                            <img class="popover-3" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                            <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                <div class="arrow"></div>
                                                <h3 class="popover-title">Sản phẩm</h3>
                                                <div class="popover-content"><img src="{{asset('upload/product/'.$categories['images'])}}"></div>
                                            </div>
                                            <script>
                                                var image = '<img src="{{asset('upload/product/'.$categories['images'])}}">';
                                                $('.popover-3').popover({
                                                    placement: 'bottom',
                                                    content: image,
                                                    html: true
                                                });
                                            </script>
                                        </td>
                                        @endif
                                        <td align="center ">
                                            <a href="{{URL::to('admin/product_menu_add&id_cat='.$categories['category_id'])}}">
                                                <img data-toggle="tooltip" data-placement="left" title="Thêm mục" class="add_muc" src="images/plus.svg">
                                            </a>
                                            &nbsp;
                                            <a href="{{URL::to('admin/category_product_edit&id_edit='.$categories['category_id'])}}">
                                                <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                            </a>
                                            &nbsp;
                                            <span style="width: 16px; height: 1px; display: inline-block;"></span>
                                        </td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <!-- nhanh 1 -->
                                    @foreach($product_menu as $product_menus)
                                        <?php $sort_1 = 0; ?>
                                        @if($product_menus['category_id'] == $categories['category_id'] && $product_menus['parent'] == 0)
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td style="padding: 0 0 0 0px;"><img src="images/node.png">{{$product_menus['name']}}</td>
                                            <td align="right">
                                                <select onchange="" name="sort_1" class="form-control select-manager sort_product" id="{{$product_menus['product_menu_id']}}" style="width:80%;">
                                                    @foreach($sort_product as $sort)
                                                        @if($sort['category_id'] == $product_menus['category_id'] && $sort['parent'] == 0  )
                                                        <?php  $sort_1++; ?>
                                                        <option value="{{$sort_1}}" <?php echo ($sort_1 == $product_menus['sort'] ? 'selected' : '') ?> >{{$sort_1}}</option> 
                                                        @endif
                                                    @endforeach    
                                                </select>
                                            </td>
                                            <td align="center">
                                                <input 
                                                type="checkbox" 
                                                {{$product_menus->is_active == 1 ? "checked" : ""}}
                                                id="show_{{$product_menus['category_id']}}" 
                                                class="is_active_product_menu" 
                                                value="{{$product_menus['product_menu_id']}}"
                                                name="show_article"
                                                data-placement="top"
                                                data-toggle="tooltip">
                                            </td>
                                            <td align="center ">
                                                <input 
                                                type="checkbox" 
                                                {{$product_menus->hot == 1 ? "checked" : ""}}
                                                id="hot_{{$product_menus['category_id']}}"
                                                class="hot_product_menu"
                                                value="{{$product_menus['product_menu_id']}}"
                                                name="impressed_article"
                                                data-placement="top"
                                                data-toggle="tooltip">
                                            </td>
                                            @if($product_menus['images'] == 'no')
                                                <td align="center">
                                                    <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                                </td>
                                            @else 
                                                <td align="center">
                                                    <img class="popover-4" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                                    <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                        <div class="arrow"></div>
                                                        <h3 class="popover-title">Sản phẩm</h3>
                                                        <div class="popover-content"><img src="{{asset('upload/product/'.$product_menus['images'])}}"></div>
                                                    </div>
                                                    <script>
                                                        var image = '<img src="{{asset('upload/product/'.$product_menus['images'])}}">';
                                                        $('.popover-4').popover({
                                                            placement: 'bottom',
                                                            content: image,
                                                            html: true
                                                        });
                                                    </script>
                                                </td>
                                            @endif

                                            <td align="center ">
                                                <a href="{{URL::to('admin/product_menu_add&id_cat='.$product_menus['category_id'].'&id_product='.$product_menus['product_menu_id'])}}">   <img data-toggle="tooltip" data-placement="left" title="Thêm mục" class="add_muc" src="images/plus.svg">
                                                </a>
                                                &nbsp;
                                                <a href="{{URL::to('admin/product_menu_edit&id_edit='.$product_menus['product_menu_id'])}}">
                                                    <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                                </a>
                                                &nbsp;
                                                <a class="confirmManager2" id="{{URL::to('admin/product_manager&id_del='.$product_menus['product_menu_id'])}}" style="cursor: pointer;" id="">
                                                    <img data-toggle="tooltip" data-placement="right" title="Xóa mục" src="images/delete.svg">
                                                </a>
                                            </td>

                                            <td align="center">
                                                <a href="{{URL::to('admin/product_list&id_product_menu='.$product_menus['product_menu_id'])}}">
                                                    <img data-toggle="tooltip" data-placement="top" title="Danh sách bài viết" src="images/view.svg">
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- nhanh 2 -->
                                        @foreach($product_menu as $product_menu_2)
                                            <?php $sort_2 = 0; ?>
                                            @if($product_menu_2['parent'] == $product_menus['product_menu_id'])
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td style="padding: 0 0 0 30px;"><img src="images/node.png">
                                                    {{$product_menu_2['name']}}
                                                    <span class="bold-red"></span>
                                                </td>
                                                <td align="right">
                                                    <select onchange="" name="sort_1" class="form-control select-manager sort_product" id="{{$product_menu_2['product_menu_id']}}" style="width:80%;">
                                                        @foreach($sort_product as $sort)
                                                            @if($sort['category_id'] == $product_menu_2['category_id'] && $sort['parent'] != 0 && $sort['parent'] == $product_menu_2['parent'])
                                                            <?php  $sort_2++; ?>
                                                            <option value="{{$sort_2}}" <?php echo ($sort_2 == $product_menu_2['sort'] ? 'selected' : '') ?> >{{$sort_2}}</option> 
                                                            @endif
                                                        @endforeach   
                                                    </select>
                                                </td>
                                                <td align="center">
                                                    <input 
                                                    type="checkbox" 
                                                    {{$product_menu_2->is_active == 1 ? "checked" : ""}}
                                                    id="show_{{$product_menu_2['category_id']}}" 
                                                    class="is_active_product_menu" 
                                                    value="{{$product_menu_2['product_menu_id']}}"
                                                    name="show_article"
                                                    data-placement="top"
                                                    data-toggle="tooltip">
                                                </td>
                                                <td align="center">
                                                    <input 
                                                    type="checkbox" 
                                                    {{$product_menu_2->hot == 1 ? "checked" : ""}}
                                                    id="hot_{{$product_menu_2['category_id']}}"
                                                    class="hot_product_menu"
                                                    value="{{$product_menu_2['product_menu_id']}}"
                                                    name="impressed_article"
                                                    data-placement="top"
                                                    data-toggle="tooltip">
                                                </td>
                                                @if($product_menu_2['images'] == 'no')
                                                    <td align="center">
                                                        <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                                    </td>
                                                @else 
                                                    <td align="center">
                                                        <img class="popover-5" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                                        <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                            <div class="arrow"></div>
                                                            <h3 class="popover-title">Sản phẩm</h3>
                                                            <div class="popover-content"><img src="{{asset('upload/product/'.$product_menu_2['images'])}}"></div>
                                                        </div>
                                                        <script>
                                                            var image = '<img src="{{asset('upload/product/'.$product_menu_2['images'])}}">';
                                                            $('.popover-5').popover({
                                                                placement: 'bottom',
                                                                content: image,
                                                                html: true
                                                            });
                                                        </script>
                                                    </td>
                                                @endif
                                                <td align="center">
                                                    <span style="width: 16px; height: 1px; display: inline-block;"></span> &nbsp;
                                                    <a href="{{URL::to('admin/product_menu_edit&id_edit='.$product_menu_2['product_menu_id'])}}">
                                                        <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                                    </a>
                                                    &nbsp;
                                                    <a class="confirmManager2" style="cursor: pointer;"  id="{{URL::to('admin/product_manager&id_del='.$product_menu_2['product_menu_id'])}}">
                                                        <img data-toggle="tooltip" data-placement="right" title="Xóa mục" src="images/delete.svg">
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    <a href="{{URL::to('admin/product_list&id_product_menu='.$product_menu_2['product_menu_id'])}}"><img data-toggle="tooltip" data-placement="top" title="Danh sách bài viết" src="images/view.svg"></a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>

        </div>
     @endsection