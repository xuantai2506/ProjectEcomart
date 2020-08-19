@extends('admin.master.master')
@section('content')
        <div id="page-wrapper" style="min-height: 423px;">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="rec-banner darkblue">
                        <div class="banner">
                            <img src="{{asset('admin/images/home/slbv.svg')}}" class="thongkeok">
                            <div class="cangiua">
                                <div class="col-xs-8 text-right">
                                    <p>Bài viết</p>
                                    <h3>15</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rec-banner blue">
                        <div class="banner">
                            <img src="{{asset('admin/images/home/sltv.svg')}}" class="thongkeok">
                            <div class="cangiua">
                                <div class="col-xs-8 text-right">
                                    <p>Số lượng thành viên</p>
                                    <h3>23</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rec-banner black">
                        <div class="banner">
                            <img src="{{asset('admin/images/home/nqtv.svg')}}" class="thongkeok">
                            <div class="cangiua">
                                <div class="col-xs-8 text-right">
                                    <p>Nhóm quản trị viên</p>
                                    <h3>3</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rec-banner green">
                        <div class="banner">
                            <img src="{{asset('admin/images/home/sltc.svg')}}" class="thongkeok">
                            <div class="cangiua">
                                <div class="col-xs-8 text-right">
                                    <p>Số lượt truy cập</p>
                                    <h3>{{$count_access}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading title_bieudo">
                            <div class="btn-group bootstrap-select sm-select show-tick">
                                <input id="month" type="hidden" value="{{$month}}" name="">
                                <?php 

                                    $expires = new \DateTime('NOW');

                                    $year = $expires->format('y');

                                    $monthStatic = ($month !== '') ? $month : $expires->format('y-m');

                                ?>
                                <select  width="250px"  id="monthStatistic" onchange="return onChangeForward()">
                                    <?php 

                                        for($i = 1 ; $i < 13 ; $i++){

                                     ?>
                                        @if($i >=10 )

                                        <option  
                                            <?php if($monthStatic == ($year.'-'.$i)) {echo 'selected';} else { echo "";} ?> 
                                            value="{{$year.'-'.$i}}">
                                            {{$i.'/20'.$year}}
                                        </option>

                                        @else

                                        <option 
                                            <?php if($monthStatic == ($year.'-0'.$i)) {echo 'selected';} else { echo "";} ?> 
                                            value="{{$year.'-0'.$i}}">
                                            {{"0".$i.'/20'.$year}}
                                        </option>

                                        @endif

                                    <?php 

                                        }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <link rel="stylesheet" type="text/css" href="{{asset('admin/js/highcharts/highslide.css')}}">
                            <div id="container" style="width:100%; height: 1000px; margin: 0 auto;" data-highcharts-chart="0">
                                <canvas id="myChart" width="100%">sss</canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="{{asset('admin/js/highcharts/highcharts.js')}}"></script>
            <script src="{{asset('admin/js/highcharts/modules/data.js')}}"></script>
            <script src="{{asset('admin/js/highcharts/modules/exporting.js')}}"></script>
            <!-- Additional files for the Highslide popup effect -->
            <script type="text/javascript" src="{{asset('admin/js/highcharts/highslide-full.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('admin/js/highcharts/highslide.config.js')}}" charset="utf-8"></script>
            <script type="text/javascript" src="{{asset('admin/js/highcharts/themes/tth-v2.js')}}" charset="utf-8"></script>

               <!--chartis chart-->

            <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js')}}"></script>
            <script src="{{asset('admin/js/dashboards/dashboard1.js')}}"></script>
            <script src="{{asset('admin/js/libs/chartist/dist/chartist.min.js')}}"></script>
            <script src="{{asset('admin/js/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
            <!-- /.row -->
            <script>
                function onChangeForward() {

                    var url = 'month=' + document.getElementById("monthStatistic").value;
                    return Forward(url);

                }

                function Forward(url){

                    window.location.href = '{{URL::to('admin/home')}}&'+url;

                }
            </script>
        </div>
       @endsection