<?php

namespace app\controller;

use think\facade\Db;

class Admin
{
    public function index()
    {
        $user = array();
        session_start();
        if(isset($_SESSION['admin'])){
            $user = $_SESSION['admin'];
        }
        $school_list = Db::name('admin')->column('school_name', 'id');
        return view('index', ['detail' => $user,'school_list'=>$school_list]);
    }

    public function updatePassword(){
        $user = array();
        session_start();
        if(isset($_SESSION['admin'])){
            $user = $_SESSION['admin'];
        }
        $post = $_POST;
        $old_password = $post['old_password'];
        $new_password = $post['new_password'];
        $confirm_password = $post['confirm_password'];
        if(!$old_password){
            exit(json_encode(array('status' => 0, 'msg' => '旧密码不能为空!')));
        }
        if(!$new_password){
            exit(json_encode(array('status' => 0, 'msg' => '新密码不能为空!')));
        }
        if($confirm_password!=$new_password){
            exit(json_encode(array('status' => 0, 'msg' => '两次密码不一样!')));
        }
        if(isset($_SESSION['admin']['password']) && md5(trim($old_password))!=$_SESSION['admin']['password']){
            exit(json_encode(array('status' => 0, 'msg' => '旧密码不正确!')));
        }
        $new_password = md5(trim($new_password));
        $res = Db::name('admin')->where('id','=',$user['id'])->update(['password'=>$new_password]);
        if($res!==false){
            $find = Db::name('admin')->where('id', '=', $user['id'])->find();
            $_SESSION['admin'] = $find;
            exit(json_encode(array('status' => 0, 'msg' => '密码修改成功!')));
        }else{
            echo Db::name('admin')->getLastSql();
            dump($res);
            exit;
            exit(json_encode(array('status' => 0, 'msg' => '密码修改失败!')));
        }

    }

    public function login()
    {
        if ($_POST) {
            $school_id = trim($_POST['school_id']);
            $password = md5(trim($_POST['password']));
            $find = Db::name('admin')->where('id', '=', $school_id)->find();
            if ($find['password'] == $password) {
                //登录信息放到session
                session_start();
                $_SESSION['admin'] = $find;
                exit(json_encode(array('status' => 1, 'msg' => '登录成功', 'link' => '/index.php/index')));
            } else {
                exit(json_encode(array('status' => 0, 'msg' => '密码错误！登录失败')));
            }
        }
        $list = Db::name('admin')->select();
        return view('login', [
            'list' => $list,
        ]);
    }


    public function login_out(){
        session_start();
        $_SESSION['admin'] = null;
        echo "<script>window.location.href='/index.php/admin/login'</script>";
    }
}
