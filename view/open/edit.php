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
</head>
<body>
<div class="page-content-wrap">
	<div class="layui-tab layui-tab-brief" style="margin: 0;">
		<ul class="layui-tab-title">
			<li><a href="/index.php/open/index">信息列表</a></li>
			<li class="layui-this">信息编辑</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item">
			</div>
			<div class="layui-tab-item layui-show">
				<form class="layui-form" id="admin">
					<div class="layui-form-item">
						<label class="layui-form-label"><span style="color: red;">*</span>咨询销售：</label>
                        <div class="layui-input-block">
                            <select name="sale_id" lay-verify="required" id="sale_id">
                                <option value="">请选择报名咨询销售</option>
                                <?php
                                foreach($sale_list as $k=>$value){
                                    ?><option value="{$k}" <?php if($detail['sale_id'] == $k){echo 'selected';}?>>{$value}</option>
                                <?php }
                                ?>
                            </select>
                        </div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label"><span style="color: red;">*</span>学生姓名：</label>
                        <div class="layui-input-block">
                            <input type="text" name="student_name" lay-verify="required" placeholder="请输入报名学生姓名" class="layui-input" id="student_name" value="{$detail.student_name}">
                        </div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label"><span style="color: red;">*</span>手机账号：</label>
                        <div class="layui-input-block">
                            <input type="text" name="student_phone" lay-verify="required" placeholder="请输入学员网校账号" class="layui-input" id="student_phone" value="{$detail.student_phone}">
                        </div>
					</div>
					<div class="layui-form-item">
                        <label class="layui-form-label"><span style="color: red;">*</span>报考学段：</label>
                        <div class="layui-input-block">
                            <select name="section" lay-verify="required">
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
                            <select name="subject" lay-verify="required">
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
						<label class="layui-form-label"><span style="color: red;">*</span>开通课程：</label>
                        <div class="layui-input-block">
                            <select name="course_id[]" xm-select="selectId" multiple>
                                <option value="">请选择需要开通的网校课程</option>
                                <?php
                                $course_arr = explode(',',$detail['course_id']);
                                foreach($course_list as $k=>$value){
                                    ?><option value="{$k}" <?php if(isset($detail['course_id']) && in_array($k,$course_arr)){echo 'selected';}?>>{$value}</option>
                                <?php }
                                ?>
                            </select>
                        </div>
					</div>
					<!-- <div class="layui-form-item">
						<label class="layui-form-label"><span style="color: red;">*</span>结算金额：</label>
						<div class="layui-input-block">
							<input type="text" name="pay_amount" lay-verify="required" placeholder="协议班赠送为网课原价的60%，第一次填全，后续同一人开课填0" class="layui-input" id="pay_amount" value="{$detail.pay_amount}">
						</div>
					</div> -->
					<div class="layui-form-item layui-form-text">
						<label class="layui-form-label"><span style="color: red;">*</span>开课原因：</label>
						<div class="layui-input-block">
							<textarea name="reason" class="layui-textarea" id="reason" placeholder="{$detail.reason}" lay-verify="required">{$detail.reason}</textarea>
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
            url:"{:url('index/open/edit')}",
            data:$('#admin').serialize(),
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                layer.alert(res.msg, {
                    btn: ['确定']
                    ,yes: function(index, layero){
                        window.location.href="/index.php/open/index";
                    }});
            }
        })
        return false;
    }
</script>
</body>
</html>