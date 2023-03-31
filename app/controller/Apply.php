<?php
//email：417841136@qq.com ，one-bluecat
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use app\model\Apply as applyModel;

class Apply extends BaseController
{

    public function index()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $model = new applyModel();
        $post = $this->request->param();
        if (isset($_SESSION['admin']['id']) && $_SESSION['admin']['limit'] > 1) {
            $school_id = $_SESSION['admin']['id'];
            $school_list = Db::name('admin')->where('id', '=', $school_id)->column('school_name', 'id');
            $sale_list = Db::name('sale')->where('school_id', '=', $school_id)->column('sale_name', 'id');
            $where = 'school_id=' . $school_id;
        } else {
            $school_list = Db::name('admin')->column('school_name', 'id');
            $sale_list = Db::name('sale')->column('sale_name', 'id');
            $where = '1=1';
        }
        $course_list = Db::name('course')->column('course_name', 'id');

        if (isset($post['student_phone']) and !empty($post['student_phone'])) {
            $post['student_phone'] = trim($post['student_phone']);
            $where .= " and student_phone like '%{$post['student_phone']}%'";
        }

        if (isset($post['sale_id']) and !empty($post['sale_id'])) {
            $post['sale_id'] = trim($post['sale_id']);
            $where .= " and sale_id='{$post['sale_id']}'";
        }

        if (isset($post['school_id']) and !empty($post['school_id'])) {
            $post['school_id'] = trim($post['school_id']);
            $where .= " and school_id='{$post['school_id']}'";
        }

