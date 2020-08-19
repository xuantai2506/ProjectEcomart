@extends('admin.master.master')
@section('content')
        <!-- format data -->
        <?php 
                function size_format($bytes="") {

                    $retval = "";

                    if ($bytes >=  pow(1024,5)) {

                        $retval = round($bytes / pow(1024,5) * 100 ) / 100 . " PB";

                    } else if ($bytes >=  pow(1024,4)) {

                        $retval = round($bytes / pow(1024,4) * 100 ) / 100 . " TB";

                    } else if ($bytes >=  pow(1024,3)) {

                        $retval = round($bytes / pow(1024,3) * 100 ) / 100 . " GB";

                    } else if ($bytes >=  pow(1024,2)) {

                        $retval = round($bytes / pow(1024,2) * 100 ) / 100 . " MB";

                    } else if ($bytes  >= 1024) {

                        $retval = round($bytes / 1024 * 100 ) / 100 . " KB";

                    } else {

                        $retval = $bytes . " bytes";

                    }

                return $retval;

            }
        ?>
        <div id="page-wrapper" style="min-height: 536px;">

            <!-- Menu path -->
            <div class="row">
                <h2 class="title_sp">Sao lưu cơ sở dữ liệu</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}"> Trang chủ</a>
                    </li>
                    <li>
                        Cơ sở dữ liệu (CSDL)
                    </li>
                    <li>
                        Sao lưu dữ liệu
                    </li>
                </ol>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel-no-border khoangcach">

                        <a href="{{ URL::to('admin/backup-data/create') }}">
                            <input class="btn btn-primary butne" type="button"  name="backupdatabase" value="Tiến hành sao lưu">
                        </a>

                        <div class="table-responsive" id="list_file_backup">
                            <table class="table table-manager table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên file</th>
                                        <th>Dung lương</th>
                                        <th>Thời gian</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <?php $stt = 0 ?>
                                <tbody>
                                    @foreach($backups as $backup)
                                    <tr>
                                        <td align="center">{{++$stt}}</td>
                                        <td align="center">{{$backup['file_name']}}</td>
                                        <td align="center">{{size_format($backup['file_size'])}}</td>
                                        <td align="center">{{$backup['last_modified']}}</td>
                                        <td align="center">
                                            <a data-toggle="tooltip" data-placement="left" title="Tải xuống" href="{{URL::to('admin/backup-data/download/'.$backup['file_name'])}}"><img src="images/download.png"></a>&nbsp;&nbsp;
                                            <a data-toggle="tooltip" data-placement="right" title="Xóa file" class="confirmManager3" style="cursor: pointer;" id="{{URL::to('admin/backup-data/delete/'.$backup['file_name'])}}"><img src="images/delete.svg"></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                $(".confirmManager3").click(function() {
                                    var element = $(this);
                                    var action = element.attr("id");
                                    confirm("File sao lưu cơ sở dữ liệu này sẽ được xóa và không thể phục hồi lạiss nó.\nBạn có muốn thực hiện không?", function() {
                                        if (this.data == true) window.location.href = action;
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default panel-no-border khoangcach">
                        <div class="table-responsive">
                            <table class="table table-manager table-striped table-bordered table-hover">
                                <caption class="title_in"><i class="fa fa-database fa-fw"></i> Thông tin chung về CSDL</caption>
                                <tbody>
                                    <tr>
                                        <td>Máy chủ MySQL</td>
                                        <td>Localhost via UNIX socket</td>
                                    </tr>
                                    <tr>
                                        <td>Phiên bản máy chủ MySQL</td>
                                        <td>5.5.5-10.2.14-MariaDB</td>
                                    </tr>
                                    <tr>
                                        <td>Phiên bản giao thức MySQL</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>Tên máy chủ MySQL</td>
                                        <td>{{$database_config['host']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tên CSDL</td>
                                        <td>{{$database_config['driver']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tài khoản truy cập CSDL</td>
                                        <td>{{$database_config['username']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Số Table trong CSDL</td>
                                        <td>{{count($tables)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bảng mã CSDL</td>
                                        <td>{{$database_config['charset']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mã so sánh CSDL</td>
                                        <td>{{$database_config['collation']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Múi giờ của CSDL</td>
                                        <td>+07</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default panel-no-border khoangcach">
                        <div class="table-responsive">
                            <table class="table table-manager table-striped table-bordered table-hover">
                                <caption class="title_in"><i class="fa fa-table fa-fw"></i> Các Table thuộc CSDL “storecn_store”</caption>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Data length</th>
                                        <th>Max data length</th>
                                        <th>Rows</th>
                                        <th>Collation</th>
                                        <th>Engine</th>
                                        <th>Auto increment</th>
                                        <th>Create time</th>
                                        <th>Update time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0 ?>
                                    @foreach($tables as $table)
                                    <tr>
                                        <td align="center">{{++$stt}}</td>
                                        <td>{{$table->Name}}</td>
                                        <td align="right">{{size_format($table->Data_length)}}</td>
                                        <td align="right">{{size_format($table->Max_data_length)}}</td>
                                        <td align="right">{{$table->Rows}}</td>
                                        <td align="center">{{$table->Collation}}</td>
                                        <td align="center">{{$table->Engine}}</td>
                                        <td align="right">{{$table->Auto_increment}}</td>
                                        <td align="center">{{$table->Create_time}}</td>
                                        <td align="center">{{$table->Update_time}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>
@endsection