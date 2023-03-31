<?php
//email：417841136@qq.com ，one-bluecat
namespace app\controller;

use app\BaseController;
use think\facade\Db;

class Index extends BaseController
{
    public function index()
    {
        error_reporting(0);
        //报名信息
        $current_day = date('Y-m-d');
        $allcurrent_day = "2021-06-01";
        $next_day = date('Y-m-d', strtotime('+1 day'));
        $apply_list = Db::query("select count(*) as apply_num from apply where add_time>='{$current_day}' and add_time<'{$next_day}'");

        //单独邮寄
        $address_list = Db::query("select count(*) as address_num from address where add_time>='{$current_day}' and add_time<'{$next_day}'");

        //退费登记
        $refund_list = Db::query("select count(*) as refund_num from refund where add_time>='{$current_day}' and add_time<'{$next_day}'");

        //开课登记
        $open_list = Db::query("select count(*) as open_num from `open` where add_time>='{$current_day}' and add_time<'{$next_day}'");
        $allopen_list = Db::query("select count(*) as open_num from `open` where add_time>='{$allcurrent_day}' and add_time<'{$current_day}'");

        //营业额管理
        $money_list = Db::query("select count(*) as money_num from `money` where add_time>='{$current_day}' and add_time<'{$next_day}'");

        //提问管理
        $ask_list = Db::query("select count(*) as ask_num from `ask` where add_time>='{$current_day}' and add_time<'{$next_day}'");

        return view('index', [
            'apply_num' => $apply_list[0]['apply_num'] ? $apply_list[0]['apply_num'] : 0,
            'address_num' => $address_list[0]['address_num'] ? $address_list[0]['address_num'] : 0,
            'refund_num' => $refund_list[0]['refund_num'] ? $refund_list[0]['refund_num'] : 0,
            'open_num' => $open_list[0]['open_num'] ? $open_list[0]['open_num'] : 0,
            'money_num' => $money_list[0]['money_num'] ? $money_list[0]['money_num'] : 0,
            'ask_num' => $ask_list[0]['ask_num'] ? $ask_list[0]['ask_num'] : 0,
            
        ]);

    }

