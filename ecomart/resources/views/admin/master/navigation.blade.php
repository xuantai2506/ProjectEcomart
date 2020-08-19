<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span><i class="fa fa-bars fa-2x"></i>
        </button>
        <a class="navbar-brand" target="_blank" href="">
            <img src="{{asset('admin/images/logo.svg')}}" height="40px" alt="Logo Jetart Admin Panel">
        </a>
    </div>
    <!-- /.navbar-header -->
    <!-- /.sidebar-collapse -->
    <div class="sidebar-minified js-toggle-minified">
        <a class="toggle-nav" href="#" data-toggle="tooltip" data-placement="right" title="Menu Mở rộng/Thu gọn">
            <img src="{{asset('admin/images/menu/list_menu.svg')}}">
        </a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown ngonngu">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Viet Nam<i class="fas fa-chevron-down"></i></a>
            <ul class="dropdown-menu">
                <div class="node-hv">&nbsp;</div>
                <li>
                    <a href="index.html">Enlish</a>
                </li>
                <li>
                    <a href="index.html">Viet Nam</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle toggle-user" data-toggle="dropdown" href="#">
                <label class="tth-user-admin">
                    <img src="{{asset('admin/images/user.svg')}}" title="Administrator">
                    Administrator<i class="fas fa-chevron-down"></i></label>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <div class="node-hv">&nbsp;</div>
                <li>
                    <a href="{{URL::to('admin/profile')}}"><img src="{{asset('admin/images/menu/avatar.svg')}}" class="info_u"> Thông tin cá nhân</a>
                </li>
                <li>
                    <a href="{{URL::to('admin/change-password')}}"><img src="{{asset('admin/images/menu/lock.svg')}}" class="info_u"> Đổi mật khẩu</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <img src="{{asset('admin/images/menu/logout.svg')}}" class="info_u"> 
                    Đăng xuất</a>
                </li>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="dash">
                    <h3>DASHBOARD</h3>
                </li>
                <li>
                    <a class="active" href="{{URL::to('admin/home')}}"><img src="{{asset('admin/images/menu/home.svg')}}" class="img_menu"> <span>Trang chủ</span></a>
                </li>
                <li>
                    <a href="#"><img src="{{asset('admin/images/menu/qtnd.svg')}}" class="img_menu"> <span>Quản lý nội dung</span><img class="arrow" src="{{asset('admin/images/right.svg')}}"></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="{{URL::to('admin/article_manager')}}"><span>Bài viết</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/gallery_manager')}}"><span>Hình ảnh</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/product_manager')}}"><span>Sản phẩm</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/others_manager')}}"><span>Dữ liệu khác</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/cart_manager')}}"><span>Giỏ hàng</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/agency_manager')}}"><span>Tuyển đại lý</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/email_manager')}}"><span>Đăng ký email</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/plus_manager')}}"> <span>Phần bổ sung</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><img src="{{asset('admin/images/menu/csdl.svg')}}" class="img_menu"> <span>Cơ sở dữ liệu</span><img class="arrow" src="{{asset('admin/images/right.svg')}}"></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="{{URL::to('admin/backup-data')}}"><span>Sao lưu dữ liệu</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/backup-config')}}"><span>Cấu hình sao lưu</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><img src="{{asset('admin/images/menu/ch.svg')}}" class="img_menu"> <span>Cấu hình</span><img class="arrow" src="{{asset('admin/images/right.svg')}}"></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="{{URL::to('admin/config-general')}}"> <span>Cấu hình chung</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/config-smtp')}}"><span>Cấu hình SMTP</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/config-time')}}"><span>Cấu hình thời gian</span></a>
                        </li>
                     <!--    <li>
                            <a href="{{URL::to('admin/config-network')}}"><span>Trình cắm bổ sung</span></a>
                        </li> -->
                        <li>
                            <a href="{{URL::to('admin/config-network')}}"><span>Mạng xã hội</span></a>
                        </li>
                       <!--  <li>
                            <a href="config-upload.html"><span>Cấu hình upload</span></a>
                        </li> -->
                    </ul>
                </li>
                <li>
                    <a href="#"><img src="{{asset('admin/images/menu/qtht.svg')}}" class="img_menu"> <span>Quản trị hệ thống</span><img class="arrow" src="{{asset('admin/images/right.svg')}}"></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="{{URL::to('admin/core-role')}}"><span>Nhóm quản trị('Phân quyền')</span></a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/core-user')}}"><span>Quản lý thành viên(*Phân quyền)</span></a>
                        </li>
                    </ul>
                </li>
              <!--   <li>
                    <a href="#"><img src="{{asset('admin/images/menu/ttht.svg')}}" class="img_menu"> <span>Thông tin hệ thống</span><img class="arrow" src="{{asset('admin/images/right.svg')}}"></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="sysinfo-site.html"><span>Cấu hình site</span></a>
                        </li>
                        <li>
                            <a href="sysinfo-php.html"><span>Cấu hình PHP</span></a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>