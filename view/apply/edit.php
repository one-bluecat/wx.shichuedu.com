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
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/formSelects-v4.css"/>
</head>

<body>
<div class="page-content-wrap">
    <form class="layui-form column-content-detail lay-ajax" method="post" id="admin">
    <div class="layui-tab layui-tab-brief" style="margin: 0;">
        <ul class="layui-tab-title">
            <li><a href="/index.php/apply/index">信息列表</a></li>
            <li class="layui-this">信息编辑</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item"></div>
            <div class="layui-tab-item layui-show">
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>学生姓名：</label>
                        <div class="layui-input-block">
                            <input type="text" name="student_name" lay-verify="required" placeholder="请输入报名学生姓名" autocomplete="off" class="layui-input" id="student_name" value="{$detail.student_name}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>学生手机：</label>
                        <div class="layui-input-block">
                            <input type="text" name="student_phone" lay-verify="required" placeholder="请输入学生手机号同网校账号" autocomplete="off" class="layui-input" id="student_phone" value="{$detail.student_phone}">
                        </div>
                    </div>
					<div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>报考学段：</label>
                        <div class="layui-input-block">
                            <select name="section" lay-verify="required" lay-search>
                                <option value="">请选择学生报考学段</option>
                                <option value="幼儿" <?php if($detail['section'] == '幼儿') echo 'selected';?>>幼儿</option>
                                <option value="小学" <?php if($detail['section'] == '小学') echo 'selected';?>>小学</option>
                                <option value="初中" <?php if($detail['section'] == '初中') echo 'selected';?>>初中</option>
                                <option value="高中" <?php if($detail['section'] == '高中') echo 'selected';?>>高中</option>
								<option value="其他" <?php if($detail['section'] == '其他') echo 'selected';?>>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>报考学科：</label>
                        <div class="layui-input-block">
                            <select name="subject" lay-verify="required" lay-search>
                                <option value="">请选择学生报考学科</option>
                                <option value="语文" <?php if($detail['subject'] == '语文') echo 'selected';?>>语文</option>
                                <option value="数学" <?php if($detail['subject'] == '数学') echo 'selected';?>>数学</option>
                                <option value="英语" <?php if($detail['subject'] == '英语') echo 'selected';?>>英语</option>
								<option value="音乐" <?php if($detail['subject'] == '音乐') echo 'selected';?>>音乐</option>
								<option value="美术" <?php if($detail['subject'] == '美术') echo 'selected';?>>美术</option>
								<option value="体育" <?php if($detail['subject'] == '体育') echo 'selected';?>>体育</option>
								<option value="信息" <?php if($detail['subject'] == '信息') echo 'selected';?>>信息</option>
								<option value="科学" <?php if($detail['subject'] == '科学') echo 'selected';?>>科学</option>
								<option value="政治" <?php if($detail['subject'] == '政治') echo 'selected';?>>政治</option>
								<option value="历史" <?php if($detail['subject'] == '历史') echo 'selected';?>>历史</option>
								<option value="地理" <?php if($detail['subject'] == '地理') echo 'selected';?>>地理</option>
								<option value="物理" <?php if($detail['subject'] == '物理') echo 'selected';?>>物理</option>
								<option value="化学" <?php if($detail['subject'] == '化学') echo 'selected';?>>化学</option>
								<option value="生物" <?php if($detail['subject'] == '生物') echo 'selected';?>>生物</option>
								<option value="幼儿教育" <?php if($detail['subject'] == '幼儿教育') echo 'selected';?>>幼儿教育</option>
								<option value="其他科目" <?php if($detail['subject'] == '其他科目') echo 'selected';?>>其他科目</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>课程名称：</label>
                        <div class="layui-input-block">
                            <select name="course_id[]" xm-select="selectId" multiple>
                                <option value="">请选择报名网校课程</option>
                                <?php
                                    $course_arr = explode(',',$detail['course_id']);
                                foreach($course_list as $k=>$value){
                                    ?><option value="{$k}" <?php if(isset($detail['course_id']) && in_array($k,$course_arr)){echo 'selected';}?>>{$value}</option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>缴费方式：</label>
                        <div class="layui-input-block">
                            <select name="pay_type" lay-verify="required">
                                <option value="">请选择付款方式</option>
                                <option value="微信" <?php if($detail['pay_type'] == '微信') echo 'selected';?>>微信</option>
                                <option value="支付宝" <?php if($detail['pay_type'] == '支付宝') echo 'selected';?>>支付宝</option>
                                <option value="现金" <?php if($detail['pay_type'] == '现金') echo 'selected';?>>现金</option>
                                <option value="Apple Pay" <?php if($detail['pay_type'] == 'Apple Pay') echo 'selected';?>>Apple Pay</option>
                                <option value="POS" <?php if($detail['pay_type'] == 'POS') echo 'selected';?>>POS</option>
                                <option value="银行转账" <?php if($detail['pay_type'] == '银行转账') echo 'selected';?>>银行转账</option>
								<option value="其他备注" <?php if($detail['pay_type'] == '其他备注') echo 'selected';?>>未知</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>缴费金额：</label>
                        <div class="layui-input-block">
                            <input type="text" name="pay_amount" lay-verify="required" placeholder="请输入学生本次实收金额" class="layui-input" id="Paymentamount" value="{$detail.pay_amount}">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>课程类型：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="course_type" title="网课" value="网课" <?php if($detail['course_type'] == '网课') echo 'checked';?>>
                            <input type="radio" name="course_type" title="面授" value="面授" <?php if($detail['course_type'] == '面授') echo 'checked';?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>缴费种类：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="payment_type" title="全款" value="全款" <?php if($detail['payment_type'] == '全款') echo 'checked';?>>
                            <input type="radio" name="payment_type" title="补费" value="补费" <?php if($detail['payment_type'] == '补费') echo 'checked';?>>
                            <input type="radio" name="payment_type" title="定金" value="定金" <?php if($detail['payment_type'] == '定金') echo 'checked';?>>
                            <input type="radio" name="payment_type" title="升级" value="升级" <?php if($detail['payment_type'] == '升级') echo 'checked';?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>是否邮寄：</label>
                        <div class="layui-input-block">
                            <?php
                                if($detail['is_send']){
                                    ?>
                                    <input type="checkbox" checked name="is_send" lay-skin="switch" lay-filter="switchTest" lay-text="是|否">
                               <?php }else{
                                    ?><input type="checkbox" name="is_send" lay-skin="switch" lay-text="是|否">
                              <?php  }
                            ?>
                        </div>
                    </div>
					<div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>缴费时间：</label>
                        <div class="layui-input-block">
                            <input type="text" name="bao_time" lay-verify="required" placeholder="请输入缴费时间" class="layui-input" id="LAY_demorange_s" value="{$detail.bao_time}" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">其它备注：</label>
                        <div class="layui-input-block">
                            <input type="text" name="memo" placeholder="请输入邮寄备注或额外赠送资料" autocomplete="off" class="layui-input" value="{$detail.memo}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>选择地址：</label>
                        <div id="address" class="address">
                            <select id="province" name="province" lay-ignore onchange="getCityInfo();" lay-verify="required">
                                <option value="">请选择</option>
                                <?php
                                foreach($province_list as $k=>$value){
                                    ?><option value="{$value}" <?php if($detail['province'] == $value){echo 'selected';}?>>{$value}</option>
                                <?php }
                                ?>
                            </select>
                            <select name="city" id="city" lay-ignore onchange="getTownInfo();" lay-verify="required">
                                <option value="">城市</option>
                                <?php
                                foreach($city_list as $k=>$value){
                                    ?><option value="{$value}" <?php if($detail['city'] == $value){echo 'selected';}?>>{$value}</option>
                                <?php }
                                ?>
                            </select>
                            <select name="town" id="town" lay-ignore lay-verify="required">
                                <option value="">地区</option>
                                <?php
                                foreach($town_list as $k=>$value){
                                    ?><option value="{$value}" <?php if($detail['town'] == $value){echo 'selected';}?>>{$value}</option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>详细地址：</label>
                        <div class="layui-input-block">
                            <input type="text" name="address" lay-verify="required" placeholder="请输入具体地址" class="layui-input" id="detail_address" value="{$detail.address}">
                        </div>
                    </div>
                    <div class="layui-form-item" style="padding-left: 10px;">
                        <div class="layui-input-block" style=" margin-left: 25%; ">
                            <input type="hidden" name="id" value="{$detail.id}">
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo" onclick="return update()">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>
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
<script type="text/javascript" src="../../static/admin/js/addres.js"></script>
<script src="../../static/admin/js/formSelects-v4.js" type="text/javascript" charset="utf-8"></script>
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
            var formSelects = layui.formSelects;
            formSelects.render('selectId');
    });


    function update(){
        $.ajax({
            url:"{:url('index/apply/edit')}",
            data:$('#admin').serialize(),
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                layer.alert(res.msg, {
                         btn: ['确定']
                      ,yes: function(index, layero){
                            window.location.href="/index.php/apply/index";
                          }});
            }
        })
        return false;
    }


    function getCityInfo(){
        var province = $('#province').val();
        // var select_city = "{$detail.city}";
        // console.log(select_city);
        $.ajax({
            url:"{:url('index/apply/getCityInfo')}",
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
            url:"{:url('index/apply/getTownInfo')}",
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
