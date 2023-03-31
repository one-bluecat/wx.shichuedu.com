<?php /*a:1:{s:44:"D:\web\wx.shichuedu.com\view\index\index.php";i:1606832062;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>师出网校教务管理</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css"/>
</head>
<body>
<div class="main-layout" id='main-layout'>
    <!--侧边栏-->
    <div class="main-layout-side">
        <div class="m-logo">
        </div>
        <ul class="layui-nav layui-nav-tree" lay-filter="leftNav">
            <li class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;"><i class="iconfont">&#xe607;</i>报名管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" data-url="/index.php/apply/index" data-id='1' data-text="报名信息"><span class="l-line"></span>报名信息（<?php if($apply_num>0){echo '+'.$apply_num;}else{echo '0';}?>）</a></dd>
                    <dd><a href="javascript:;" data-url="/index.php/address/index" data-id='2' data-text="单独邮寄"><span class="l-line"></span>单独邮寄（<?php if($address_num>0){echo '+'.$address_num;}else{echo '0';}?>）</a></dd>
					<dd><a href="javascript:;" data-url="/index.php/refund/index" data-id='3' data-text="退费登记"><span class="l-line"></span>退费登记（<?php if($refund_num>0){echo '+'.$refund_num;}else{echo '0';}?>）</a></dd>
                    <dd><a href="javascript:;" data-url="/index.php/open/index" data-id='4' data-text="开课登记"><span class="l-line"></span>开课登记（<?php if($open_num>0){echo '+'.$open_num;}else{echo '0';}?>）</a></dd>
                    <?php
            if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']!=3){
                ?>
					<dd><a href="javascript:;" data-url="/index.php/money/index" data-id='5' data-text="营业额"><span class="l-line"></span>营业额登记<!-- （<?php if($money_num>0){echo '+'.$money_num;}else{echo '0';}?>） --></a></dd>
					<?php }
            ?>
                </dl>
            </li>
            <?php
            if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']!=3){
                ?>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="iconfont">&#xe608;</i>提问管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="/index.php/ask/index" data-id='6' data-text="提问信息"><span class="l-line"></span>提问信息（<?php if($ask_num>0){echo '+'.$ask_num;}else{echo '0';}?>）</a></dd>
                    </dl>
                </li>
            <?php }
            ?>

            <li class="layui-nav-item">
                <a href="javascript:;" data-url="/index.php/admin/index" data-id='7' data-text="个人信息"><i class="iconfont">&#xe606;</i>个人信息</a>
            </li>
        </ul>
    </div>
    <!--右侧内容-->
    <div class="main-layout-container">
        <!--头部-->
        <div class="main-layout-header">
            <div class="menu-btn" id="hideBtn">
                <a href="javascript:;">
                    <span class="iconfont">&#xe60e;</span>
                </a>
            </div>
            <ul class="layui-nav" lay-filter="rightNav">
                <li class="layui-nav-item" style="border-left: 0px;">
                    <div class="layui-inline">
                    <input class="layui-input" name="start_time" placeholder="提交开始时间" id="start_time" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php if(isset($_POST['start_time'])) echo $_POST['start_time'];?>">
                </div><span> - </span>
                <div class="layui-inline">
                    <input class="layui-input" name="end_time" placeholder="提交结束时间" id="end_time" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php if(isset($_POST['end_time'])) echo $_POST['end_time'];?>">
                </div>
                </li>
                <li class="layui-nav-item" style="border-left: 0px;"><a href="javascript:;" onclick="exportExcel();"><i class="iconfont">&#xe639;</i></li>
                <li class="layui-nav-item">
                    <a href="javascript:;" data-url="/index.php/admin/index" data-id='7' data-text="个人信息"><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['school_name'];}?></a>
                </li>
                <li class="layui-nav-item"><a href="javascript:;" onclick="window.location.href='/index.php/admin/login_out'">退出</a></li>
            </ul>
        </div>
        <!--主体内容-->
        <div class="main-layout-body">
            <!--tab 切换-->
            <div class="layui-tab layui-tab-brief main-layout-tab" lay-filter="tab" lay-allowclose="true">
                <ul class="layui-tab-title">
                    <li class="layui-this welcome">后台主页</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show" style="background: #f5f5f5;">
                        <!--1-->
                        <iframe src="<?php $_SERVER['SERVER_NAME']?>/index.php/index/welcome" width="100%" height="100%" name="iframe" scrolling="auto" class="iframe" framborder="0">
                        </iframe>
                        <!--1end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--遮罩-->
    <div class="main-mask">
    </div>
</div>
<script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
<script type="text/javascript">
    var scope={link:'./welcome.html'}
    function exportExcel(){
        var _href = '/index.php/index/export?start_time='+$('#start_time').val()+'&end_time='+$('#end_time').val();
        window.location.href=_href;
    }
</script>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/main.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>