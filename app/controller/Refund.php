<?php
//email：417841136@qq.com ，one-bluecat
namespace app\controller;
use think\facade\Db;
use app\BaseController;
use app\model\Refund as refundModel;

class Refund extends BaseController
{
    public function index()
    {
        $model = new refundModel();
        $post = $this->request->param();
        if (isset($_SESSION['admin']['id']) && $_SESSION['admin']['limit'] > 1) {
            $school_id = $_SESSION['admin']['id'];
            $school_list = Db::name('admin')->where('id', '=', $school_id)->column('school_name', 'id');
            $sale_list = Db::name('sale')->where('school_id', '=', $school_id)->column('sale_name', 'id');
            $where = 'school_id='.$school_id;
        } else {
            $school_list = Db::name('admin')->column('school_name', 'id');
            $sale_list = Db::name('sale')->column('sale_name', 'id');
            $where = '1=1';
        }

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
            $where .= " and add_time>='{$post['start_time']}' and add_time<='{$post['end_time']}'";
        }elseif (isset($post['start_time']) && !empty($post['start_time'])){
            $where .= " and add_time>='{$post['start_time']}'";
        }elseif (isset($post['end_time']) && !empty($post['end_time'])){
            $where .= " and add_time<='{$post['end_time']}'";
        }
        $course_list = Db::name('course')->column('course_name', 'id');
        if(isset($_REQUEST['export']) && $_REQUEST['export']){

            // 需要导出的内容
            $data =$model->where($where)->order('add_time desc')->select();
            // 文件名，这里都要将utf-8编码转为gbk，要不可能出现乱码现象
            $filename = date('YmdHis').'.csv';

            // 拼接文件信息，这里注意两点
            // 1、字段与字段之间用逗号分隔开
            // 2、行与行之间需要换行符
            $fileData = '分校,咨询销售,学生姓名,学生手机,报考学科,报考学段,课程名称,退费原因,退费金额,是否处理,提交时间' . "\n";
            foreach ($data as $value) {
                $course_id_arr = explode(',',$value['course_id']);
                foreach ($course_id_arr as $courseId){
                    $temp = array(
                        $school_list[$value['school_id']],
                        $sale_list[$value['sale_id']],
                        $value['student_name'],
                        $value['student_phone'],
                        $value['subject'],
                        $value['section'],
                        $course_list[$courseId],
                        $value['reason'],
                        $value['pay_amount'],
                        $value['state']?'已提交':'已确认',
                        $value['add_time'],
                    );
                    $fileData .= implode(',',$temp) . "\n";
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

        $applys = empty($where) ? $model->order('add_time desc')->paginate(10) : $model->where($where)->order('add_time desc')->paginate(['list_rows'=>10,'query'=>request()->param()]);

        return view('index', [
            'applys' => $applys,
            'page' => $applys->render(),
            'school_list'=>$school_list,
            'sale_list'=>$sale_list,
            'course_list'=>$course_list,
        ]);
    }

    public function add()
    {
        $user = $_SESSION['admin'];
        $school_id =$user['id'];
        if ($_POST) {
            $post = $_POST;
            if(!$post['sale_id']){
                exit(json_encode(array('status' => 0, 'msg' => '请选择咨询销售！')));
            }
            if (!$post['student_name']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写学生姓名！')));
            }
            if (!$post['student_phone']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写手机账号！')));
            }
            if (!$post['subject']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报考学科！')));
            }
            if (!$post['section']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报考学段！')));
            }
            if (!$post['course_id']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报名课程！')));
            }
            if (!$post['pay_amount']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写退费金额！')));
            }

            if (!$post['reason']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写退费原因！')));
            }
            $add = array(
                'school_id' => $school_id,
                'sale_id' => isset($post['sale_id'])?trim($post['sale_id']):0,
                'student_name' => trim($post['student_name']),
                'student_phone' => trim($post['student_phone']),
                'subject' => trim($post['subject']),
                'section' => trim($post['section']),
                'course_id' => $post['course_id']?implode(',',$post['course_id']):0,
                'pay_amount' => trim($post['pay_amount']),
                'reason' => trim($post['reason']),
                'add_time' => date('Y-m-d H:i:s'),
                'state' => trim(1),
            );

            $insert = Db::name('refund')->insert($add);
            if ($insert > 0) {
                exit(json_encode(array('status' => 1, 'msg' => '添加成功')));
            } else {
                exit(json_encode(array('status' => 0, 'msg' => '添加失败')));
            }
        }
        $course_list = Db::name('course')->select();
        if (isset($_SESSION['admin']['id']) && ($_SESSION['admin']['limit'] > 1)) {
            $school_id = $_SESSION['admin']['id'];
            $sale_list = Db::name('sale')->where('school_id', '=', $school_id)->column('sale_name', 'id');
        } else {
            $sale_list = Db::name('sale')->column('sale_name', 'id');
        }
        return view('add',['course_list'=>$course_list,'sale_list'=>$sale_list]);
    }


    public function edit()
    {
        if($_POST){
            $post = $_POST;
            if(!$post['sale_id']){
                exit(json_encode(array('status' => 0, 'msg' => '请选择咨询销售！')));
            }
            if (!$post['student_name']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写学生姓名！')));
            }
            if (!$post['student_phone']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写手机账号！')));
            }
            if (!$post['subject']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报考学科！')));
            }
            if (!$post['section']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报考学段！')));
            }
            if (!$post['course_id']) {
                exit(json_encode(array('status' => 0, 'msg' => '请选择报名课程！')));
            }
            if (!$post['pay_amount']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写退费金额！')));
            }
            if (!$post['reason']) {
                exit(json_encode(array('status' => 0, 'msg' => '请填写退费原因！')));
            }
            $update = array(
                'sale_id' => isset($post['sale_id'])?trim($post['sale_id']):0,
                'student_name' => trim($post['student_name']),
                'student_phone' => trim($post['student_phone']),
                'subject' => trim($post['subject']),
                'section' => trim($post['section']),
                'course_id' => $post['course_id']?implode(',',$post['course_id']):0,
                'pay_amount' => trim($post['pay_amount']),
                'reason' => trim($post['reason']),
                'add_time' => date('Y-m-d H:i:s'),
                'state' => isset($post['state']) ? 1 : 2,
            );
            $insert = Db::name('refund')->where('id','=',$post['id'])->update($update);
            if ($insert!==false) {
                exit(json_encode(array('status' => 1, 'msg' => '修改成功')));
            } else {
                exit(json_encode(array('status' => 1, 'msg' => '修改失败')));
            }
        }else{
            $id = $_REQUEST['id'];
            $detail = Db::name('refund')->where('id', '=', $id)->find();
            if (isset($_SESSION['admin']['id']) && ($_SESSION['admin']['limit'] > 1)) {
                $school_id = $_SESSION['admin']['id'];
                $sale_list = Db::name('sale')->where('school_id', '=', $school_id)->column('sale_name', 'id');
            } else {
                $sale_list = Db::name('sale')->column('sale_name', 'id');
            }
            $course_list = Db::name('course')->column('course_name', 'id');
            return view('edit',['detail'=>$detail,'sale_list'=>$sale_list,'course_list'=>$course_list]);
        }

    }

    public function view()
    {
        $id = $_REQUEST['id'];
        $detail = Db::name('refund')->where('id', '=', $id)->find();
		$course_list = Db::name('course')->column('course_name', 'id');
        return view('view',['detail'=>$detail,'course_list'=>$course_list]);
    }

    public function delete()
    {
        $id = $_REQUEST['id'];
        $re = Db::name('refund')->where('id', '=', $id)->delete();
        if($re){
            exit(json_encode(array('status'=>1,'msg'=>'删除成功')));
        }else{
            exit(json_encode(array('status'=>0,'msg'=>'删除失败')));
        }
    }

    /**更改状态
     * @throws \think\db\exception\DbException
     */
    public function stat(){
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        $result = Db::name('refund')->where('id', '=', $id)->update(['state'=>$status]);
        if ($result!==false) {
            exit(json_encode(array('status' => 1, 'msg' => '修改成功')));
        } else {
            exit(json_encode(array('status' => 1, 'msg' => '修改失败')));
        }
    }
}
