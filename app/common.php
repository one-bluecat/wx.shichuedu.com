<?php
// 应用公共文件
function send_sms($mobPhone,$smsContent)
{
    error_reporting(0);
    header("Content-type: text/html; charset=utf-8");
    try {
        libxml_disable_entity_loader(false);
        $wsdl = "http://sms3.mobset.com:8080/Api?wsdl";
        $client = new SoapClient($wsdl);
        $client->soap_defencoding = 'utf-8';
        $client->decode_utf8 = false;
        $errMsg = "";
        $strSign = "";
        $addnum = "";
        $timer = "";
//        $lCorpID = 300801;
        $lCorpID = 304407;
//        $strLoginName = "jiaowu";
        $strLoginName = "Admin";
//        $strPasswd = "Qs179631";
        $strPasswd = "Sw105103";

        $longSms = 0;
        $strTimeStamp = GetTimeString();
        $strInput = $lCorpID . $strPasswd . $strTimeStamp;
        $strMd5 = md5($strInput);
        $group = $client->ArrayOfMobileList[1];
        $group[0] = $client->MobileListGroup;
        $group[0]->Mobile = $mobPhone;
        $param = array('CorpID' => $lCorpID, 'LoginName' => $strLoginName, 'Password' => $strMd5, 'TimeStamp' => $strTimeStamp, 'AddNum' => $addnum, 'Timer' => $timer, 'LongSms' => $longSms, 'MobileList' => $group,
            'Content' => $smsContent);
        $result = $client->Sms_Send($param);
        $sms_code = $result->SmsIDList->SmsIDGroup->SmsID;
        if ($result->ErrCode == 0) {
            return array('sms_code' => $sms_code, 'info' => 'success');
        } else {
            return array('sms_code' => 0, 'info' => $result->ErrMsg);
        }
    } catch (\SoapFault $fault) {
        return array('sms_code' => 0, 'sms_content' => "");
    }
}

function GetTimeString()
{
    date_default_timezone_set('Asia/Shanghai');
    $timestamp = time();
    $hours = date('H', $timestamp);
    $minutes = date('i', $timestamp);
    $seconds = date('s', $timestamp);
    $month = date('m', $timestamp);
    $day = date('d', $timestamp);
    $stamp = $month . $day . $hours . $minutes . $seconds;
    return $stamp;
}

function get_client_ip($type = 0) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**钉钉通知
 * @param $post_string
 * @return bool|string
 */
function ding_notify_info($post_string) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://oapi.dingtalk.com/robot/send?access_token=7a1e1332542629b6f17348a812e2a810f6193f5244f021a43977a5862befd6d2");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}