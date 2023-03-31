<!DOCTYPE html>
<html class="iframe-h">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>师出网校管理后台登录</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
    <script type="text/javascript" src="http://zw.shichuedu.com/resources/static/home/js/jquery-1.7.1.min.js"></script>
    <style>
    .tct {
	width: 100%;
	height: 100%;
	position: fixed;
	left: 0;
	top: 0;
	z-index: 9;
	background: rgba(0,0,0,.5);
	/*display: none;*/
    }
    
    .tct .boxt {
    	width: 36%;
    	height: 380px;
    	background: #fff;
    	position: absolute;
    	left: 50%;
    	top: 50%;
    	transform: translate(-50%,-50%);
    	box-sizing: border-box;
    	padding-top: 54px;
    }
    
    .tct .boxt .icont {
    	width: 110px;
    	height: 110px;
    	margin: auto;
    }
    
    .tct .boxt .t1 {
    	font-size: 18px;
    	line-height: 28px;
    	color: #333;
    	text-align: center;
    	box-sizing: border-box;
    	padding: 0 30px;
    	margin-top: 5px;
    }
    
    .tct .boxt .t2 {
    	display: flex;
    	justify-content: center;
    	margin-top: 20px;
    }
    
    .tct .boxt .t2 .btnt {
    	width: 116px;
    	height: 40px;
    	border: none;
    	background: #1296db;
    	color: #fff;
    	font-size: 18px;
    	display: block;
    	cursor: pointer;
    }
    
    .tct .boxt .t2 {
    	border: none;
    	background: #295965;
    	color: #fff;
    	font-size: 18px;
    	cursor: pointer;
    }
    </style>
</head>
<body>
<!-- <div class="tct">
    <div class="boxt">
        
        <div class="t1">报名信息须知</div>
        <div class="t1" style="text-align: left;"><h1>
        1.本菜单提交类型：正常销售课程、面授转网课、面授不开换网课。<br>
        2.提交后无法修改，请仔细核对填写信息，如需修改联系网校同事。<br>
        3.其他任何不在填写项的特殊事宜均在备注填写。<br>
        4.邮寄信息按照格式填写，详细地址不要有重复填写省份城市，不要有空格。<br>
        5.不邮寄的学生邮寄信息选择未知或填写未知。<br>
        6.其他网校注意事项。<a href="https://docs.qq.com/doc/DSkJlSnBubFBZV0tP" style="color:red;"target='_BLANK'>点击查看<br>
        </h1></div>
        <div class="t1"></div>
        <div class="t2">
            <a onclick="$('.tct').hide();return false;" href="javascript:;"
			style="position: absolute;"><input type="button" value="确定" class="btnt"></a>
        </div>
    </div>
