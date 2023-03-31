<?php /*a:1:{s:46:"D:\phpstudy_pro\WWW\tp6\view\index\welcome.php";i:1606462044;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>师出网校管理后台登录</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css"/>
</head>
<body>
<div class="wrap-container welcome-container">
    <div class="row">
        <div class="welcome-left-container col-lg-9">
            <div class="data-show">
                <ul class="clearfix">
                    <li class="col-sm-12 col-md-4 col-xs-12">
                        <a href="javascript:;" class="clearfix">
                            <div class="icon-bg bg-org f-l">
                                <span class="iconfont">&#xe604;</span>
                            </div>
                            <div class="right-text-con">
                                <p class="name">当月总营业额</p>
                                <p><span class="color-org"><?php echo htmlentities($total_income); ?> 元</span>较上月<span class="iconfont" <?php if($total_flag>0){echo 'style="color:#5fb878"';}else{echo 'style="color:#ff5722"';}?>><?php if($total_flag>0){echo '&#xe628;';}else{echo '&#xe60f;';}?></span></p>
                            </div>
                        </a>
                    </li>
                    <li class="col-sm-12 col-md-4 col-xs-12">
                        <a href="javascript:;" class="clearfix">
                            <div class="icon-bg bg-blue f-l">
                                <span class="iconfont">&#xe602;</span>
                            </div>
                            <div class="right-text-con">
                                <p class="name">当日报名提交数</p>
                                <p><span class="color-blue"><?php echo htmlentities($apply_num); ?> 个</span>较昨日<span class="iconfont" <?php if($apply_flag>0){echo 'style="color:#5fb878"';}else{echo 'style="color:#ff5722"';}?>><?php if($apply_flag>0){echo '&#xe628;';}else{echo '&#xe60f;';}?></span></p>
                            </div>
                        </a>
                    </li>
                    <li class="col-sm-12 col-md-4 col-xs-12">
                        <a href="javascript:;" class="clearfix">
                            <div class="icon-bg bg-green f-l">
                                <span class="iconfont">&#xe605;</span>
                            </div>
                            <div class="right-text-con">
                                <p class="name">当月问题提交数</p>
                                <p><span class="color-green"><?php echo htmlentities($ask_num); ?> 个</span>较上月<span class="iconfont" <?php if($ask_flag>0){echo 'style="color:#5fb878"';}else{echo 'style="color:#ff5722"';}?>><?php if($ask_flag>0){echo '&#xe628;';}else{echo '&#xe60f;';}?></span></p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!--图表-->
            <div class="chart-panel panel panel-default">
                <div class="panel-body" id="chart" style="height: 376px;">
                </div>
            </div>
            <!--服务器信息-->
            <div class="server-panel panel panel-default">
                <div class="panel-header">服务器信息</div>
                <div class="panel-body clearfix">
                    <div class="col-md-2">
                        <p class="title">服务器环境</p>
                        <span class="info"><?php echo htmlentities($system['environment']); ?> (<?php echo htmlentities($system['win']); ?>) PHP/<?php echo htmlentities($system['php']); ?></span>
                    </div>
                    <div class="col-md-2">
                        <p class="title">服务器IP地址</p>
                        <span class="info"><?php echo htmlentities($system['ip']); ?>   </span>
                    </div>
                    <div class="col-md-2">
                        <p class="title">服务器域名</p>
                        <span class="info"><?php echo htmlentities($system['server']); ?> </span>
                    </div>
                    <div class="col-md-2">
                        <p class="title"> PHP版本</p>
                        <span class="info"><?php echo htmlentities($system['php']); ?></span>
                    </div>
                    <div class="col-md-2">
                        <p class="title">数据库信息</p>
                        <span class="info"><?php echo htmlentities($system['mysql_version']); ?> </span>
                    </div>
                    <div class="col-md-2">
                        <p class="title">服务器当前时间</p>
                        <span class="info"><?php echo date('Y-m-d H:i:s');?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome-edge col-lg-3">
            <!--最新留言-->
            <div class="panel panel-default comment-panel">
                <div class="panel-header">最新提交问题</div>
                <div class="panel-body">
                    <div class="commentbox">
                        <ul class="commentList">
                            <?php if(is_array($ask_lists) || $ask_lists instanceof \think\Collection || $ask_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $ask_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="item cl"> <a href="#"><i class="avatar size-L radius"><img alt="" src="http://v.shichuedu.com/UploadFiles/2019/106/2131983836136974.jpg"></i></a>
                                <div class="comment-main">
                                    <header class="comment-header">
                                        <div class="comment-meta">
                                            <time title="<?php echo htmlentities($vo['add_time']); ?>" datetime="<?php echo htmlentities($vo['add_time']); ?>"><?php echo htmlentities($vo['add_time']); ?></time>
                                        </div>
                                    </header>
                                    <div class="comment-body">
                                        <p><a href="#" style="font-weight: bolder;">【<?php echo htmlentities($vo['item0']); ?>】</a><?php echo htmlentities($vo['item1']); ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div id="pagesbox" style="text-align: center;padding-top: 5px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/lib/echarts/echarts.js"></script>
<script type="text/javascript">

    layui.use(['util','layer','jquery'], function(){
        var util = layui.util
            ,laydate = layui.laydate
            ,$ = layui.$
            ,layer = layui.layer;

        var layer 	= layui.layer;
        var $=layui.jquery;
        var dates = [<?php echo implode(',',$date_arr);?>];
        var school_name_arr = [<?php echo implode(',',$school_name_arr);?>];
        var income = '<?php echo $income_str; ?>';
        income = JSON.parse(income);

        //固定块
        util.fixbar({
            bar1: false
            ,bar2: true
            ,css: {right: 25, bottom: 25}
            ,bgcolor: '#393D49'
            ,click: function(type){
                if(type === 'bar1'){
                    layer.msg('暂无')
                } else if(type === 'bar2') {
                    layer.msg('此页面只针对师出网校网络部数据统计及工作需要设置，统计面授及网课销售情况，学生提问情况等。')
                }
            }
        });
        //图表
        var myChart;
        require.config({
            paths: {
                echarts: '../../static/admin/lib/echarts'
            }
        });
        require(
            [
                'echarts',
                'echarts/chart/bar',
                'echarts/chart/line',
                'echarts/chart/map'
            ],
            function (ec) {
                //--- 折柱 ---
                myChart = ec.init(document.getElementById('chart'));
                myChart.setOption(
                    {
                        title: {
                            text: "周营业额",
                            textStyle: {
                                color: "rgb(85, 85, 85)",
                                fontSize: 15,
                                fontStyle: "normal",
                                fontWeight: "bolder"
                            }
                        },
                        tooltip: {
                            trigger: "axis",
                            backgroundColor: 'rgba(0,0,0,0.5)',     // 提示背景颜色，默认为透明度为0.7的黑色
                        },

                        legend: {
                            data: school_name_arr,
                            selectedMode: false,
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                dataZoom:{
                                    show: false,
                                },
                                dataView: {
                                    show: false,
                                    readOnly: true
                                },
                                magicType: {
                                    show: true,
                                    type: ["line", "bar"]
                                },
                                restore: {
                                    show: false
                                },
                                saveAsImage: {
                                    show: false
                                },
                                mark: {
                                    show: false
                                }
                            }
                        },
                        calculable: false,
                        xAxis: [
                            {
                                type: "category",
                                boundaryGap: false,
                                data: dates
                            }
                        ],
                        yAxis: [
                            {
                                type: "value"
                            }
                        ],
                        grid: {
                            x2: 30,
                            x: 50
                        },
                        series: income
                    }
                );
            }
        );
        $(window).resize(function(){
            myChart.resize();
        })
    });
</script>
</body>
</html>
