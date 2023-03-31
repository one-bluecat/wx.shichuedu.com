<?php /*a:1:{s:41:"D:\web\wx.shichuedu.com\view\open\add.php";i:1605859430;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
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
<form class="layui-form column-content-detail" method="post" id="admin">
	<div class="layui-tab">
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label"><span style="color: red;">*</span>咨询销售：</label>
					<div class="layui-input-block">
                        <select name="sale_id" lay-verify="required" id="sale_id">
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
                        <input type="text" name="student_name" lay-verify="required" placeholder="请输入报名学生姓名" class="layui-input" id="student_name">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label"><span style="color: red;">*</span>手机账号：</label>
					<div class="layui-input-block">
                        <input type="text" name="student_phone" lay-verify="phone" placeholder="请输入收货人手机号" class="layui-input" id="student_phone">
					</div>
				</div>
				<div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>报考学段：</label>
                    <div class="layui-input-block">
                        <select name="section" lay-verify="required" id="section">
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
                        <select name="subject" lay-verify="required" id="subject">
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
					<label class="layui-form-label"><span style="color: red;">*</span>报名课程：</label>
					<div class="layui-input-block">
                        <select name="course_id[]" xm-select="selectId" multiple>
                            <option value="">请选择报名网校课程</option>
                            <?php
                            foreach($course_list as $value){
                                ?><option value="<?php echo htmlentities($value['id']); ?>"><?php echo htmlentities($value['course_name']); ?></option>
                            <?php }
                            ?>
                        </select>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label"><span style="color: red;">*</span>结算金额：</label>
					<div class="layui-input-block">
                        <input type="text" name="pay_amount" lay-verify="required" placeholder="请输入结算金额" class="layui-input" id="pay_amount">
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label"><span style="color: red;">*</span>开课原因：</label>
					<div class="layui-input-block">
						<textarea name="reason" class="layui-textarea" id="reason" lay-verify="required"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="layui-form-item" style="padding-left: 10px;">
		<div class="layui-input-block" style=" margin-left: 25%; ">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="admin" onclick="return addOpen()">立即提交</button>
			<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		</div>
	</div>
</form>
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
</script>
<script type="text/javascript">
    function addOpen(){
        $.ajax({
            url:"<?php echo url('index/open/add'); ?>",
            data:$('#admin').serialize(),
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                layer.alert(res.msg);
                //layer.close();
                if(res.status){
                    var parent_index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(parent_index);
                    window.location.reload();
                }

            }
        })
        return false;
    }
</script>
</body>
</html>