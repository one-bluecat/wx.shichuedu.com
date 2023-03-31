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
    <!--技术处理：17755464188-->
<div class="wrap-container clearfix">
    <div class="column-content-detail">
        <form class="layui-form" action="/index.php/address/index" method="post" id="form">
            <div class="layui-form-item">
                <div class="layui-inline tool-btn">
                    <button class="layui-btn layui-btn-small layui-btn-normal youji" data-url="/index.php/address/add"><i class="layui-icon">&#xe654;</i></button>
                    <button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn" data-url="/index.php/address/index?export=1"><i class="iconfont">&#xe639;</i></button>
                    <!-- <button class="layui-btn layui-btn-small layui-btn-shua shua" data-title='刷新'><i class="layui-icon">&#x1002;</i></button> -->
                </div>
                <div class="layui-inline">
                    <input type="text" name="student_phone" placeholder="请输入学生手机号" autocomplete="off" class="layui-input" value="<?php if(isset($_POST['student_phone'])) echo $_POST['student_phone'];?>">
                </div>
                <div class="layui-inline">
                    <select name="sale_id" lay-filter="sale_id" id="sale_id">
                        <option value="0">选择销售</option>
                        <?php
                        foreach($sale_list as $k=>$value){
                            ?><option value="{$k}" <?php if(isset($_POST['sale_id']) && $_POST['sale_id'] == $k){echo 'selected';}?>>{$value}</option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <select name="school_id" lay-filter="status">
                        <option value="0">选择分校</option>
                        <?php
                        foreach($school_list as $k=>$value){
                            ?><option value="{$k}" <?php if(isset($_POST['school_id']) && $_POST['school_id'] == $k){echo 'selected';}?>>{$value}</option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <input class="layui-input" name="start_time" placeholder="开始时间" id="LAY_demorange_s" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php if(isset($_POST['start_time'])) echo $_POST['start_time'];?>">
                </div>
                <div class="layui-inline">
                    <input class="layui-input" name="end_time" placeholder="结束时间" id="LAY_demorange_e" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php if(isset($_POST['end_time'])) echo $_POST['end_time'];?>">
                </div>
                <button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>
            </div>
        </form>
        <div class="layui-form" id="table-list" style="overflow-y:auto;">
            <table class="layui-table" lay-even lay-skin="nob">
                <colgroup>
                    <!--<col width="50" class="hidden-xs">-->
                    <col width="110" class="hidden-xs">
                    <col width="110" class="hidden-xs">
                    <col width="110" class="hidden-xs">
                    <col width="130">
                    <col width="300" class="hidden-xs">
                    <col width="200">
                    <col width="200">
                    <col width="100">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <!--<th class="hidden-xs"><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>-->
                    <th class="hidden-xs">分校</th>
                    <th class="hidden-xs">咨询</th>
                    <th class="hidden-xs">姓名</th>
                    <th>手机号</th>
                    <th class="hidden-xs">商品名称</th>
                    <th>邮寄原因</th>
                    <th>提交时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                {volist name="applys" id="vo"}
                <tr>
                    <!--<td class="hidden-xs"><input type="checkbox" name="id[]" lay-skin="primary" data-id="1" value="{$vo.id}"></td>-->
                    <td class="hidden-xs">{$school_list[$vo.school_id]}</td>
                    <td class="hidden-xs">{$sale_list[$vo.sale_id]}</td>
                    <td class="hidden-xs">{$vo.student_name}</td>
                    <td>{$vo.student_phone}</td>
                    <td class="hidden-xs">{$vo.goods}</td>
                    <td>{$vo.reason}</td>
                    <td>{$vo.add_time}</td>
                    <?php
                    $class='';
                    $name='';
                    if ($state=$vo["state"]=='1') {
                        $class='layui-btn layui-btn-mini layui-btn-warm table-list-status dingHBtn';
                        $name='已提交';
                    } else {
                        $class='layui-btn layui-btn-mini layui-btn-danger table-list-status dingHBtn';
                        $name='已确认';
                    }
                    ?>
                    <td><button class="<?php echo $class; ?>" data-status='{$vo.state}' data-id='{$vo.id}'><?php echo $name; ?></button></td>
                    <td>
                        <div class="layui-inline">
                            <?php
                            if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']==1){
                                ?>
                                <button class="layui-btn layui-btn-small layui-btn-normal go-btn goBtn" data-id="1" data-url="/index.php/address/edit?id={$vo.id}"><i class="layui-icon">&#xe642;</i></button>
                            <?php }
                            ?>
                            <button style="margin-left:0px;" class="layui-btn layui-btn-small layui-btn-shua go-btn layui-btn-youji  searchBtn" data-id="1" data-url="/index.php/address/view?id={$vo.id}"><i class="layui-icon">&#xe615;</i></button>
                            <?php
                            if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']==1){
                                ?>
                                <button class="layui-btn layui-btn-small layui-btn-danger delBtn leftBtn"  data-url="/index.php/address/delete?id={$vo.id}"><i class="layui-icon">&#xe640;</i></button>
                            <?php }
                            ?>
                        </div>
                    </td>
                </tr>
                {/volist}
                </tbody>
            </table>
            <div class="page-wrap">
                <?php echo $page;?>
            </div>
        </div>
    </div>
</div>
<!--技术处理：17755464188-->
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<?php
if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']==1){
?>
<script>
    layui.use(['form', 'jquery', 'layer', 'dialog'], function() {
        var $ = layui.jquery;
        //修改状态
        $('#table-list').on('click', '.table-list-status', function() {
            var _this = $(this);
            var status = _this.attr('data-status');
            if(status>1){
                status=1;
            }else{
                status=2;
            }
            var id = _this.attr('data-id');
            $.ajax({
                url:"{:url('index/address/stat')}",
                data:{id:id,status:status},
                type:'post',
                dataType:'json',
                async: false,
                success: function (res) {
                    if(status == 2){
                        _this.removeClass('layui-btn-warm').addClass('layui-btn-danger').html('已确认').attr('data-status', '2');
                    }else{
                        _this.removeClass('layui-btn-danger').addClass('layui-btn-warm').html('已提交').attr('data-status', '1');
                    }
                }
            });
        })
    });
</script>
<?php }
?>
</body>
</html>
