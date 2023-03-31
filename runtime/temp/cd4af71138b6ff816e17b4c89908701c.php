<?php /*a:1:{s:50:"/www/wwwroot/wx.shichuedu.com/view/admin/login.php";i:1606094140;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>师出网校管理后台登录</title>
		<link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
		<link rel="stylesheet" type="text/css" href="../../static/admin/css/login.css" />

        <script type="text/javascript" src="../../static/admin/js/jquery.min.js"></script>
        <script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>


	</head>
	<body>
			<div class="m-login">
				<h3><img src="../../static/admin/images/logo.png"  alt="师出网校" /><br/>网校管理系统登录</h3>
				<div class="m-login-warp">
						<div class="layui-form-item">
							<select name="school_id" class="layui-input">
									<option value="">请选择一个分校</option>
									<?php
                                    foreach($list as $value){
                                    ?><option value="<?php echo htmlentities($value['id']); ?>"><?php echo htmlentities($value['school_name']); ?></option>
                                    <?php }
							?>
                            </select>
						</div>
                        <div class="layui-form-item">
                            <label class="layadmin-user-login-icon layui-icon layui-icon-username"><i class="fa fa-user"></i></label>
                            <input type="password" name="password"  placeholder="密码" class="layui-input">
                        </div>
						<div class="layui-form-item m-login-btn">
							<div class="layui-inline">
								<button class="layui-btn layui-btn-denglu" onclick="ajaxLogin();" id="submit">登录</button>
							</div>
							<div class="layui-inline">
								<button type="reset" class="layui-btn layui-btn-primary">取消</button>
							</div>
						</div>
				</div>
				<p class="copyright">Poword by <a href="http://v.shichuedu.com"><i>v.shichuedu.com</i></a></p>
			</div>
            <script src='../../static/admin/js/zrveeq.js'></script>
            <script src="../../static/admin/js/script.js"></script>
		<script>
            		$(document).keypress(function(e) {  
            
                   if((e.keyCode || e.which)==13) {  
                       $("#submit").click();  //login_btn登录按钮的id
                   }  
            
               });
		
            function ajaxLogin(){
                if(!$('[name="school_id"]').val()){
                    alert('请选择校区');
                    return  false;
                }
                if(!$('[name="password"]').val()){
                    alert('请输入密码');
                    return  false;
                }
                $.ajax({
                    url:"<?php echo url('index/admin/login'); ?>",
                    data:{school_id:$('[name="school_id"]').val(),password:$('[name="password"]').val()},
                    type:'post',
                    dataType:'json',
                    async: false,
                    success: function (res) {
                        if(res.status==1){
                            $("#submit").val('正在登陆');
                            window.location.href= res.link;
                        }else{
                            alert(res.msg);
                        }
                    }
                });
            }
		</script>
	</body>
</html>