    /**
     * 导出
     */
    public function export()
    {
        $filename = date('YmdHis') . '.csv';
        $course_list = Db::name('course')->column('course_name', 'id');
        $current_day = $_REQUEST['start_time'] ? $_REQUEST['start_time'] : date('Y-m-d');
        $end_day = $_REQUEST['end_time'] ? $_REQUEST['end_time'] : date('Y-m-d', strtotime('+1 day'));
        $where = "add_time>='{$current_day}' and add_time<'{$end_day}' and is_send=1";
        $apply_data = Db::name('apply')->where($where)->order('id desc')->select();
        $fileData = '订单号,代收金额,收件人姓名,收件人手机,收件人电话,收件人地址,收件人单位,品名,数量,买家备注,卖家备注' . "\n";
        foreach ($apply_data as $value) {
            $course_id_arr = explode(',', $value['course_id']);
            $course_name_arr = array();
            foreach ($course_id_arr as $course_id) {
                $course_name_arr[] = $course_list[$course_id];
            }
            $product = $value['section'] . $value['subject'] . implode(';', $course_name_arr) . ';' . $value['memo'];
            $temp = array(
                '',
                '',
                $value['student_name'],
                $value['student_phone'],
                '',
                $value['province'] . $value['city'] . $value['town'] . $value['address'],
                '',
                $product,
                '',
                '',
                '',
            );
            $fileData .= implode(',', $temp) . "\n";
        }

        $where_address = "add_time>='{$current_day}' and add_time<'{$end_day}'";
        $address_data = Db::name('address')->where($where_address)->order('id desc')->select();
        foreach ($address_data as $value) {
            $temp = array(
                '',
                '',
                $value['student_name'],
                $value['student_phone'],
                '',
                $value['province'] . $value['city'] . $value['town'] . $value['address'],
                '',
                $value['goods'],
                '',
                '',
                '',
            );
            $fileData .= implode(',', $temp) . "\n";
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

    public function welcome()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        //获取上个月的总营业额
        $last_month = date('Y-m-01', strtotime('-1 month'));
        $current_month = date('Y-m-01');
        $last_list = Db::query("select sum(pay_amount*bili) as income from apply where bao_time>='{$last_month}' and bao_time<'{$current_month}'");
        //营业额
        $last_money_list = Db::query("select sum(pay_amount) as income from money where add_time>='{$last_month}' and add_time<'{$current_month}'");
        //结算金额
        $last_open_list = Db::query("select sum(pay_amount) as income from `open` where add_time>='{$last_month}' and add_time<'{$current_month}'");

        //获取本月的总营业额
        $last_day = date('Y-m-d', strtotime('+1 day'));
        $list = Db::query("select sum(pay_amount*bili) as income from apply where bao_time>='{$current_month}' and bao_time<'{$last_day}'");
        //营业额
        $money_list = Db::query("select sum(pay_amount) as income from money where add_time>='{$current_month}' and add_time<'{$last_day}'");
        //结算金额
        $open_list = Db::query("select sum(pay_amount) as income from `open` where add_time>='{$current_month}' and add_time<'{$last_day}'");

        //当日报名提交数
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $current_day = date('Y-m-d');
        $last_apply_list = Db::query("select count(*) as apply_num from apply where add_time>='{$yesterday}' and add_time<'{$current_day}'");
        $apply_list = Db::query("select count(*) as apply_num from apply where add_time>='{$current_day}' and add_time<'{$last_day}'");

        //当月提问数
        $last_ask_list = Db::query("select count(*) as ask_num from ask where add_time>='{$last_month}' and add_time<'{$current_month}'");
        $ask_list = Db::query("select count(*) as ask_num from ask where add_time>='{$current_month}' and add_time<'{$last_day}'");

        //最新提交问题
        $ask_lists = Db::query("select * from ask order by id desc limit 6");


        //php版本
        $system = array();
        $system['php'] = PHP_VERSION;
        //操作系统
        $system['win'] = PHP_OS;
        //服务器域名
        $system['server'] = $_SERVER['SERVER_NAME'];
        //服务器IP地址
        $system['ip'] = get_client_ip();
        //数据库的版本
        $mysql_info = \think\facade\Db::query("select VERSION() as versions");
        $system['mysql_version'] = $mysql_info[0]['versions'];
        //环境
        $sapi = php_sapi_name();
        if ($sapi = 'apache2handler') {
            $system['environment'] = 'apache';
        } elseif ($sapi = 'cgi-fcgi') {
            $system['environment'] = 'cgi';
        } else {
            $system['environment'] = 'cli';
        }

        //网校
        $school_list = Db::name('admin')->column('school_name', 'id');
        $start = date('Y-m-d', strtotime('-6 day'));
        $end = date('Y-m-d', strtotime('+1 day'));

        $date_arr = array();
        $income_arr = array();
        $school_name_arr = array();
        $lists = Db::query("select school_id,DATE_FORMAT(bao_time,'%Y-%m-%d') as dates,sum(pay_amount) as income from apply where bao_time>='{$start}' and bao_time<'{$end}' group by school_id,dates");
        $incomeArr = array();
        foreach ($lists as $item) {
            $incomeArr[$item['school_id']][$item['dates']] = $item['income'];
        }
        //营业额
        $lists = Db::query("select school_id,DATE_FORMAT(add_time,'%Y-%m-%d') as dates,sum(pay_amount) as income from money where add_time>='{$start}' and add_time<'{$end}' group by school_id,dates");
        foreach ($lists as $item) {
            $incomeArr[$item['school_id']][$item['dates']] += $item['income'];
        }
        //结算金额
        $lists = Db::query("select school_id,DATE_FORMAT(add_time,'%Y-%m-%d') as dates,sum(pay_amount) as income from `open` where add_time>='{$start}' and add_time<'{$end}' group by school_id,dates");
        foreach ($lists as $item) {
            $incomeArr[$item['school_id']][$item['dates']] += $item['income'];
        }

        foreach ($school_list as $school_id => $school_name) {
            $school_name_arr[] = '"' . $school_name . '"';
            $income_temp = array();
            $s = strtotime($start);
            $e = strtotime($end);
            for (; $s < $e; $s += 86400) {
                $date = date('Y-m-d', $s);
                $date_arr[] = '"' . $date . '"';
                $income_temp[] = $incomeArr[$school_id][$date] ? (float)$incomeArr[$school_id][$date] : 0;
            }
            $temp = array(
                'name' => $school_name,
                'type' => 'line',
                'smooth' => true,
                'itemStyle' => array(
                    'normal' => array(
                        'areaStyle' => array('type' => "default"),
                    ),
                ),
                'data' => $income_temp,
            );
            $income_arr[] = $temp;
        }
        $date_arr = array_unique($date_arr);


        //网络部年营业额
        $start_month = date('Y-m-01',strtotime('-11 month'));
        $end_month = date('Y-m-01',strtotime('+1 month'));
        $month_income_arr = $month_income_array = array();
        $lists = Db::query("select school_id,DATE_FORMAT(bao_time,'%Y-%m') as months,sum(pay_amount*bili) as income from apply where bao_time>='{$start_month}' and bao_time<'{$end_month}' group by months");
        foreach ($lists as $item) {
            $month_income_arr[$item['months']] += $item['income'];
        }
        //营业额
        $lists = Db::query("select school_id,DATE_FORMAT(add_time,'%Y-%m') as months,sum(pay_amount) as income from money where add_time>='{$start_month}' and add_time<'{$end_month}' group by months");
        foreach ($lists as $item) {
            $month_income_arr[$item['months']] += $item['income'];
        }
        //结算金额
        $lists = Db::query("select school_id,DATE_FORMAT(add_time,'%Y-%m') as months,sum(pay_amount) as income from `open` where add_time>='{$start_month}' and add_time<'{$end_month}' group by months");
        foreach ($lists as $item) {
            //$month_income_arr[$item['months']] += $item['income'];
        }
        $s= strtotime($start_month);
        $e= strtotime($end_month);
        $month_arr = array();
        while($s < $e)
        {
            $month_arr[]= '"'.date('Y-m',$s).'"';
            $s = strtotime("+1 month", $s);
        }
        foreach ($month_arr as $months){
            $months = ltrim($months,'"');
            $months = rtrim($months,'"');
            $month_income_array[] = $month_income_arr[$months] ? $month_income_arr[$months] : 0;
        }
        //剩余空间大小
        return view('welcome', [
            'total_flag' => ($list[0]['income'] + $money_list[0]['income'] ) > ($last_list[0]['income'] + $last_money_list[0]['income']) ? 1 : 0,
            //'total_flag' => ($list[0]['income'] + $money_list[0]['income'] + $open_list[0]['income']) > ($last_list[0]['income'] + $last_money_list[0]['income'] + $last_open_list[0]['income']) ? 1 : 0,
            //'total_income' => $list[0]['income'] + $money_list[0]['income'] + $open_list[0]['income'],
            'alltotal_income' => $list[0]['income'] + $money_list[0]['income'] + $open_list[0]['income'],
            'total_income' => $list[0]['income'] + $money_list[0]['income'],
            'apply_flag' => $apply_list[0]['apply_num'] > $last_apply_list[0]['apply_num'] ? 1 : 0,
            'apply_num' => $apply_list[0]['apply_num'],
            'ask_flag' => $ask_list[0]['ask_num'] > $last_ask_list[0]['ask_num'] ? 1 : 0,
            'ask_num' => $ask_list[0]['ask_num'],
            'ask_list' => $ask_list,
            'ask_lists' => $ask_lists,
            'system' => $system,
            'school_name_arr' => $school_name_arr,
            'date_arr' => $date_arr,
            'income_str' => json_encode($income_arr),
            'month_arr' => $month_arr,
            'month_income_str' => $month_income_array,
        ]);
    }

    /**
     *报名管理
     */
    public function apply_list()
    {
        return view('apply_list', [
            'name' => 'ThinkPHP',
            'email' => 'thinkphp@qq.com'
        ]);
    }

}
