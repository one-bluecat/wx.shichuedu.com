<?php /*a:1:{s:51:"/www/wwwroot/wx.shichuedu.com/view/address/edit.php";i:1606120324;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>师出网校管理后台登录</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
</head>
<body>
<div class="page-content-wrap">
    <div class="layui-tab layui-tab-brief" style="margin: 0;">
        <ul class="layui-tab-title">
            <li><a href="/index.php/address/index">信息列表</a></li>
            <li class="layui-this">信息编辑</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item"></div>
            <div class="layui-tab-item layui-show">
                <form class="layui-form" id="admin">
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>咨询销售：</label>
                        <div class="layui-input-block">
                            <select name="sale_id" lay-verify="required" id="sale_id" lay-search>
                                <option value="">请选择报名咨询销售</option>
                                <?php
                                foreach($sale_list as $k=>$value){
                                    ?><option value="<?php echo htmlentities($k); ?>" <?php if($detail['sale_id'] == $k){echo 'selected';}?>><?php echo htmlentities($value); ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>学生姓名：</label>
                        <div class="layui-input-block">
                            <input type="text" name="student_name" lay-verify="required" placeholder="请输入报名学生姓名" class="layui-input" id="student_name" value="<?php echo htmlentities($detail['student_name']); ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>收货手机：</label>
                        <div class="layui-input-block">
                            <input type="text" name="student_phone" lay-verify="phone" placeholder="请输入收货人手机号" class="layui-input" id="student_phone" value="<?php echo htmlentities($detail['student_phone']); ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>邮寄商品：</label>
                        <div class="layui-input-block">
                            <input type="text" name="goods" lay-verify="required" placeholder="请输入邮寄内容" class="layui-input" id="goods" value="<?php echo htmlentities($detail['goods']); ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>邮寄原因：</label>
                        <div class="layui-input-block">
                            <input type="text" name="reason" lay-verify="required" placeholder="请输入邮寄原因" class="layui-input" id="reason" value="<?php echo htmlentities($detail['reason']); ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>选择地址：</label>
                        <div id="address" class="address">
                            <select id="province" name="province" lay-ignore lay-verify="required" onchange="getCityInfo();">
                                <option value="">省份</option>
                                <?php
                                foreach($province_list as $k=>$value){
                                    ?><option value="<?php echo htmlentities($value); ?>" <?php if($detail['province'] == $value){echo 'selected';}?>><?php echo htmlentities($value); ?></option>
                                <?php }
                                ?>
                            </select>
                            <select name="city" id="city" lay-ignore lay-verify="required" onchange="getTownInfo();">
                                <option value="">城市</option>
                                <?php
                                foreach($city_list as $k=>$value){
                                    ?><option value="<?php echo htmlentities($value); ?>" <?php if($detail['city'] == $value){echo 'selected';}?>><?php echo htmlentities($value); ?></option>
                                <?php }
                                ?>
                            </select>
                            <select name="town" id="town" lay-ignore lay-verify="required">
                                <option value="">地区</option>
                                <?php
                                foreach($town_list as $k=>$value){
                                    ?><option value="<?php echo htmlentities($value); ?>" <?php if($detail['town'] == $value){echo 'selected';}?>><?php echo htmlentities($value); ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>详细地址：</label>
                        <div class="layui-input-block">
                            <input type="text" name="address" lay-verify="required" placeholder="请输入具体地址" class="layui-input" id="detail_address" value="<?php echo htmlentities($detail['address']); ?>">
                        </div>
                    </div>
                    <div class="layui-form-item" style="padding-left: 10px;">
                        <div class="layui-input-block" style=" margin-left: 25%; ">
                            <input type="hidden" name="id" value="<?php echo htmlentities($detail['id']); ?>">
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo" onclick="return update()">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var SCOPE = {
        static: '/static',
        index: '/admin/category/index.html',
        add: 'add.html',
        save: '/admin/category/save.html',
        edit: 'add.html',
        updateEdit: '/admin/category/updateedit.html',
        status: '/admin/category/updatestatus.html',
        del: '/admin/category/del.html',
        delAll: '/admin/category/deleteall.html',
        listOrderAll: '/admin/category/listorderall.html'
    }
</script>
<script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script>

    layui.use(['form', 'jquery', 'laydate', 'layer', 'laypage', 'dialog',  'element', 'upload', 'layedit'], function() {
        var form = layui.form(),
            layer = layui.layer,
            $ = layui.jquery,
            laypage = layui.laypage,
            laydate = layui.laydate,
            layedit = layui.layedit,
            element = layui.element(),
            dialog = layui.dialog;
    });

    function update(){
        $.ajax({
            url:"<?php echo url('index/address/edit'); ?>",
            data:$('#admin').serialize(),
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                layer.alert(res.msg, {
                    btn: ['确定']
                    ,yes: function(index, layero){
                        window.location.href="/index.php/address/index";
                    }});
            }
        })
        return false;
    }

    function getCityInfo(){
        var province = $('#province').val();
        // var select_city = "<?php echo htmlentities($detail['city']); ?>";
        // console.log(select_city);
        $.ajax({
            url:"<?php echo url('index/apply/getCityInfo'); ?>",
            data:{province:province},
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                if(res.status==1){
                    var city_select='<option>请选择</option>';
                    $.each(res.data,function(index,value){
                        console.log(index + "....." + value.id);
                        city_select+='<option value="'+value.name+'">'+value.name+'</option>';
                    });
                    $('#city').html(city_select);
                }
            }
        })
    }

    function getTownInfo(){
        var province = $('#province').val();
        var city = $('#city').val();
        $.ajax({
            url:"<?php echo url('index/apply/getTownInfo'); ?>",
            data:{province:province,city:city},
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                if(res.status==1){
                    var town_select='<option>请选择</option>';
                    $.each(res.data,function(index,value){
                        console.log(index + "....." + value.id);
                        town_select+='<option value="'+value.name+'">'+value.name+'</option>';
                    });
                    $('#town').html(town_select);
                }
            }
        })
    }
</script>
</body>
</html>