<?php /*a:1:{s:44:"D:\phpstudy_pro\WWW\tp6\view\address\add.php";i:1606120314;}*/ ?>
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
    <script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="../../static/admin/js/addres.js"></script>
    <script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<form class="layui-form column-content-detail lay-ajax" method="post" id="admin">
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">信息内容</li>
            <li>邮寄地址</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>咨询销售：</label>
                    <div class="layui-input-block">
                        <select name="sale_id" lay-verify="required" id="sale_id" lay-search>
                            <option value="">请选择咨询销售</option>
                            <?php
                            foreach($sale_list as $key =>$value){
                                ?><option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($value); ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>学生姓名：</label>
                    <div class="layui-input-block">
                        <input type="text" name="student_name" lay-verify="required"placeholder="请输入报名学生姓名" class="layui-input" id="student_name">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>收货手机：</label>
                    <div class="layui-input-block">
                        <input type="text" name="student_phone" lay-verify="phone" placeholder="请输入收货人手机号" class="layui-input" id="student_phone">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>邮寄商品：</label>
                    <div class="layui-input-block">
                        <input type="text" name="goods" lay-verify="required" placeholder="请输入邮寄内容" class="layui-input" id="goods">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>邮寄原因：</label>
                    <div class="layui-input-block">
                        <input type="text" name="reason" lay-verify="required" placeholder="请输入邮寄原因" class="layui-input" id="reason">
                    </div>
                </div>
            </div>
            <div class="layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>选择地址：</label>
                    <div id="address" class="address">
                        <select id="province" name="province" lay-ignore lay-verify="required" onchange="getCityInfo();">
                            <option value="">省份</option>
                            <?php
                            foreach($province_list as $k=>$value){
                                ?><option value="<?php echo htmlentities($value); ?>"><?php echo htmlentities($value); ?></option>
                            <?php }
                            ?>
                        </select>
                        <select name="city" id="city" lay-ignore lay-verify="required" onchange="getTownInfo();">
                            <option value="">城市</option>
                        </select>
                        <select name="town" id="town" lay-ignore lay-verify="required">
                            <option value="">地区</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>详细地址：</label>
                    <div class="layui-input-block">
                        <input type="text" name="address" lay-verify="required" placeholder="请输入具体地址" class="layui-input" id="detail_address">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-form-item" style="padding-left: 10px;">
        <div class="layui-input-block" style=" margin-left: 25%; ">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="admin" onclick="return addAddress()">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    function addAddress(){
        $.ajax({
            url:"<?php echo url('index/address/add'); ?>",
            data:$('#admin').serialize(),
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                layer.alert(res.msg);
                if(res.status){
                    var parent_index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(parent_index);
                    window.location.reload();
                }
            }
        })
        return false;
    }

    function getCityInfo(){
        var province = $('#province').val();
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