        if (isset($post['start_time']) && isset($post['end_time']) && !empty($post['start_time']) && !empty($post['end_time'])) {
            $post['start_time'] = trim($post['start_time']);
            $where .= " and bao_time>='{$post['start_time']}' and bao_time<='{$post['end_time']}'";
        } elseif (isset($post['start_time']) && !empty($post['start_time'])) {
            $where .= " and bao_time>='{$post['start_time']}'";
        } elseif (isset($post['end_time']) && !empty($post['end_time'])) {
            $where .= " and bao_time<='{$post['end_time']}'";
        }
        if (isset($_REQUEST['export']) && $_REQUEST['export']) {

            // 需要导出的内容
            $data = $model->where($where)->order('add_time', 'desc')->select();
            // 文件名，这里都要将utf-8编码转为gbk，要不可能出现乱码现象
            $filename = date('YmdHis') . '.csv';

            // 拼接文件信息，这里注意两点
            // 1、字段与字段之间用逗号分隔开
            // 2、行与行之间需要换行符
            $fileData = '分校,咨询销售,学生姓名,学生手机,报考学科,报考学段,课程名称,缴费方式,缴费金额,缴费种类,是否邮寄,地址,其它备注,缴费时间,提交时间' . "\n";
            foreach ($data as $value) {
                $course_id_arr = explode(',', $value['course_id']);
                foreach ($course_id_arr as $courseId) {
                    $temp = array(
                        $school_list[$value['school_id']],
                        $sale_list[$value['sale_id']],
                        $value['student_name'],
                        $value['student_phone'],
                        $value['subject'],
                        $value['section'],
                        $course_list[$courseId],
                        $value['pay_type'],
                        $value['pay_amount'],
                        $value['payment_type'],
                        $value['is_send'] ? '是' : '否',
                        $value['province'] . $value['city'] . $value['town'] . $value['address'],
                        $value['memo'],
                        $value['bao_time'],
                        $value['add_time'],
                    );
                    $fileData .= implode(',', $temp) . "\n";
                }
            }

            // 头信息设置
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename);
            header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
            header('Expires:0');
            header('Pragma:public');
            echo $fileData;
            exit;
        }

        $applys = empty($where) ? $model->order('add_time desc')->paginate(10) : $model->where($where)->order('add_time', 'desc')->paginate(['list_rows' => 10, 'query' => request()->param()]);

        return view('index', [
            'applys' => $applys,
            'page' => $applys->render(),
            'school_list' => $school_list,
            'sale_list' => $sale_list,
            'course_list' => $course_list,
        ]);
    }

    public function export()
    {
        $model = new applyModel();
        $post = $this->request->param();
        $where = '1=1';
        if (isset($post['student_phone']) and !empty($post['student_phone'])) {
            $post['student_phone'] = trim($post['student_phone']);
            $where .= " and student_phone like '%{$post['student_phone']}%'";
        }
        $applys = $model->where($where)->order('id desc')->select();

        //excel daochu


    }

    public function add()
    {
        $user = isset($_SESSION['admin']) ? $_SESSION['admin'] : [];
        $school_id = $user['id'];
       
        if ($_POST) {
            $post = $_POST;
            $bili = trim($post['course_type']) == '网课' ? $user['wk_bili'] : $user['ms_bili'];
            $bili = $bili ? $bili : 0;
            if (!$post['sale_id']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择咨询销售！')));
            }
            if (!$post['student_name']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写学生姓名！')));
            }
            if (!$post['student_phone']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写学生手机！')));
            }
            if (!$post['subject']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报考学科！')));
            }
            if (!$post['section']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报考学段！')));
            }
            if (!$post['course_id']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择课程名称！')));
            }
            if (!$post['pay_type']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择缴费方式！')));
            }
            if (!$post['course_type']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择课程类型！')));
            }
            if (!$post['payment_type']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择缴费种类！')));
            }
            if (!$post['bao_time']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写缴费时间！')));
            }
            if (!$post['province'] || !$post['city'] || !$post['town'] || !$post['address']) {
                exit(json_encode(array('status' => 0, 'msg' => '请完善地址信息！')));
            }
            $add = array(
                'school_id' => $school_id,
                'sale_id' => isset($post['sale_id']) ? trim($post['sale_id']) : 0,
                'student_name' => trim($post['student_name']),
                'student_phone' => trim($post['student_phone']),
                'subject' => trim($post['subject']),
                'section' => trim($post['section']),
                'course_id' => $post['course_id'] ? implode(',', $post['course_id']) : 0,
                'pay_type' => trim($post['pay_type']),
                'pay_amount' => trim($post['pay_amount']),
                'payment_type' => trim($post['payment_type']),
                'course_type' => trim($post['course_type']),
                'bili' => $bili,
                'is_send' => isset($post['is_send']) ? 1 : 0,
                'bao_time' => trim($post['bao_time']),
                'memo' => trim($post['memo']),
                'province' => trim($post['province']),
                'city' => trim($post['city']),
                'town' => trim($post['town']),
                'address' => trim($post['address']),
                'add_time' => date('Y-m-d H:i:s')
            );
            $insert = Db::name('apply')->insert($add);
            if ($insert > 0) {
                exit(json_encode(array('status' => 1, 'msg' => '添加成功')));
            } else {
                exit(json_encode(array('status' => 0, 'msg' => '添加失败')));
            }
        }
        if (isset($_SESSION['admin']['id']) && ($_SESSION['admin']['limit'] > 1)) {
            $school_id = $_SESSION['admin']['id'];
            $sale_list = Db::name('sale')->where('school_id', '=', $school_id)->column('sale_name', 'id');
        } else {
            $sale_list = Db::name('sale')->column('sale_name', 'id');
        }
        $course_list = Db::name('course')->select();
        $province_list = Db::name('city')->where('parent_id', '=', 0)->column('name', 'id');
        return view('add', ['course_list' => $course_list, 'sale_list' => $sale_list, 'province_list' => $province_list]);
    }

    public function edit()
    {
        if ($_POST) {
            $post = $_POST;
            $user = isset($_SESSION['admin']) ? $_SESSION['admin'] : [];
            $bili = trim($post['course_type']) == '网课' ? $user['wk_bili'] : $user['ms_bili'];
            $bili = $bili ? $bili : 0;

            if (!$post['student_name']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写学生姓名！')));
            }
            if (!$post['student_phone']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写学生手机！')));
            }
            if (!$post['subject']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报考学科！')));
            }
            if (!$post['section']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报考学段！')));
            }
            if (!$post['course_id']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择课程名称！')));
            }
            if (!$post['pay_type']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择缴费方式！')));
            }
            if (!$post['course_type']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择课程类型！')));
            }
            if (!$post['payment_type']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择缴费种类！')));
            }
            if (!$post['bao_time']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写缴费时间！')));
            }
            if (!$post['province'] || !$post['city'] || !$post['town'] || !$post['address']) {
                exit(json_encode(array('status' => 0, 'msg' => '请完善地址信息！')));
            }

            $update = array(
                'student_name' => trim($post['student_name']),
                'student_phone' => trim($post['student_phone']),
                'subject' => trim($post['subject']),
                'section' => trim($post['section']),
                'course_id' => $post['course_id'] ? implode(',', $post['course_id']) : 0,
                'pay_type' => trim($post['pay_type']),
                'pay_amount' => trim($post['pay_amount']),
                'payment_type' => trim($post['payment_type']),
                'course_type' => trim($post['course_type']),
                //'bili' => $bili,
                'is_send' => isset($post['is_send']) ? 1 : 0,
                'memo' => trim($post['memo']),
                'province' => trim($post['province']),
                'city' => trim($post['city']),
                'town' => trim($post['town']),
                'address' => trim($post['address']),
                'bao_time' => trim($post['bao_time']),
            );
            $insert = Db::name('apply')->where('id', '=', $post['id'])->update($update);
            if ($insert !== false) {
                exit(json_encode(array('status' => 1, 'msg' => '修改成功')));

            } else {
                exit(json_encode(array('status' => 1, 'msg' => '修改失败')));
            }
        }
        $id = $_REQUEST['id'];
        $detail = Db::name('apply')->where('id', '=', $id)->find();




        $course_list = Db::name('course')->column('course_name', 'id');
        $province_list = Db::name('city')->where('parent_id', '=', 0)->column('name', 'id');

        $findProvince = Db::name('city')->where('name', '=', $detail['province'])->where('parent_id', '=', 0)->find();
        $city_list = Db::name('city')->where('parent_id', '=', $findProvince['id'])->column('name', 'id');

        $city = $detail['city'];
        $findCity = Db::name('city')->where('name', '=', $city)->where('parent_id', '=', $findProvince['id'])->find();
        $town_list = Db::name('city')->where('parent_id', '=', $findCity['id'])->column('name', 'id');

        return view('edit', ['detail' => $detail, 'course_list' => $course_list, 'province_list' => $province_list, 'city_list' => $city_list, 'town_list' => $town_list]);
    }

    /**
     *校验数据是否已提交
     */
    public function check()
    {
        $sale_list = Db::name('sale')->column('sale_name', 'id');
        $school_list = Db::name('admin')->column('school_name', 'id');
        $student_phone = $_POST['student_phone'];
        $start = date('Y-m-d', strtotime($_POST['bao_time']));
        $end = date('Y-m-d', strtotime($start) + 86400);
        $flag = false;
        $select = array();
        $course_id_arr = explode(',', $_POST['course_id'][0]);
        foreach ($course_id_arr as $course_id) {
            $find = Db::name('apply')->whereBetweenTime('bao_time', $start, $end)->where('course_id', '=', $course_id)->where('student_phone', '=', $student_phone)->find();
            if ($find) {
                $flag = true;
                $select = $find;
            }
        }
        if ($flag) {
            exit(json_encode(array('status' => 1, 'msg' => '同一天此条报名信息有【' . $school_list[$select['school_id']] . '】 - 【' . $sale_list[$select['sale_id']] . '】 提交是否继续？')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '记录不存在')));
        }
    }

    /**发送钉钉信息
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function notify()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $find = Db::name('apply')->where('id', '=', $id)->find();
        $school_list = Db::name('admin')->column('school_name', 'id');
        $sale_list = Db::name('sale')->column('sale_name', 'id');
        if ($type == 1) {
            $message = "【报名信息需求】 {$school_list[$find['school_id']]}-{$sale_list[$find['sale_id']]} 提交了一条（{$find['student_name']}）的报名信息需要开通课程！";
        } else {
            $message = "【报名信息成功】 {$school_list[$find['school_id']]}-{$sale_list[$find['sale_id']]} 提交（{$find['student_name']}）的开课信息已处理！";
        }
        $data = array('msgtype' => 'text', 'text' => array('content' => $message));
        $data_string = json_encode($data);
        $response = ding_notify_info($data_string);
        $response = json_decode($response,true);
        if($response['errcode'] === 0){
            exit(json_encode(array('status' => 1,'msg'=>'发送成功！')));
        }else{
            exit(json_encode(array('status' => 0,'msg'=>'发送失败！')));
        }
    }

    public function view()
    {
        $id = $_REQUEST['id'];
        $detail = Db::name('apply')->where('id', '=', $id)->find();
        $sale_list = Db::name('sale')->column('sale_name', 'id');
        $course_list = Db::name('course')->column('course_name', 'id');
        return view('view', ['detail' => $detail, 'sale_list' => $sale_list, 'course_list' => $course_list]);
    }

    public function delete()
    {
        $id = $_REQUEST['id'];
        $re = Db::name('apply')->where('id', '=', $id)->delete();
        if ($re) {
            exit(json_encode(array('status' => 1, 'msg' => '删除成功')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '删除失败')));
        }
    }

    /**
     * 获取城市信息
     */
    public function getCityInfo()
    {
        $province = $_REQUEST['province'];
        $find = Db::name('city')->where('name', '=', $province)->where('parent_id', '=', 0)->find();
        $re = Db::name('city')->where('parent_id', '=', $find['id'])->select();
        if ($re) {
            exit(json_encode(array('status' => 1, 'data' => $re, 'msg' => '成功')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '失败')));
        }
    }

    /**
     * 获取城市信息
     */
    public function getTownInfo()
    {
        $province = $_REQUEST['province'];
        $city = $_REQUEST['city'];
        $findProvince = Db::name('city')->where('name', '=', $province)->where('parent_id', '=', 0)->find();
        $find = Db::name('city')->where('name', '=', $city)->where('parent_id', '=', $findProvince['id'])->find();
        $re = Db::name('city')->where('parent_id', '=', $find['id'])->select();
        if ($re) {
            exit(json_encode(array('status' => 1, 'data' => $re, 'msg' => '成功')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '失败')));
        }
    }
}
