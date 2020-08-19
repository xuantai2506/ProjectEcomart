@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 475px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Bài Viết</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('')}}">Trang chủ</a>
                    </li>
                    <li>
                        Quản lý nội dung
                    </li>
                    <li>
                        Bài viết
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
                                    @foreach($category_article as $categories_article)
                                    <tr class="category">
                                        <td>{{$categories_article['name']}}</td>
                                        <td>&nbsp;</td>
                                        <td align="right">
                                            <select name="sortcat5" class="form-control select-manager sort_category" id="{{$categories_article['category_id']}}" style="width:90%; font-weight:bold; color: #1d92af;">
                                                @for($sort = 1 ; $sort <= $sort_category ; $sort++)
                                                <option value="{{$sort}}" <?php echo ($sort == $categories_article['sort']) ? 'selected':'' ?>>
                                                {{$sort}}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td align="center">
                                            <input 
                                            type="checkbox" 
                                            {{$categories_article->is_active == 1 ? "checked" : ""}}
                                            id="show_{{$categories_article['category_id']}}"
                                            class="show_category" 
                                            value="{{$categories_article['category_id']}}"
                                            data-placement="top"
                                            data-toggle="tooltip"
                                            name="show_article">
                                        </td>
                                        <td align="center">
                                            <input 
                                            {{$categories_article->hot == 1 ? "checked" : ""}}
                                            id="hot_{{$categories_article['category_id']}}"
                                            type="checkbox" 
                                            class="hot_category"
                                            value="{{$categories_article['category_id']}}"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            name="impressed_article">
                                        </td>
                                        @if($categories_article['images'] == 'no')
                                        <td align="center">
                                            <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                        </td>
                                        @else 
                                        <td align="center">
                                            <img class="popover-3" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                            <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                <div class="arrow"></div>
                                                <h3 class="popover-title">Sản phẩm</h3>
                                                <div class="popover-content"><img src="{{asset('upload/article/'.$categories_article['images'])}}"></div>
                                            </div>
                                            <script>
                                                var image = '<img src="{{asset('upload/article/'.$categories_article['images'])}}">';
                                                $('.popover-3').popover({
                                                    placement: 'bottom',
                                                    content: image,
                                                    html: true
                                                });
                                            </script>
                                        </td>
                                        @endif
                                        <td align="center ">
                                            <a href="{{URL::to('admin/article_menu_add&id_cat='.$categories_article['category_id'])}}">
                                                <img data-toggle="tooltip" data-placement="left" title="Thêm mục" class="add_muc" src="images/plus.svg">
                                            </a>
                                            &nbsp;
                                            <a href="{{URL::to('admin/category_edit&id_edit='.$categories_article['category_id'])}}">
                                                <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                            </a>
                                            &nbsp;
                                            <span style="width: 16px; height: 1px; display: inline-block;"></span>
                                        </td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <!-- nhanh 1 -->
                                    @foreach($article_menu as $article_menus)
                                        <?php $sort_1 = 0; ?>
                                        @if($categories_article['category_id'] == $article_menus['category_id'] && $article_menus['parent'] == 0)
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td style="padding: 0 0 0 0px;"><img src="images/node.png">{{$article_menus['name']}}</td>
                                            <td align="right">
                                                
                                                <select onchange="" name="sort_1" class="form-control select-manager sort_article" id="{{$article_menus['article_menu_id']}}" style="width:80%;">
                                                    @foreach($sort_article as $sort)
                                                        @if($sort['category_id'] == $article_menus['category_id'] && $sort['parent'] == 0  )
                                                        <?php  $sort_1++; ?>
                                                        <option value="{{$sort_1}}" <?php echo ($sort_1 == $article_menus['sort'] ? 'selected' : '') ?> >{{$sort_1}}</option> 
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td align="center">
                                                <input 
                                                type="checkbox" 
                                                {{$article_menus->is_active == 1 ? "checked" : ""}}
                                                id="show_{{$article_menus['article_menu_id']}}"
                                                value="{{$article_menus['article_menu_id']}}"
                                                class="show" 
                                                data-placement="top"
                                                data-toggle="tooltip"
                                                name="show_article">
                                            </td>
                                            <td align="center ">
                                                <input 
                                                type="checkbox" 
                                                {{$article_menus->hot == 1 ? "checked" : ""}}
                                                id="hot_{{$article_menus['article_menu_id']}}"
                                                value="{{$article_menus['article_menu_id']}}" 
                                                class="hot"
                                                data-placement="top"
                                                data-toggle="tooltip"
                                                name="hot_article">
                                            </td>
                                            @if($article_menus['images'] == 'no')
                                                <td align="center">
                                                    <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                                </td>
                                            @else 
                                                <td align="center">
                                                    <img class="popover-4" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                                    <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                        <div class="arrow"></div>
                                                        <h3 class="popover-title">Sản phẩm</h3>
                                                        <div class="popover-content"><img src="{{asset('upload/article/'.$article_menus['images'])}}"></div>
                                                    </div>
                                                    <script>
                                                        var image = '<img src="{{asset('upload/article/'.$article_menus['images'])}}">';
                                                        $('.popover-4').popover({
                                                            placement: 'bottom',
                                                            content: image,
                                                            html: true
                                                        });
                                                    </script>
                                                </td>
                                            @endif

                                            <td align="center ">
                                                <a href="{{URL::to('admin/article_menu_add&id_cat='.$categories_article['category_id']).'&id_menu_art='.$article_menus['article_menu_id']}}">   <img data-toggle="tooltip" data-placement="left" title="Thêm mục" class="add_muc" src="images/plus.svg">
                                                </a>
                                                &nbsp;
                                                <a href="{{URL::to('admin/article_menu_edit&id_cat='.$categories_article['category_id'].'&id_edit='.$article_menus['article_menu_id'])}}">
                                                    <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                                </a>
                                                &nbsp;
                                                <a class="confirmManager2" id="{{URL::to('admin/article_manager&id_cat='.$categories_article['category_id'].'&del=').$article_menus['article_menu_id']}}" style="cursor: pointer;" id="">
                                                    <img data-toggle="tooltip" data-placement="right" title="Xóa mục" src="images/delete.svg">
                                                </a>
                                            </td>

                                            <td align="center">
                                                <a href="{{URL::to('admin/article_list&id_menu_art='.$article_menus['article_menu_id'])}}">
                                                    <img data-toggle="tooltip" data-placement="top" title="Danh sách bài viết" src="images/view.svg">
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- nhanh 2 -->
                                        @foreach($article_menu as $article_menus_2)
                                            @if($article_menus['article_menu_id'] == $article_menus_2['parent'])
                                            <?php $sort_2 = 0; ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td style="padding: 0 0 0 30px;"><img src="images/node.png">
                                                    {{$article_menus_2['name']}}
                                                    <span class="bold-red">(5)</span>
                                                </td>
                                                <td align="right">
                                                    <select onchange="" name="sort_1" class="form-control select-manager sort_article" id="{{$article_menus_2['article_menu_id']}}" style="width:80%;">
                                                        @foreach($sort_article as $sort)
                                                            @if($sort['category_id'] == $article_menus_2['category_id'] && $sort['parent'] != 0 && $sort['parent'] == $article_menus_2['parent'])
                                                            <?php  $sort_2++; ?>
                                                            <option value="{{$sort_2}}" <?php echo ($sort_2 == $article_menus_2['sort'] ? 'selected' : '') ?> >{{$sort_2}}</option> 
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td align="center">
                                                    <input 
                                                    type="checkbox" 
                                                    {{$article_menus_2->is_active == 1 ? "checked" : ""}}
                                                    id="show_{{$article_menus_2['article_menu_id']}}"
                                                    value="{{$article_menus_2['article_menu_id']}}"
                                                    class="show"
                                                    data-placement="top"
                                                    data-toggle="tooltip"
                                                    name="show_article">
                                                </td>
                                                <td align="center">
                                                    <input 
                                                    type="checkbox" 
                                                    {{$article_menus_2->hot == 1 ? "checked" : ""}}
                                                    id="show_{{$article_menus_2['article_menu_id']}}"
                                                    value="{{$article_menus_2['article_menu_id']}}" 
                                                    class="hot"
                                                    data-placement="top"
                                                    data-toggle="tooltip"
                                                    name="hot_article">
                                                </td>
                                                @if($article_menus_2['images'] == 'no')
                                                    <td align="center">
                                                        <img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/no_image.svg"> 
                                                    </td>
                                                @else 
                                                    <td align="center">
                                                        <img class="popover-5" class="btn-popover" title="" src="images/has_image.svg" data-original-title="Sản phẩm" aria-describedby="">
                                                        <div class="popover fade bottom in" role="tooltip" id="" style="display: none; top: 99.2969px; left: 764.5px;">
                                                            <div class="arrow"></div>
                                                            <h3 class="popover-title">Sản phẩm</h3>
                                                            <div class="popover-content"><img src="{{asset('upload/article/'.$article_menus_2['images'])}}"></div>
                                                        </div>
                                                        <script>
                                                            var image = '<img src="{{asset('upload/article/'.$article_menus_2['images'])}}">';
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
                                                    <a href="{{URL::to('admin/article_menu_edit&id_cat='.$categories_article['category_id'].'&id_edit='.$article_menus_2['article_menu_id'])}}">
                                                        <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                                    </a>
                                                    &nbsp;
                                                    <a class="confirmManager2" style="cursor: pointer;"  id="{{URL::to('admin/article_manager&id_cat='.$categories_article['category_id'].'&del=').$article_menus_2['article_menu_id']}}">
                                                        <img data-toggle="tooltip" data-placement="right" title="Xóa mục" src="images/delete.svg">
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    <a href="{{URL::to('admin/article_list&id_menu_art='.$article_menus_2['article_menu_id'])}}"><img data-toggle="tooltip" data-placement="top" title="Danh sách bài viết" src="images/view.svg"></a>
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