<?php /*a:1:{s:52:"/www/wwwroot/wx.shichuedu.com/view/ask/feed_back.php";i:1608365787;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>师出网校学习提问</title>
    <link rel="shortcut icon" href="http://zw.shichuedu.com/resources/images/favicon.ico">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="../../static/admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../static/admin/css/paper-bootstrap-wizard.css" rel="stylesheet" />
    <!-- Fonts and Icons -->
    <link href="../../static/admin/css/font-awesome.css" rel="stylesheet">
    <link href='../../static/admin/css/family_mall.css' rel='stylesheet' type='text/css'>
    <link href="../../static/admin/css/themify-icons.css" rel="stylesheet">
</head>
<body>
<div class="image-container set-full-height" style="background-image: url('../../static/admin/images/paper-3.png')">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="azure" id="wizard">
                        <form name="myform"  id="myform" action="" method="post" onsubmit="return check_form();">
                            <div class="wizard-header">
                                <h3 class="wizard-title"><img src="http://v.shichuedu.com/UploadFiles/2018/75/Y131790299598031.png"></h3>
                                <h3 class="wizard-title">学习提问答疑平台</h3>
                            </div>

                            <div class="wizard-navigation">
                                <div class="progress-with-circle">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                </div>
                                <ul>
                                    <li>
                                        <a href="#details" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-mobile"></i>
                                            </div>
                                            手机号码
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#captain" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-book"></i>
                                            </div>
                                            所属课程
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#description" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-pencil"></i>
                                            </div>
                                            问题详情
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane" id="details">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="info-text">请填写接收回复手机号</h5>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-4">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="item2" id="item2">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <h5 class="info-text">我们将短信通知(确保无误，提交后将不能修改)</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="captain">
                                    <h5 class="info-text">选择问题所属课程</h5>
                                    <div class="row">
                                        <div class="col-sm-5 col-sm-offset-4">
                                            <div class="form-group">
                                                <select class="form-control" name="item0" id="item0">
                                                    <option disabled="" selected="">- 请点击选择课程 -</option>
                                                    <option>教综系列课程</option>
                                                    <option>语文专业系列</option>
                                                    <option>数学专业系列</option>
                                                    <option>英语专业系列</option>
                                                    <option>音乐专业系列</option>
                                                    <option>体育专业系列</option>
                                                    <option>美术专业系列</option>
                                                    <option>信息专业系列</option>
                                                    <option>科学专业系列</option>
                                                    <option>政治专业系列</option>
                                                    <option>历史专业系列</option>
                                                    <option>地理专业系列</option>
                                                    <option>物理专业系列</option>
                                                    <option>化学专业系列</option>
                                                    <option>生物专业系列</option>
                                                    <option>资格证笔试系列</option>
                                                    <option>幼教笔试系列</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <h5 class="info-text">未列出种类暂不支持问答</h5>
                                            <h5 class="info-text">解答仅限题目问答，其他问题请联系咨询报名老师</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="description">
                                    <div class="row">
                                        <h5 class="info-text">课程问题描述（提交非题目问答将被限制）</h5>
                                        <div class="col-sm-6 col-sm-offset-1">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="9" name="item1" id="item1"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>注意:</label>
                                                <p class="description">请详细填写问题和选项，如果题目包含在网课中，需要描述具体课程名称第几课时，出现时间，什么问题等；如果问题出现在师出教材资料中，请输入资料名称出现页数行数和具体问题；如果以上均没有请输入完整题目，请勿重复提交！因为描述不清无法回复尽请谅解！</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='下一步'/>
                                    <input type='submit' class='btn btn-finish btn-fill btn-primary btn-wd' name="submit1" value='提交' />
                                </div>
                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='上一步' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../../static/admin/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="../../static/admin/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../static/admin/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<script src="../../static/admin/js/paper-bootstrap-wizard.js" type="text/javascript"></script>
<script src="../../static/admin/js/jquery.validate.min.js" type="text/javascript"></script>
</html>
<script>
    function check_form(){
        var item2 = $("#item2").val();
        var item0 = $("#item0").val();
        var item1 = $("#item1").val();
        $.ajax({
            url:"<?php echo url('index/ask/feed_back'); ?>",
            data:{item2:item2,item0:item0,item1:item1},
            type:'post',
            dataType:'json',
            async: false,
            success: function (res) {
                    alert(res.msg);
                    window.location.href="http://v.shichuedu.com";
            }
        })
        return false;
    }
</script>
