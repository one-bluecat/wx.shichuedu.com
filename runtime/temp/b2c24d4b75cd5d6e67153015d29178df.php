<?php /*a:1:{s:43:"D:\phpstudy_pro\WWW\tp6\view\apply\view.php";i:1605859406;}*/ ?>
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
                <input type="text" name="sale_id" required lay-verify="required" value="<?php echo htmlentities($sale_list[$detail['sale_id']]); ?>" class="layui-input layui-disabled" disabled autocomplete="off">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">学生姓名：</label>
            <div class="layui-input-block">
                <input type="text" name="student_name" required lay-verify="required" value="<?php echo htmlentities($detail['student_name']); ?>" class="layui-input layui-disabled" disabled autocomplete="off">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">学生手机：</label>
            <div class="layui-input-block">
                <input type="text" name="student_phone" required lay-verify="required" value="<?php echo htmlentities($detail['student_phone']); ?>" class="layui-input layui-disabled" disabled autocomplete="off">
            </div>
        </div>
		<div class="layui-form-item">
            <label class="layui-form-label">报考学段：</label>
            <div class="layui-input-block">
                <select name="section" lay-verify="required" disabled autocomplete="off">
                    <option value="<?php echo htmlentities($detail['section']); ?>"><?php echo htmlentities($detail['section']); ?></option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">报考学科：</label>
            <div class="layui-input-block">
                <select name="subject" lay-verify="required" disabled autocomplete="off">
                    <option value="<?php echo htmlentities($detail['subject']); ?>"><?php echo htmlentities($detail['subject']); ?></option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
                        <label class="layui-form-label">课程名称：</label>
                        <div class="layui-input-block">
                            <select name="course_id[]" xm-select="selectId" multiple disabled autocomplete="off">
                                <option value="">请选择报名网校课程</option>
                                <?php
                                    $course_arr = explode(',',$detail['course_id']);
                                foreach($course_list as $k=>$value){
                                    ?><option value="<?php echo htmlentities($k); ?>" <?php if(isset($detail['course_id']) && in_array($k,$course_arr)){echo 'selected';}?>><?php echo htmlentities($value); ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
        <div class="layui-form-item">
            <label class="layui-form-label">缴费方式：</label>
            <div class="layui-input-block">
                <select name="pay_type" lay-verify="required" disabled autocomplete="off">
                    <option value="<?php echo htmlentities($detail['pay_type']); ?>"><?php echo htmlentities($detail['pay_type']); ?></option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">缴费金额：</label>
            <div class="layui-input-block">
                <input type="text" name="pay_amount" required lay-verify="required" value="<?php echo htmlentities($detail['pay_amount']); ?>" class="layui-input layui-disabled" disabled autocomplete="off">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">课程类型：</label>
            <div class="layui-input-block">
                <input type="radio" name="course_type" title="网课" disabled value="网课" <?php if($detail['course_type'] == '网课') echo 'checked';?>>
                <input type="radio" name="course_type" title="面授" disabled value="面授" <?php if($detail['course_type'] == '面授') echo 'checked';?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">缴费种类：</label>
            <div class="layui-input-block">
                <input type="radio" name="payment_type" title="全款" disabled value="全款" <?php if($detail['payment_type'] == '全款') echo 'checked';?>>
                <input type="radio" name="payment_type" title="补费" disabled value="补费" <?php if($detail['payment_type'] == '补费') echo 'checked';?>>
                <input type="radio" name="payment_type" title="定金" disabled value="定金" <?php if($detail['payment_type'] == '定金') echo 'checked';?>>
                <input type="radio" name="payment_type" title="升级" disabled value="升级" <?php if($detail['payment_type'] == '升级') echo 'checked';?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否邮寄：</label>
            <div class="layui-input-block">
                <?php
                if($detail['is_send']){
                    ?>
                    <input type="checkbox" checked name="is_send" lay-skin="switch" lay-filter="switchTest" lay-text="是|否" disabled autocomplete="off">
                <?php }else{
                    ?><input type="checkbox" name="is_send" lay-skin="switch" lay-text="是|否" disabled autocomplete="off">
                <?php  }
                ?>
            </div>
        </div>
		<div class="layui-form-item">
                        <label class="layui-form-label">报名时间：</label>
                        <div class="layui-input-block">
                            <input type="text" name="bao_time" lay-verify="required" placeholder="请输入报名时间" class="layui-input" id="LAY_demorange_s" value="<?php echo htmlentities($detail['bao_time']); ?>" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" disabled autocomplete="off">
                        </div>
                    </div>
        <div class="layui-form-item">
            <label class="layui-form-label">其它备注：</label>
            <div class="layui-input-block">
                <input type="text" name="memo" required lay-verify="required" value="<?php echo htmlentities($detail['memo']); ?>" class="layui-input layui-disabled" disabled autocomplete="off">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">选择地址：</label>
            <div id="address" class="address">
                <select id="province" name="province" lay-ignore disabled autocomplete="off" class="layui-disabled">
                    <option value=""><?php echo htmlentities($detail['province']); ?></option>
                </select>
                <select name="city" id="city" lay-ignore disabled autocomplete="off" class="layui-disabled">
                    <option value=""><?php echo htmlentities($detail['city']); ?></option>
                </select>
                <select name="town" id="town" lay-ignore disabled autocomplete="off" class="layui-disabled">
                    <option value=""><?php echo htmlentities($detail['town']); ?></option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">详细地址：</label>
            <div class="layui-input-block">
                <input type="text" name="address" required lay-verify="required" value="<?php echo htmlentities($detail['address']); ?>" class="layui-input layui-disabled" disabled autocomplete="off" >
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
<script type="text/javascript">
    $(function(){
        $("#address").selectAddress()
        $("#town").focusout(function(){
            var province = $("#province option:selected").html()
            var city = $("#city option:selected").html()
            var town = $("#town option:selected").html()
            if(province!= '选择省份' && city!="选择城市" && town!='选择区域'){
                console.log('省份/直辖市：'+province+'\n城市:'+city+'\n区/县：'+town)
            }
        })
    })
</script>
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