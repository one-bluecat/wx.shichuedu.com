<?php /*a:1:{s:42:"D:\phpstudy_pro\WWW\tp6\view\money\add.php";i:1606444141;}*/ ?>
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
<script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="../../static/admin/js/addres.js"></script>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<form class="layui-form column-content-detail" method="post" id="admin">
	<div class="layui-tab">
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label"><span style="color: red;">*</span>结算对象：</label>
					<div class="layui-input-block">
                        <select name="sale_id" lay-verify="required" id="sale_id" lay-search>
                            <option value="">请选择结算对象</option>
                            <?php
                            foreach($sale_list as $key =>$value){
                                ?><option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($value); ?></option>
                            <?php }
                            ?>
                        </select>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label"><span style="color: red;">*</span>金额：</label>
					<div class="layui-input-block">
                        <input type="text" name="pay_amount" lay-verify="required" placeholder="请输入退费金额" class="layui-input" id="pay_amount">
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label"><span style="color: red;">*</span>结算内容：</label>
					<div class="layui-input-block">
                        <input type="text" name="reason" lay-verify="required" placeholder="请输入结算内容" class="layui-input" id="reason">
					</div>
				</div>
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <label  style="color: red;">注：此菜单用于部门营业额结算，金额为正是增加，负为减少。</label>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<div class="layui-form-item" style="padding-left: 10px;">
		<div class="layui-input-block" style=" margin-left: 25%; ">
            <button class="layui-btn layui-btn-normal"  lay-filter="admin" onclick="return addMoney()">立即提交</button>
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
<script type="text/javascript">
    function addMoney(){
        $.ajax({
            url:"<?php echo url('index/money/add'); ?>",
            data:$('#admin').serialize(),
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                layer.alert(res.msg);
                //layer.close();
                //window.location.reload()
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