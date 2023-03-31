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
</head>
<body>
<div class="page-content-wrap">
	<div class="layui-tab layui-tab-brief" style="margin: 0;">
		<ul class="layui-tab-title">
			<li><a href="/index.php/money/index">信息列表</a></li>
			<li class="layui-this">信息编辑</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item">
			</div>
			<div class="layui-tab-item layui-show">
				<form class="layui-form column-content-detail lay-ajax" method="post" id="admin">
					<div class="layui-form-item">
						<label class="layui-form-label"><span style="color: red;">*</span>结算对象：</label>
                        <div class="layui-input-block">
                            <select name="sale_id" lay-verify="required" id="sale_id" lay-search>
                                <option value="">请选择结算对象</option>
                                <?php
                                foreach($sale_list as $k=>$value){
                                    ?><option value="{$k}" <?php if($detail['sale_id'] == $k){echo 'selected';}?>>{$value}</option>
                                <?php }
                                ?>
                            </select>
                        </div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label"><span style="color: red;">*</span>结算金额：</label>
						<div class="layui-input-block">
							<input type="text" name="pay_amount" lay-verify="required" placeholder="请输入结算金额" class="layui-input" id="pay_amount" value="{$detail.pay_amount}">
						</div>
					</div>
					<div class="layui-form-item layui-form-text">
						<label class="layui-form-label"><span style="color: red;">*</span>结算内容：</label>
						<div class="layui-input-block">
                            <input type="text" name="reason" lay-verify="required" placeholder="请输入结算内容" class="layui-input" id="reason" value="{$detail.reason}">
						</div>
					</div>
					<div class="layui-form-item" style="padding-left: 10px;">
						<div class="layui-input-block" style=" margin-left: 25%; ">
                            <input type="hidden" name="id" value="{$detail.id}">
                            <button class="layui-btn layui-btn-normal"  onclick="return update()">立即提交</button>
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
    function update(){
        $.ajax({
            url:"{:url('index/money/edit')}",
            data:$('#admin').serialize(),
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                layer.alert(res.msg, {
                    btn: ['确定']
                    ,yes: function(index, layero){
                        window.location.href="/index.php/money/index";
                    }});
            }
        })
        return false;
    }
</script>
</body>
</html>