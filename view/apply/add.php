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
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/formSelects-v4.css"/>
    <script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="../../static/admin/js/addres.js"></script>
    <script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../static/admin/js/formSelects-v4.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <!--技术处理：17755464188-->
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
                                ?><option value="{$key}">{$value}</option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>学生姓名：</label>
                    <div class="layui-input-block">
                        <input type="text" name="student_name" lay-verify="required" placeholder="请输入报名学生姓名" autocomplete="off" class="layui-input" id="student_name">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>学生手机：</label>
                    <div class="layui-input-block">
                        <input type="text" name="student_phone" lay-verify="phone"placeholder="请输入学生手机号同网校账号" autocomplete="off" class="layui-input" id="student_phone">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>报考学段：</label>
                    <div class="layui-input-block">
                        <select name="section" lay-verify="required" id="section" lay-search>
                            <option value="">请选择学生报考学段</option>
                            <option value="幼儿">幼儿</option>
                            <option value="小学">小学</option>
                            <option value="初中">初中</option>
                            <option value="高中">高中</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>报考学科：</label>
                    <div class="layui-input-block">
                        <select name="subject" lay-verify="required" id="subject" lay-search>
                            <option value="">请选择学生报考学科</option>
                            <option value="语文">语文</option>
                            <option value="数学">数学</option>
                            <option value="英语">英语</option>
                            <option value="音乐">音乐</option>
                            <option value="美术">美术</option>
                            <option value="体育">体育</option>
                            <option value="信息">信息</option>
                            <option value="科学">科学</option>
                            <option value="政治">政治</option>
                            <option value="历史">历史</option>
                            <option value="地理">地理</option>
                            <option value="物理">物理</option>
                            <option value="化学">化学</option>
                            <option value="生物">生物</option>
                            <option value="幼儿教育">幼儿教育</option>
                            <option value="其他科目">其他科目</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>课程名称：</label>
                    <div class="layui-input-block">
                        <select name="course_id[]" xm-select="selectId" multiple id="course_id">
						<option value="">请选择报名网校课程</option>
							<?php
								foreach($course_list as $value){
								?><option value="{$value.id}">{$value.course_name}</option>
								<?php }
							?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>缴费方式：</label>
                    <div class="layui-input-block">
                        <select name="pay_type" lay-verify="required" id="pay_type">
                            <option value="">请选择付款方式</option>
                            <option value="微信">微信</option>
                            <option value="支付宝">支付宝</option>
                            <option value="现金">现金</option>
                            <option value="Apple Pay">Apple Pay</option>
                            <option value="POS">POS</option>
                            <option value="银行转账">银行转账</option>
							<option value="其他备注">其他备注</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>缴费金额：</label>
                    <div class="layui-input-block">
                        <input type="text" name="pay_amount" placeholder="请输入学生本次实收金额" class="layui-input" id="pay_amount" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>课程类型：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="course_type" title="网课" value="网课" checked>
                        <input type="radio" name="course_type" title="面授" value="面授">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>缴费种类：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="payment_type" title="全款" value="全款" checked>
                        <input type="radio" name="payment_type" title="补费" value="补费">
                        <input type="radio" name="payment_type" title="定金" value="定金">
                        <input type="radio" name="payment_type" title="升级" value="升级">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>是否邮寄：</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="is_send" lay-skin="switch" id="is_send" lay-text="是|否">
                    </div>
                </div>
				<div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>缴费时间：</label>
                    <div class="layui-input-block">
						<input class="layui-input" name="bao_time" placeholder="请输入缴费时间" id="LAY_demorange_s" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php if(isset($_POST['bao_time'])) echo $_POST['bao_time'];?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">其它备注：</label>
                    <div class="layui-input-block">
                        <input type="text" name="memo" placeholder="请输入额外赠送资料或已领取资料等其他备注" class="layui-input" id="memo">
                    </div>
                </div>
                <div class="layui-form-item">
					<label class="layui-form-label"></label>
					<div class="layui-input-block">
						<label  style="color: red;">注：以上内容请仔细填写，提交后无法修改，如需更改请联系网络部同事，转账需要开课请提交后点击“小喇叭”按钮，直接购买无需开课提交即可，面授转网课的缴费时间填转的时间，备注填写面授缴费时间。</label>
					</div>
				</div>
            </div>
            <div class="layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>选择地址：</label>
                    <div id="address" class="address">
                        <select id="province" name="province" lay-ignore onchange="getCityInfo();" lay-verify="required">
                            <option value="">省份</option>
                            <?php
                            foreach($province_list as $k=>$value){
                                ?><option value="{$value}">{$value}</option>
                            <?php }
                            ?>
                        </select>
                        <select name="city" id="city" lay-ignore onchange="getTownInfo();" lay-verify="required">
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
                        <input type="text" name="address" lay-verify="required" placeholder="请输入除省份城市区县以外的地址" class="layui-input" id="address">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-form-item" style="padding-left: 10px;">
        <div class="layui-input-block" style=" margin-left: 25%; ">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="admin" onclick="return addApply()">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    layui.use(['jquery', 'form', 'layer','element'], function () {
        window.layer = layui.layer;
        window.form = layui.form();
        var formSelects = layui.formSelects;
        formSelects.render('selectId');
    });

    function addApply(){
        $.ajax({
            url:"{:url('index/apply/check')}",
            data:$('#admin').serialize(),
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                if(res.status){
                    layer.confirm(res.msg, {
                        btn: ['继续','取消'] //按钮
                    }, function(){
                        $.ajax({
                            url:"{:url('index/apply/add')}",
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
                        });
                    }, function(){
                        var parent_index = parent.layer.getFrameIndex(window.name);
                        //parent.layer.close(parent_index);
                    });
                    return false;
                }else{
                    $.ajax({
                        url:"{:url('index/apply/add')}",
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
                    });
                }
            }
        });
        return false;
    }

    function getCityInfo(){
        var province = $('#province').val();
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
