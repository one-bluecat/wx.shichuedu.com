<?php /*a:1:{s:42:"D:\phpstudy_pro\WWW\tp6\view\ask\index.php";i:1606103792;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>师出网校管理后台登录</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
</head>
<body>
<div class="page-content-wrap">
    <form class="layui-form" action="">
        <div class="layui-form-item">
            <div class="layui-inline tool-btn">
                <button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn" data-url="/admin/category/listorderall.html"><i class="iconfont">&#xe639;</i></button>
                <button class="layui-btn layui-btn-small layui-btn-shua shua" data-title='刷新'><i class="layui-icon">&#x1002;</i></button>
            </div>
            <div class="layui-inline">
                <select name="item0" lay-filter="status">
                    <option value="">选择网课</option>
                    <option value="教综系列课程" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '教综系列课程') echo 'selected';?>>教综系列课程</option>
                    <option value="语文专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '语文专业系列') echo 'selected';?>>语文专业系列</option>
                    <option value="数学专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '数学专业系列') echo 'selected';?>>数学专业系列</option>
                    <option value="英语专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '英语专业系列') echo 'selected';?>>英语专业系列</option>
                    <option value="音乐专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '音乐专业系列') echo 'selected';?>>音乐专业系列</option>
                    <option value="体育专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '体育专业系列') echo 'selected';?>>体育专业系列</option>
                    <option value="美术专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '美术专业系列') echo 'selected';?>>美术专业系列</option>
                    <option value="信息专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '信息专业系列') echo 'selected';?>>信息专业系列</option>
                    <option value="科学专业系列  <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '科学专业系列') echo 'selected';?>">科学专业系列</option>
                    <option value="政治专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '政治专业系列') echo 'selected';?>>政治专业系列</option>
                    <option value="历史专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '历史专业系列') echo 'selected';?>>历史专业系列</option>
                    <option value="地理专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '地理专业系列') echo 'selected';?>>地理专业系列</option>
                    <option value="物理专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '物理专业系列') echo 'selected';?>>物理专业系列</option>
                    <option value="化学专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '化学专业系列') echo 'selected';?>>化学专业系列</option>
                    <option value="生物专业系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '生物专业系列') echo 'selected';?>>生物专业系列</option>
                    <option value="资格证笔试系列<?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '资格证笔试系列') echo 'selected';?>">资格证笔试系列</option>
                    <option value="幼教笔试系列" <?php if(isset($_REQUEST['item0']) && $_REQUEST['item0'] == '幼教笔试系列') echo 'selected';?>>幼教笔试系列</option>
                </select>
            </div>
            <div class="layui-inline">
                <select name="states" lay-filter="status">
                    <option value="">选择状态</option>
                    <option value="2">已处理</option>
                    <option value="1">未处理</option>
                </select>
            </div>
            <div class="layui-inline">
                <input type="text" name="title" placeholder="请输入学生网校账号" autocomplete="off" class="layui-input">
            </div>
            <button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>
        </div>
    </form>
    <div class="layui-form" id="table-list">
        <table class="layui-table" lay-even lay-skin="nob">
            <colgroup>
                <!-- <col width="50" class="hidden-xs"> -->
                <col width="130" class="hidden-xs">
                <col width="200">
                <col width="700">
                <col width="180">
                <col width="80">
                <col>
            </colgroup>
            <thead>
            <tr>
                <!-- <th class="hidden-xs"><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th> -->
                <th class="hidden-xs">网校账号</th>
                <th>所属网课</th>
                <th>问题描述</th>
                <th>提交时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($ask_list) || $ask_list instanceof \think\Collection || $ask_list instanceof \think\Paginator): $i = 0; $__LIST__ = $ask_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <!-- <td class="hidden-xs"><input type="checkbox" name="" lay-skin="primary" data-id="1"></td> -->
                <td class="hidden-xs"><?php echo htmlentities($vo['item2']); ?></td>
                <td><?php echo htmlentities($vo['item0']); ?></td>
                <td><?php echo htmlentities($vo['item1']); ?></td>
                <td><?php echo htmlentities($vo['add_time']); ?></td>
                <td><button class="layui-btn layui-btn-mini layui-btn-<?php if($vo['status']==1){echo 'danger';}else{echo 'shua';}?> table-list-status" data-status='<?php echo htmlentities($vo['status']); ?>' data-id="<?php echo htmlentities($vo['id']); ?>"><?php if($vo['status']==1){echo '未处理';}else{echo '已处理';}?></button></td>
                <td>
                    <div class="layui-inline">
                        <div class="layui-inline">
                            <button class="layui-btn layui-btn-small layui-btn-normal add-btn goBtn" data-url="/index.php/ask/sendSms?id=<?php echo htmlentities($vo['id']); ?>"><i class="layui-icon">&#xe615;</i></button>
                            <button class="layui-btn layui-btn-small layui-btn-danger delBtn leftBtn"  data-url="/index.php/ask/delete?id=<?php echo htmlentities($vo['id']); ?>"><i class="layui-icon">&#xe640;</i></button>
                            <button class="layui-btn layui-btn-small layui-btn-warm sendBtn uqu" data-url="/index.php/ask/sendSms?id=<?php echo htmlentities($vo['id']); ?>" data-id="<?php echo htmlentities($vo['id']); ?>"><i class="layui-icon">&#xe609;</i></button>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="page-wrap">
            <?php echo $page;?>
        </div>
    </div>
</div>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use(['form', 'jquery', 'layer', 'dialog'], function() {
        var $ = layui.jquery;
        //修改状态
        $('#table-list').on('click', '.table-list-status', function() {
            var _this = $(this);
            var status = _this.attr('data-status');
            if(status>1){
                status=1;
            }else{
                status=2;
            }
            var id = _this.attr('data-id');
            $.ajax({
                url:"<?php echo url('index/ask/stat'); ?>",
                data:{id:id,status:status},
                type:'post',
                dataType:'json',
                async: false,
                success: function (res) {
                    if(status == 2){
                        _this.removeClass('layui-btn-danger').addClass('layui-btn-shua').html('已处理').attr('data-status', 2);
                    }else{
                        _this.removeClass('layui-btn-shua').addClass('layui-btn-danger').html('未处理').attr('data-status', 1);
                    }
                }
            });
        })

        //发送信息按钮
        $(".sendBtn").on('click',function(){
            $.ajax({
                url:"<?php echo url('index/ask/sendSms'); ?>",
                data:{id:$(this).attr('data-id'),type:3},
                type:'post',
                dataType:'json',
                async: false,
                success: function (res) {
                    layer.alert(res.msg);
                }
            })
        })
    });
</script>
</body>
</html>