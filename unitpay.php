<?php
/*
Copyright (c) 2014 LiteDevel

Данная лицензия разрешает лицам, получившим копию данного программного обеспечения
и сопутствующей документации (в дальнейшем именуемыми «Программное Обеспечение»),
безвозмездно использовать Программное Обеспечение в  личных целях, включая неограниченное
право на использование, копирование, изменение, добавление, публикацию, распространение,
также как и лицам, которым запрещенно использовать Програмное Обеспечение в коммерческих целях,
предоставляется данное Программное Обеспечение,при соблюдении следующих условий:

Developed by LiteDevel
*/
include "application/config.php";
// ��������� ����� ������ �������������� PHP
error_reporting(0);
function md5sign($params, $secretKey) {
    ksort($params);
    unset($params['sign']);
 
    return md5(join(null, $params).$secretKey);
}
 
/**
 * ��������� ����� ��������
 *
 * @param $message
 */
function responseError($message) {
    $error = array(
        "jsonrpc" => "2.0",
        "error" => array(
            "code" => -32000,
            "message" => $message
        ),
        'id' => 1
    );
    echo json_encode($error); exit();
}
 
/**
 * �������� ����� ��������
 *
 * @param $message
 */
function responseSuccess($message) {
    $success = array(
        "jsonrpc" => "2.0",
        "result" => array(
            "message" => $message
        ),
        'id' => 1
    );
    echo json_encode($success); exit();
}
 
// ��� ��������� ���� �� ������� ��������
$secretKey = $config['unitpay_secret'];
$method = $_GET['method'];
$params = $_GET['params'];
    
if ($params['sign'] != md5sign($params, $secretKey)) {
    responseError("Не соответсвие MD5 хешей");
}
 
switch($method) {
    case 'check':
			$link = mysql_connect($config['db_hostname'], $config['db_username'], $config['db_password']);
			if (!$link) {
				die('Ошибка соедениение с базой: ' . mysql_error());
			}
			$db_selected = mysql_select_db($config['db_database'], $link);
			if (!$db_selected) {
				die ("Ошибка выбора базы {$config['db_database']}: " . mysql_error());
			}
        break;
    case 'pay':
			
			$link = mysql_connect($config['db_hostname'], $config['db_username'], $config['db_password']);
			if (!$link) {
				die('Ошибка соедениение с базой: ' . mysql_error());
			}
			$db_selected = mysql_select_db($config['db_database'], $link);
			if (!$db_selected) {
				die ("Ошибка выбора базы {$config['db_database']}: " . mysql_error());
			}
			
			$dopbalance=mysql_result(mysql_query("SELECT `invoice_ammount` FROM `invoices` WHERE `invoice_id` = '{$_GET['params']['account']}'"),0);
			$dbalance=floor($dopbalance);
			if($dbalance == $_GET['params']['sum']){
			
			$iduser=mysql_result(mysql_query("SELECT `user_id` FROM `invoices` WHERE `invoice_id` = '{$_GET['params']['account']}'"),0);
			$currbalance=mysql_result(mysql_query("SELECT `user_balance` FROM `users` WHERE `user_id` = '{$iduser}'"),0);
			
			$newbalance=$currbalance+$dopbalance;
			
			mysql_query("UPDATE `invoices` SET `invoice_status`='1' WHERE `invoice_id` = '{$_GET['params']['account']}'");
			mysql_query("UPDATE `users` SET `user_balance`='{$newbalance}' WHERE `user_id` = '{$iduser}'");
			
			}
        break;
    case 'error':
			responseError("Ошибка,{$params['errorMessage']}"); exit;
        break;
    default:
        responseError("Только: check, pay"); exit;
}
#print_r($_GET);
responseSuccess("Успех");

?>