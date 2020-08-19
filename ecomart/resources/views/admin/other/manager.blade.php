@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 475px;">
            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Danh Mục Khác</h2>
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
                                        <th>Chức năng</th>
                                        <th>Nội dung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <!-- nhánh gốc -->
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

                                        <td align="center ">
                                            <a href="{{URL::to('admin/others_menu_add&id_cat='.$categories['category_id'])}}">
                                                <img data-toggle="tooltip" data-placement="left" title="Thêm mục" class="add_muc" src="images/plus.svg">
                                            </a>
                                            &nbsp;
                                            <a href="{{URL::to('admin/category_other_edit&id_edit='.$categories['category_id'])}}">
                                                <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                            </a>
                                            &nbsp;
                                            <span style="width: 16px; height: 1px; display: inline-block;"></span>
                                        </td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <!-- nhansh 1 -->
                                    @foreach($other_menu as $other_menus)
                                        <?php $sort_1 = 0; ?>
                                        @if($other_menus['category_id'] == $categories['category_id'] && $other_menus['parent'] == 0)
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td style="padding: 0 0 0 0px;"><img src="images/node.png">{{$other_menus['name']}}</td>
                                            <td align="right">
                                                <select onchange="" name="sort_1" class="form-control select-manager sort_others" id="{{$other_menus['others_menu_id']}}" style="width:80%;">
                                                    @foreach($sort_other as $sort)
                                                        @if($sort['category_id'] == $other_menus['category_id'] && $sort['parent'] == 0  )
                                                        <?php  $sort_1++; ?>
                                                        <option value="{{$sort_1}}" <?php echo ($sort_1 == $other_menus['sort'] ? 'selected' : '') ?> >{{$sort_1}}</option> 
                                                        @endif
                                                    @endforeach    
                                                </select>
                                            </td>
                                            <td align="center">
                                                <input 
                                                type="checkbox" 
                                                {{$other_menus->is_active == 1 ? "checked" : ""}}
                                                id="show_{{$other_menus['others_menu_id']}}" 
                                                class="is_active_others_menu" 
                                                value="{{$other_menus['others_menu_id']}}"
                                                name="show_article"
                                                data-placement="top"
                                                data-toggle="tooltip">
                                            </td>
                                            <td align="center ">
                                                <input 
                                                type="checkbox" 
                                                {{$other_menus->hot == 1 ? "checked" : ""}}
                                                id="hot_{{$other_menus['others_menu_id']}}"
                                                class="hot_others_menu"
                                                value="{{$other_menus['others_menu_id']}}"
                                                name="impressed_article"
                                                data-placement="top"
                                                data-toggle="tooltip">
                                            </td>

                                            <td align="center ">
                                                <!-- <a href="{{URL::to('admin/other_menu_edit&id_edit='.$other_menus['others_menu_id'])}}">   <img data-toggle="tooltip" data-placement="left" title="Thêm mục" class="add_muc" src="images/plus.svg">
                                                </a>
                                                &nbsp; -->
                                                <a href="{{URL::to('admin/other_menu_edit&id_edit='.$other_menus['others_menu_id'])}}">
                                                    <img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/setting.svg">
                                                </a>
                                                &nbsp;
                                                <a class="confirmManager2" id="{{URL::to('admin/others_manager&id_del='.$other_menus['others_menu_id'])}}" style="cursor: pointer;" >
                                                    <img data-toggle="tooltip" data-placement="right" title="Xóa mục" src="images/delete.svg">
                                                </a>
                                            </td>

                                            <td align="center">
                                                <a href="{{URL::to('admin/others_list&id_others_menu='.$other_menus['others_menu_id'])}}">
                                                    <img data-toggle="tooltip" data-placement="top" title="Danh sách bài viết" src="images/view.svg">
                                                </a>
                                            </td>
                                        </tr>
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