<?php /*a:1:{s:50:"/www/wwwroot/wx.shichuedu.com/view/money/index.php";i:1623916981;}*/ ?>
<!DOCTYPE html>
<html class="iframe-h">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>师出网校管理后台登录</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
    <script type="text/javascript" src="http://zw.shichuedu.com/resources/static/home/js/jquery-1.7.1.min.js"></script>
</head>
<body>
<div class="wrap-container clearfix">
    <div class="column-content-detail">
        <form class="layui-form" action="/index.php/address/index" method="post" id="form">
            <div class="layui-form-item">
                <div class="layui-inline tool-btn">
                    <button class="layui-btn layui-btn-small layui-btn-normal money" data-url="/index.php/money/add"><i class="layui-icon">&#xe654;</i></button>
                    <!-- button class="layui-btn layui-btn-small layui-btn-shua shua" data-title='刷新'><i class="layui-icon">&#x1002;</i></button> -->
                </div>
            </div>
        </form>
        <div class="layui-form" id="table-list" style="overflow-y:auto;">
            <table class="layui-table" lay-even lay-skin="nob">
                <colgroup>
                    <!--<col width="50" class="hidden-xs">-->
                    <col width="110" class="hidden-xs">
                    <col width="110" class="hidden-xs">
                    <col width="400">
                    <col width="100">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <!--<th class="hidden-xs"><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>-->
                    <th class="hidden-xs">提交分校</th>
                    <th class="hidden-xs">结算对象</th>
                    <th>结算内容</th>
                    <th>结算金额</th>
                    <th>提交时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($money_list) || $money_list instanceof \think\Collection || $money_list instanceof \think\Paginator): $i = 0; $__LIST__ = $money_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td class="hidden-xs"><?php echo htmlentities($school_list[$vo['school_id']]); ?></td>
                    <td class="hidden-xs"><?php echo htmlentities($sale_list[$vo['sale_id']]); ?></td>
                    <td><?php echo htmlentities($vo['reason']); ?></td>
                    <td><?php echo htmlentities($vo['pay_amount']); ?></td>
                    <td><?php echo htmlentities($vo['add_time']); ?></td>
                    <td>
                        <div class="layui-inline">
                            <?php
                            if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']==1){
                                ?>
                                <button class="layui-btn layui-btn-small layui-btn-normal go-btn goBtn" data-id="1" data-url="/index.php/money/edit?id=<?php echo htmlentities($vo['id']); ?>"><i class="layui-icon">&#xe642;</i></button>
                            <?php }
                            
                            if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']==1){
                                ?>
                                <button class="layui-btn layui-btn-small layui-btn-danger delBtn leftBtn"  data-url="/index.php/money/delete?id=<?php echo htmlentities($vo['id']); ?>"><i class="layui-icon">&#xe640;</i></button>
                            <?php }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div class="page-wrap">
                <?php echo $page;?>
            </div>
        </div>
    </div>
</div>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
