<?php

namespace app\controller;

use app\BaseController;
use app\model\Ask as askModel;
use think\facade\Db;

class Ask extends BaseController
{
    public function index()
    {
        $model = new askModel();
        $where = 'is_del=0';
        if (isset($post['student_phone']) and !empty($post['student_phone'])) {
            $post['student_phone'] = trim($post['student_phone']);
            $where .= " and item2 like '%{$post['student_phone']}%'";
        }
        $askList = empty($where) ? $model->order('add_time desc')->paginate(10) : $model->where($where)->order('add_time desc')->paginate(['list_rows'=>10,'query'=>request()->param()]);
        return view('index', [
            'ask_list' => $askList,
            'page' => $askList->render(),
        ]);
    }

    /**发送短信
     * @return \think\response\View
     */
    public function sendSms()
    {
        if ($_POST) {
            $post = $_POST;
            $id = $post['id'];
            $type = $post['type'];
            $detail = Db::name('ask')->where('id', '=', $id)->find();
            $content = isset($post['reply_content']) ? $post['reply_content'] : "";
            $phone = isset($detail['item2']) ? $detail['item2'] : "";
            $current_day = date('Y-m-d');
           $next_day =  date('Y-m-d',strtotime('+1 day'));
           
            if($type == 3){
                $find = Db::name('ask')->where('id', '=', $id)->find();
                $phone = $find['item2'];
                $count = Db::name('sms')->where('phone', '=', $phone)->where('add_time','>=',$current_day)->where('add_time','<',$next_day)->count();
                if($count>=3){
                    exit(json_encode(array('status' => 0, 'msg' => '短信发送失败！一天最多只能发送3条短信！')));
                }
                $result = send_sms($phone, "您在师出网校提交的问题不属于课程题目，其他疑问请联系报名老师解答。");
                if ($result['sms_code'] > 0) {
                    Db::name('sms')->insert(array('phone'=>$phone,'content'=>"您在师出网校提交的问题不属于课程题目，其他疑问请联系报名老师解答。",'add_time'=>date('Y-m-d H:i:s')));
                    exit(json_encode(array('status' => 1, 'msg' => '短信发送成功')));
                } else {
                    exit(json_encode(array('status' => 0, 'msg' => '短信发送失败')));
                }
            }else{
                if ($phone && $content) {
                    $count = Db::name('sms')->where('phone', '=', $phone)->where('add_time','>=',$current_day)->where('add_time','<',$next_day)->count();
                    if($count>=3){
                        exit(json_encode(array('status' => 0, 'msg' => '短信发送失败！一天最多只能发送3条短信！')));
                    }
                    $response = "您在师出网校提交的问题回答如下：" . $content;
                    $update = array();
                    if ($type == 2) {
                        $update['reply_content'] = $content;
                        $result = Db::name('ask')->where('id', '=', $id)->update($update);
                        if ($result) {
                            Db::name('sms')->insert(array('phone'=>$phone,'content'=>$response,'add_time'=>date('Y-m-d H:i:s')));
                            exit(json_encode(array('status' => 1, 'msg' => '保存成功')));
                        } else {
                            exit(json_encode(array('status' => 0, 'msg' => '保存失败')));
                        }
                    } elseif ($type == 1) {
                        $update['reply_content'] = $content;
                        $update['status'] = 2;
                        Db::name('ask')->where('id', '=', $id)->update($update);
                        $result = send_sms($phone, $response);
                        if ($result['sms_code'] > 0) {
                            Db::name('sms')->insert(array('phone'=>$phone,'content'=>$response,'add_time'=>date('Y-m-d H:i:s')));
                            exit(json_encode(array('status' => 1, 'msg' => '短信发送成功')));
                        } else {
                            exit(json_encode(array('status' => 0, 'msg' => '短信发送失败')));
                        }
                    }
                }else{
                    exit(json_encode(array('status' => 0, 'msg' => '短信发送失败')));
                }
            }
        } else {
            $id = $_REQUEST['id'];
            $detail = Db::name('ask')->where('id', '=', $id)->find();
            return view('edit', ['detail' => $detail]);
        }
    }

    /**提交状态
     * @throws \think\db\exception\DbException
     */
    public function stat()
    {
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        $result = Db::name('ask')->where('id', '=', $id)->update(['status' => $status]);
        if ($result !== false) {
            exit(json_encode(array('status' => 1, 'msg' => '修改成功')));
        } else {
            exit(json_encode(array('status' => 1, 'msg' => '修改失败')));
        }
    }

    public function delete()
    {
        $id = $_REQUEST['id'];
        $re = Db::name('ask')->where('id', '=', $id)->update(['is_del' => 1]);
        if ($re) {
            exit(json_encode(array('status' => 1, 'msg' => '删除成功')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '删除失败')));
        }
    }

    /*
     * 前台反馈问题
     */
    public function feed_back()
    {
        if ($_POST) {
            $post = $_POST;
            $item0 = $post['item0'];
            $item1 = $post['item1'];
            $item2 = $post['item2'];
            $start = date('Y-m-d');
            $end = date('Y-m-d', strtotime('+1 day'));

            //校验手机号码
            preg_match('/^(13|14|15|16|17|18|19)\d{9}$/', $item2, $phoneArr);
            if (!isset($phoneArr[0])) {
                exit(json_encode(array('status' => 1, 'msg' => '请填写正确接收回复手机号!')));
            }

            //校验选择课程
            if (!$item0) {
                exit(json_encode(array('status' => 1, 'msg' => '请选择课程!')));
            }
            if (!$item1) {
                exit(json_encode(array('status' => 1, 'msg' => '请输入具体问题!')));
            }

            $post_times = Db::name('ask')->whereTime('add_time', 'between', [$start, $end])->where('item2', '=', $item2)->count();
            if ($post_times > 1) {
                exit(json_encode(array('status' => 1, 'msg' => '亲!一天提交只能提交1次哦!')));
            }
            $item1 = addslashes($item1);
            $ip = get_client_ip();
            $addData = array(
                'item0' => $item0,
                'item1' => $item1,
                'item2' => $item2,
                'ip' => $ip,
                'add_time' => date('Y-m-d H:i:s'),
            );
            $insertId = Db::name('ask')->insert($addData);
            if ($insertId) {
                exit(json_encode(array('status' => 1, 'msg' => '提交成功')));
            } else {
                exit(json_encode(array('status' => 0, 'msg' => '提交失败')));
            }
        }
        return view('feed_back');
    }
}
