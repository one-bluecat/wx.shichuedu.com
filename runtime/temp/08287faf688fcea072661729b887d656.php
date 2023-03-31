<?php /*a:1:{s:44:"D:\phpstudy_pro\WWW\tp6\view\admin\index.php";i:1606373641;}*/ ?>
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
</head>
<body>
<div class="layui-tab page-content-wrap layui-tab-brief">
    <ul class="layui-tab-title">
        <li class="layui-this">修改资料</li>
        <li>修改密码</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form column-content-detail lay-ajax" method="post" id="admin">
                <div class="layui-form-item">
                    <label class="layui-form-label">权限ID：</label>
                    <div class="layui-input-block">
                        <input type="text" name="id" disabled autocomplete="off" class="layui-input layui-disabled" value="<?php echo htmlentities($detail['limit']); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">负责人：</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" required  lay-verify="required" placeholder="请输入标题" disabled autocomplete="off" class="layui-input layui-disabled" value="<?php echo htmlentities($detail['charge']); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">所属分校：</label>
                    <div class="layui-input-block">
                        <select name="category" lay-verify="required" disabled autocomplete="off">
                            <?php
                            foreach($school_list as $k=>$value){
                                ?><option value="<?php echo htmlentities($k); ?>" <?php if(isset($detail['id']) && $detail['id'] == $k){echo 'selected';}?>><?php echo htmlentities($value); ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">备注：</label>
                    <div class="layui-input-block">
                        <textarea name="desc" class="layui-textarea"><?php echo htmlentities($detail['mark']); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-normal" disabled>立即提交</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="layui-tab-item">
            <form class="layui-form" v style="width: 90%;padding-top: 20px;">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>旧密码：</label>
                    <div class="layui-input-block">
                        <input type="password" name="password1" lay-verify="required" placeholder="请输入密码" class="layui-input" id="old_password">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>新密码：</label>
                    <div class="layui-input-block">
                        <input type="password" name="password2" lay-verify="required" placeholder="请输入密码" class="layui-input" id="new_password">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;">*</span>重复密码：</label>
                    <div class="layui-input-block">
                        <input type="password" name="password3" lay-verify="required" placeholder="请输入密码" class="layui-input" id="confirm_password">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-normal" onclick="return updatePassword();">立即提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script>
    function updatePassword(){
        $.ajax({
            url:"<?php echo url('index/admin/updatePassword'); ?>",
            data:{old_password:$('#old_password').val(),new_password:$('#new_password').val(),confirm_password:$('#confirm_password').val()},
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                layer.alert(res.msg);
            }
        })
        return false;
    }
</script>
</body>
</html>