</div> -->
<div class="wrap-container clearfix">
    <div class="column-content-detail">
        <form class="layui-form" action="/index.php/apply/index" method="post" id="form">
            <div class="layui-form-item">
                <div class="layui-inline tool-btn">
                    <button class="layui-btn layui-btn-small layui-btn-normal addBtn" data-url="/index.php/apply/add"><i class="layui-icon">&#xe654;</i></button>
                    <button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn" data-url="/index.php/apply/index?export=1"><i class="iconfont">&#xe639;</i></button>
                    <!-- <button class="layui-btn layui-btn-small layui-btn-shua shua" data-title='刷新'><i class="layui-icon">&#x1002;</i></button> -->
                </div>
                <div class="layui-inline">
                    <input type="text" name="student_phone" placeholder="请输入学生手机号" autocomplete="off" class="layui-input" value="<?php if(isset($_POST['student_phone'])) echo $_POST['student_phone'];?>">
                </div>
                <div class="layui-inline">
                    <select name="sale_id" id="sale_id">
                        <option value="0">选择销售</option>
                        <?php
                        foreach($sale_list as $k=>$value){
                            ?><option value="{$k}" <?php if(isset($_POST['sale_id']) && $_POST['sale_id'] == $k){echo 'selected';}?>>{$value}</option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <select name="school_id">
                        <option value="0">选择分校</option>
                        <?php
                        foreach($school_list as $k=>$value){
                            ?><option value="{$k}" <?php if(isset($_POST['school_id']) && $_POST['school_id'] == $k){echo 'selected';}?>>{$value}</option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <input class="layui-input" name="start_time" placeholder="缴费开始时间" id="LAY_demorange_s" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php if(isset($_POST['start_time'])) echo $_POST['start_time'];?>">
                </div>
                <div class="layui-inline">
                    <input class="layui-input" name="end_time" placeholder="缴费结束时间" id="LAY_demorange_e" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php if(isset($_POST['end_time'])) echo $_POST['end_time'];?>">
                </div>
                <button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>
            </div>
        </form>
        <div class="layui-form" id="table-list" style="overflow-y:auto;">
            <table class="layui-table" lay-even lay-skin="nob">
                <colgroup>
                    <!--<col width="50" class="hidden-xs">-->
                    <col width="100" class="hidden-xs">
                    <col width="100" class="hidden-xs">
                    <col width="100" class="hidden-xs">
                    <col width="180" class="hidden-xs">
                    <col width="130">
                    <col width="200">
                    <col width="50" class="hidden-xs">
                    <col width="70" class="hidden-xs">
                    <col width="170"  class="hidden-xs">
                    <col width="170">
                    <col width="100"class="hidden-xs">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <!--<th class="hidden-xs"><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>-->
                    <th class="hidden-xs">分校</th>
                    <th class="hidden-xs">咨询</th>
                    <th class="hidden-xs">学员</th>
                    <th class="hidden-xs">备注</th>
                    <th>手机号/账号</th>
                    <th>课程名称</th>
                    <th colspan="2" style="text-align: center;" class="hidden-xs">收费金额</th>
                    <th class="hidden-xs">缴费时间</th>
                    <th>提交时间</th>
                    <th class="hidden-xs">状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                {volist name="applys" id="vo"}
                    <tr>
                        <!--<td class="hidden-xs"><input type="checkbox" name="id[]" lay-skin="primary" data-id="1" value="{$vo.id}"></td>-->
                        <td class="hidden-xs">{$school_list[$vo.school_id]}</td>
                        <td class="hidden-xs">{$sale_list[$vo.sale_id]}</td>
                        <td class="hidden-xs">{$vo.student_name}</td>
                        <td class="hidden-xs">{$vo.memo}</td>
                        <td>{$vo.student_phone}</td>
                        <?php
                            $courseArr = explode(',',$vo['course_id']);
                            $course_str = "";
                            $course_str_arr = array();
                            foreach ($courseArr as $courseId){
                                $course_str_arr[] = $course_list[$courseId];
                            }
                            $course_str = implode("<br/>",$course_str_arr);
                        ?>
                        <td>{$course_str|raw}</td>
                        <td class="hidden-xs">{$vo.pay_amount}</td>
                        <td class="hidden-xs"><button style="margin-left:5px;" class="layui-btn layui-btn-mini layui-btn-zhuangtai">{$vo.pay_type}</button></td>
                        <td class="hidden-xs">{$vo.bao_time}</td>
                        <td>{$vo.add_time}</td>
                        <td class="hidden-xs"><button class="layui-btn layui-btn-mini layui-btn-danger dingHBtn" <?php
                        if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']==1){
                        ?>onclick="tips({$vo.id},2);"<?php }
                        ?>>已提交</button></td>
                        <td>
                            <div class="layui-inline">
                                <?php
                                    if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']==1){
                                       ?>
                                        <button class="layui-btn layui-btn-small layui-btn-normal go-btn goBtn " data-id="1" data-url="/index.php/apply/edit?id={$vo.id}"><i class="layui-icon">&#xe642;</i></button>
                                   <?php }
                                ?>
                                <button style="margin-left:0px;" class="layui-btn layui-btn-small layui-btn-shua go-btn layui-btn-search  searchBtn" data-id="1" data-url="/index.php/apply/view?id={$vo.id}"><i class="layui-icon">&#xe615;</i></button>
                                <?php
                                if(isset($_SESSION['admin']['limit']) && $_SESSION['admin']['limit']==1){
                                    ?>
                                    <button class="layui-btn layui-btn-small layui-btn-danger delBtn leftBtn"  data-url="/index.php/apply/delete?id={$vo.id}"><i class="layui-icon">&#xe640;</i></button>
                                <?php }
                                ?>
								 <button class="layui-btn layui-btn-small layui-btn-warm dingBtn" onclick="tips({$vo.id},1);"><i class="layui-icon">&#xe645;</i></button>
                            </div>
                        </td>
                    </tr>
                {/volist}
                </tbody>
            </table>
            <div class="page-wrap">
                <?php echo $page;?>
            </div>
        </div>
    </div>
</div>
<!--技术处理：17755464188-->
<script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script>

    // function exportExcel(){
    //     $('.layui-form').attr('action','/index.php/apply/index?export=1');
    //     $('.layui-form').submit();
    // }

    function tips(id,type){
        layui.dialog.confirm({
            message:'是否发送钉钉群通知？（请勿连续多次点击）',
            success:function(){
                $.ajax({
                    url:"{:url('index/apply/notify')}",
                    data:{id:id,type:type},
                    type:'post',
                    dataType:'json',
                    async: false,
                    success: function (res) {
                        layer.msg(res.msg)
                    }
                });
            },
            cancel:function(){
                layer.msg('取消了')
            }
        })
        return false;
    }

</script>

</body>
</html>
