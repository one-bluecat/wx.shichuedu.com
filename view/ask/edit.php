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
	<form class="layui-form column-content-detail lay-ajax" method="post" id="admin">
<!--		<div class="layui-form-item">-->
<!--			<label class="layui-form-label">学生姓名：</label>-->
<!--			<div class="layui-input-block">-->
<!--				<input type="text" name="name" required lay-verify="required" value="{}" autocomplete="off" class="layui-input layui-disabled" disabled autocomplete="off">-->
<!--			</div>-->
<!--		</div>-->
		<div class="layui-form-item">
			<label class="layui-form-label">学生账号：</label>
			<div class="layui-input-block">
				<input type="text" name="name" required lay-verify="required" value="{$detail.item2}" autocomplete="off" class="layui-input layui-disabled" disabled autocomplete="off">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">课程名称：</label>
			<div class="layui-input-block">
				<select name="category" lay-verify="required" disabled autocomplete="off">
                    <option disabled="" selected="">- 请点击选择课程 -</option>
                    <option value="教综系列课程" <?php if($detail['item0'] == '教综系列课程'){echo 'selected';}?>>教综系列课程</option>
                    <option value="语文专业系列" <?php if($detail['item0'] == '语文专业系列'){echo 'selected';}?>>语文专业系列</option>
                    <option value="数学专业系列" <?php if($detail['item0'] == '数学专业系列'){echo 'selected';}?>>数学专业系列</option>
                    <option value="英语专业系列" <?php if($detail['item0'] == '英语专业系列'){echo 'selected';}?>>英语专业系列</option>
                    <option value="音乐专业系列" <?php if($detail['item0'] == '音乐专业系列'){echo 'selected';}?>>音乐专业系列</option>
                    <option value="体育专业系列" <?php if($detail['item0'] == '体育专业系列'){echo 'selected';}?>>体育专业系列</option>
                    <option value="美术专业系列" <?php if($detail['item0'] == '美术专业系列'){echo 'selected';}?>>美术专业系列</option>
                    <option value="信息专业系列" <?php if($detail['item0'] == '信息专业系列'){echo 'selected';}?>>信息专业系列</option>
                    <option value="科学专业系列" <?php if($detail['item0'] == '科学专业系列'){echo 'selected';}?>>科学专业系列</option>
                    <option value="政治专业系列" <?php if($detail['item0'] == '政治专业系列'){echo 'selected';}?>>政治专业系列</option>
                    <option value="历史专业系列" <?php if($detail['item0'] == '历史专业系列'){echo 'selected';}?>>历史专业系列</option>
                    <option value="地理专业系列" <?php if($detail['item0'] == '地理专业系列'){echo 'selected';}?>>地理专业系列</option>
                    <option value="物理专业系列" <?php if($detail['item0'] == '物理专业系列'){echo 'selected';}?>>物理专业系列</option>
                    <option value="化学专业系列" <?php if($detail['item0'] == '化学专业系列'){echo 'selected';}?>>化学专业系列</option>
                    <option value="生物专业系列" <?php if($detail['item0'] == '生物专业系列'){echo 'selected';}?>>生物专业系列</option>
                    <option value="资格证笔试系列" <?php if($detail['item0'] == '资格证笔试系列'){echo 'selected';}?>>资格证笔试系列</option>
                    <option value="幼教笔试系列" <?php if($detail['item0'] == '幼教笔试系列'){echo 'selected';}?>>幼教笔试系列</option>
				</select>
			</div>
		</div>
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">学生提问：</label>
			<div class="layui-input-block">
				<textarea name="desc" placeholder="{$detail.item1}" class="layui-textarea layui-disabled" disabled autocomplete="off"></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">问题回复：</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea" name="reply_content"   id="reply_content" lay-verify="reply_content" id="LAY_demo_editor">{$detail.reply_content}</textarea>
			</div>
		</div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <label  style="color: red;">注：学生提问若非题目问答，可点击操作黄色飞机按钮发送默认无关信息提醒，发送短信后状态自动变为已处理，若回答不完整可暂时保存编辑不发送。</label>
            </div>
        </div>
		<div class="layui-input-block">
            <input type="hidden" name="id" value="{$detail.id}" id="ids">
			<button class="layui-btn layui-btn-normal" onclick="return sendSms(1)" ><i class="layui-icon">&#xe609;</i> 发送短信</button>
			<button type="reset" class="layui-btn layui-btn-primary" onclick="oncancelForms()"><i class="layui-icon">&#x1006;</i> 放弃</button>
			<button class="layui-btn layui-btn-primary" onclick="return sendSms(2)"><i class="layui-icon">&#xe642;</i> 保存</button>
		</div>
	</form>
</div>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="../../static/admin/js/addres.js"></script>
<script>
    function close_window(){
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }
        function sendSms(type){
            if(!$('#reply_content').val()){
                layer.alert('请填写问题回复内容！');
                return false;
            }
            $.ajax({
                url:"{:url('index/ask/sendSms')}",
                data:{id:$('#ids').val(),reply_content:$('#reply_content').val(),type:type},
                type:'post',
                dataType:'json',
                async: false,
                success: function (res) {
                    if(res.status){
                        layer.alert(res.msg);
                        setTimeout(close_window,3000);
                    }else{
                        layer.alert(res.msg);
                    }
                }
            })
            return false;
        }
        function oncancelForms(){
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }
</script>
</body>
</html>