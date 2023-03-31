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
	<form class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">咨询销售：</label>
			<div class="layui-input-block">
                <input type="text" name="sale_id" required lay-verify="required" value="{$detail.sale_id}" class="layui-input layui-disabled" disabled autocomplete="off">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">学生姓名：</label>
			<div class="layui-input-block">
                <input type="text" name="student_name" required lay-verify="required" value="{$detail.student_name}" class="layui-input layui-disabled" disabled autocomplete="off">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">手机账号：</label>
			<div class="layui-input-block">
                <input type="text" name="student_phone" required lay-verify="required" value="{$detail.student_phone}" class="layui-input layui-disabled" disabled autocomplete="off">
			</div>
		</div>
        <div class="layui-form-item">
            <label class="layui-form-label">报考学段：</label>
            <div class="layui-input-block">
                <select name="section" lay-verify="required" disabled autocomplete="off">
                    <option value="{$detail.section}">{$detail.section}</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">报考学科：</label>
            <div class="layui-input-block">
                <select name="subject" lay-verify="required" disabled autocomplete="off">
                    <option value="{$detail.subject}">{$detail.subject}</option>
                </select>
            </div>
        </div>
		<div class="layui-form-item">
						<label class="layui-form-label">报名课程：</label>
                        <div class="layui-input-block">
                            <select name="course_id[]" xm-select="selectId" multiple disabled autocomplete="off">
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
			<label class="layui-form-label">退费金额：</label>
			<div class="layui-input-block">
                <input type="text" name="pay_amount" required lay-verify="required" autocomplete="off" class="layui-input layui-disabled" id="pay_amount" value="{$detail.pay_amount}" disabled autocomplete="off">
			</div>
		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">退费原因：</label>
			<div class="layui-input-block">
				<textarea name="desc" placeholder="{$detail.reason}" class="layui-textarea layui-disabled" disabled autocomplete="off">{$detail.reason}</textarea>
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
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
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
        //获取当前iframe的name值
        var iframeObj = $(window.frameElement).attr('name');
        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor', {
            tool: ['strong' //加粗
                , 'italic' //斜体
                , 'underline' //下划线
                , 'del' //删除线
                , '|' //分割线
                , 'left' //左对齐
                , 'center' //居中对齐
                , 'right' //右对齐
                , 'link' //超链接
                , 'unlink' //清除链接
                , 'image' //插入图片
            ],
            height: 100
        })
        //全选
        form.on('checkbox(allChoose)', function(data) {
            var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
            child.each(function(index, item) {
                item.checked = data.elem.checked;
            });
            form.render('checkbox');
        });
        form.render();
        layui.upload({
            url: '上传接口url',
            success: function(res) {
                console.log(res); //上传成功返回值，必须为json格式
            }
        });
    });
</script>
</body>
</html>