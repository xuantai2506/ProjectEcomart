@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 536px;">
            <div class="row">
                <h2 class="title_sp">Cấu hình chung</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{URL::to('admin/home')}}">Trang chủ</a>
                    </li>
                    <li>
                        Cấu hình
                    </li>
                    <li>
                        Cấu hình chung
                    </li>
                </ol>
            </div>
            <script type="text/javascript">
                    function selectFileWithCKFinder( elementId ) {
                        CKFinder.popup( {
                            chooseFiles: true,
                            width: 800,
                            height: 600,
                            onInit: function( finder ) {
                                finder.on( 'files:choose', function( evt ) {
                                    var file = evt.data.files.first();
                                    var output = document.getElementById( elementId );
                                    output.value = file.getUrl();
                                } );

                                finder.on( 'file:choose:resizedImage', function( evt ) {
                                    var output = document.getElementById( elementId );
                                    output.value = evt.data.resizedUrl;
                                } );
                            }
                        } );
                    }

            </script>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default khoangcach">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form enctype="multipart/form-data"  method="post">

                                    @csrf

                                    <table class="table table-hover">
                                        <tbody>
                                            @foreach($getConstant as $getConstants)

                                            <input type="hidden" name="name_constant[]" value="{{$getConstants['constant']}}">

                                            <?php 
                                                if($getConstants['constant'] == 'error_page') {
                                            ?>
                                            <tr>
                                                <td width="220px" class="ver-top"><label>{{$getConstants['name']}}</label></td>
                                                <td>
                                                    <textarea name="value_constant[]" class="form-control form-control-line" id="content">
                                                        {!! Request::old('content', $getConstants['value']) !!}
                                                    </textarea>
                                                </td>
                                            </tr>
                                            <?php 
                                                }else if($getConstants['constant'] == 'file_logo' || $getConstants['constant'] == 'image_thumbnailUrl') { 
                                             ?>
                                             <tr>
                                                <td width="220px" class="ver-top"><label>{{$getConstants['name']}}</label></td>
                                                <td>
                                                    <div class="input-group ">
                                                        <input class="form-control" type="text" name="value_constant[]" id="_{{$getConstants['constant']}}" value="{{$getConstants['value']}}">
                                                        <div class="input-group-btn">
                                                            <button  class="btn btn-primary" type="button" 
                                                            name="{{$getConstants['constant']}}" 
                                                            onclick="selectFileWithCKFinder('_{{$getConstants->constant}}');">
                                                            <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Chọn tệp...
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                                }else  if($getConstants['constant'] == 'keywords'){
                                            ?>
                                              <tr>
                                                <td width="220px" class="ver-top"><label>{{$getConstants['name']}}</label></td>
                                                <td>
                                                        <input class="form-control" type="text" name="value_constant[]" data-role="tagsinput" value="{{$getConstants['value']}}" >
                                                </td>
                                            </tr>
                                            <?php 
                                                }else {
                                            ?>
                                            <tr>
                                                <td width="220px" class="ver-top"><label>{{$getConstants['name']}}</label></td>
                                                <td>
                                                    <input class="form-control" type="text" name="value_constant[]" value="{{$getConstants['value']}}">
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                            ?>
                                            @endforeach
                                            
                                            <tr>
                                                <td colspan="2" align="center" class="kc_button">
                                                    <button type="submit" name="update" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
                                                    <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                                    <a href="{{URL::to('admin/home')}}">
                                                        <button type="button" class="btn btn-form-info btn-form" onclick="">Thoát</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    CKEDITOR.replace('error_page', {
                        height: 70,
                        toolbar: [
                            ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
                            ['FontSize', 'TextColor', 'BGColor']
                        ]
                    });
                </script>
            </div>
        </div>
@endsection