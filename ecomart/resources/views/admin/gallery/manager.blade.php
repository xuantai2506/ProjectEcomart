@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 475px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Hình ảnh</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        Hình ảnh
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
                                            <select name="sortcat5" class="form-control select-manager sort_category" id="{{$categories['category_id']}}" style="width:90%; font-weight:bold; color: #1d92af;">
                                                @for($sort = 1 ; $sort <= $sort_category ; $sort++)
                                                <option value="{{$sort}}" <?php echo ($sort == $categories['sort']) ? 'selected':'' ?>>
                                                {{$sort}}</option>
                                                @endfor
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
                                                <div class="popover-content"><img src="{{asset('upload/article/'.$categories['images'])}}"></div>
                                            </div>
                                            <script>
                                                var image = '<img src="{{asset('upload/gallery/'.$categories['images'])}}">';
                                                $('.popover-3').popover({
                                                    placement: 'bottom',
                                                    content: image,
                                                    html: true
                                                });
                                            </script>
                                        </td>
                                        @endif
                                        <td align="center ">
                                            <a href="{{URL::to('admin/gallery_menu_add&id_cat='.$categories['category_id'])}}">
                                                <img data-toggle="tooltip" data-placement="left" title="Thêm mục" class="add_muc" src="images/plus.svg">
                                            </a>
                                            &nbsp;
                                            <a href="{{URL::to('admin/category_gallery_edit&id_edit='.$categories['category_id'])}}">
                                                <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                            </a>
                                            &nbsp;
                                            <span style="width: 16px; height: 1px; display: inline-block;"></span>
                                        </td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <!-- nhanh 1 -->
                                    @foreach($gallery_menu as $gallery_menus)
                                        <?php $sort_1 = 0; ?>
                                        @if($gallery_menus['category_id'] == $categories['category_id'])
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td style="padding: 0 0 0 0px;"><img src="images/node.png">{{$gallery_menus['name']}}</td>
                                            <td align="right">
                                                <select onchange="" name="sort_1" class="form-control select-manager sort_gallery" id="{{$gallery_menus['gallery_menu_id']}}" style="width:80%;">
                                                    @foreach($sort_gallery as $sort)
                                                    @if($sort['category_id'] == $gallery_menus['category_id'] && $sort['parent'] == 0 )
                                                    <?php  $sort_1++; ?>
                                                    <option value="{{$sort_1}}" <?php echo ($sort_1 == $gallery_menus['sort'] ? 'selected' : '') ?> >{{$sort_1}}</option> 
                                                    @endif
                                                    @endforeach 
                                                </select>
                                            </td>
                                            <td align="center">
                                                <input 
                                                type="checkbox" 
                                                {{$gallery_menus->is_active == 1 ? "checked" : ""}}
                                                id="show_{{$gallery_menus['gallery_menu_id']}}" 
                                                class="show_gallery_menu" 
                                                value="{{$gallery_menus['gallery_menu_id']}}"
                                                name="show_article"
                                                data-placement="top"
                                                data-toggle="tooltip">
                                            </td>
                                            <td align="center ">
                                                <input 
                                                type="checkbox" 
                                                {{$gallery_menus->hot == 1 ? "checked" : ""}}
                                                id="hot_{{$gallery_menus['gallery_menu_id']}}"
                                                class="hot_gallery_menu"
                                                value="{{$gallery_menus['gallery_menu_id']}}"
                                                name="impressed_article"
                                                data-placement="top"
                                                data-toggle="tooltip">
                                            </td>
                                            @if($gallery_menus['images'] == 'no')
                                                <td align="center">
                                                    <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                                </td>
                                            @else 
                                                <td align="center">
                                                    <img class="popover-4" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                                    <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                        <div class="arrow"></div>
                                                        <h3 class="popover-title">Sản phẩm</h3>
                                                        <div class="popover-content"><img src="{{asset('upload/gallery/'.$gallery_menus['images'])}}"></div>
                                                    </div>
                                                    <script>
                                                        var image = '<img src="{{asset('upload/gallery/'.$gallery_menus['images'])}}">';
                                                        $('.popover-4').popover({
                                                            placement: 'bottom',
                                                            content: image,
                                                            html: true
                                                        });
                                                    </script>
                                                </td>
                                            @endif

                                            <td align="center ">
                                                <!-- <a href="{{URL::to('admin/gallery_menu_add&id_cat='.$gallery_menus['category_id'].'&id_menu_gal='.$gallery_menus['gallery_menu_id'])}}">   <img data-toggle="tooltip" data-placement="left" title="Thêm mục" class="add_muc" src="images/plus.svg">
                                                </a> -->
                                                &nbsp;
                                                <a href="{{URL::to('admin/gallery_menu_edit&id_edit='.$gallery_menus['gallery_menu_id'])}}">
                                                    <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                                </a>
                                                &nbsp;
                                                <!-- <a class="confirmManager2" id="{{URL::to('admin/gallery_manager&id_del='.$gallery_menus['gallery_menu_id'])}}" style="cursor: pointer;" id="">
                                                    <img data-toggle="tooltip" data-placement="right" title="Xóa mục" src="images/delete.svg">
                                                </a> -->
                                            </td>

                                            <td align="center">
                                                <a href="{{URL::to('admin/gallery_list&id_menu_gal='.$gallery_menus['gallery_menu_id'].'&id_product=0')}}">
                                                    <img data-toggle="tooltip" data-placement="top" title="Danh sách bài viết" src="images/view.svg">
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- nhanh 2 -->
                                        @foreach($gallery_menu as $gallery_menus_2)
                                            @if($gallery_menus_2['parent'] == $gallery_menus['gallery_menu_id'])
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td style="padding: 0 0 0 30px;"><img src="images/node.png">
                                                    {{$gallery_menus_2['name']}}
                                                    <span class="bold-red">(5)</span>
                                                </td>
                                                <td align="right">
                                                    <select onchange="" name="sort_1" class="form-control select-manager" style="width:80%;">
                                                        @foreach($sort_gallery as $sort)
                                                        @if($sort['category_id'] == $gallery_menus_2['category_id']&& $sort['parent'] == $gallery_menus_2['parent'])
                                                        <option value="{{$sort['sort']}}" <?php echo ($sort['sort'] == $gallery_menus_2['sort'] ? 'selected' : '') ?> >{{$sort['sort']}}</option> 
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td align="center">
                                                    <input 
                                                    type="checkbox" 
                                                    {{$gallery_menus_2->is_active == 1 ? "checked" : ""}}
                                                    id="show_{{$gallery_menus_2['gallery_menu_id']}}" 
                                                    class="show_gallery_menu" 
                                                    value="{{$gallery_menus_2['gallery_menu_id']}}"
                                                    name="show_article"
                                                    data-placement="top"
                                                    data-toggle="tooltip">
                                                </td>
                                                <td align="center">
                                                    <input 
                                                    type="checkbox" 
                                                    {{$gallery_menus_2->hot == 1 ? "checked" : ""}}
                                                    id="hot_{{$gallery_menus_2['gallery_menu_id']}}"
                                                    class="hot_gallery_menu"
                                                    value="{{$gallery_menus_2['gallery_menu_id']}}"
                                                    name="impressed_article"
                                                    data-placement="top"
                                                    data-toggle="tooltip">
                                                </td>
                                                @if($gallery_menus_2['images'] == 'no')
                                                    <td align="center">
                                                        <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                                    </td>
                                                @else 
                                                    <td align="center">
                                                        <img class="popover-5" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                                        <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                            <div class="arrow"></div>
                                                            <h3 class="popover-title">Sản phẩm</h3>
                                                            <div class="popover-content"><img src="{{asset('upload/article/'.$gallery_menus_2['images'])}}"></div>
                                                        </div>
                                                        <script>
                                                            var image = '<img src="{{asset('upload/article/'.$gallery_menus_2['images'])}}">';
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
                                                    <a href="{{URL::to('admin/gallery_menu_edit&id_edit='.$gallery_menus_2['gallery_menu_id'])}}">
                                                        <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                                    </a>
                                                    &nbsp;
                                                    <a class="confirmManager2" style="cursor: pointer;"  id="{{URL::to('admin/gallery_manager&id_del='.$gallery_menus_2['gallery_menu_id'])}}">
                                                        <img data-toggle="tooltip" data-placement="right" title="Xóa mục" src="images/delete.svg">
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    <a href="{{URL::to('admin/gallery_list&id_menu_gal='.$gallery_menus_2['gallery_menu_id'])}}"><img data-toggle="tooltip" data-placement="top" title="Danh sách bài viết" src="images/view.svg"></a>
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