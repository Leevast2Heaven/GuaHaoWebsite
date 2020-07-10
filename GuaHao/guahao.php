<?php require('config.php');?>
<?php include('lib/functions.php');?>
<?php require('lib/mysql.class.php');?>
<?php

@extract($_GET,EXTR_PREFIX_ALL,"g");
if(isset($_POST['submit']) || isset($g_submit)){
  @check_post_request();
  @extract($_POST,EXTR_PREFIX_ALL,"p");
}
session_cache_limiter('private,must-revalidate');
if(!isset($_SESSION)){
  session_start();
}
$config['sys']['path'] = str_replace('guahao.php','',$_SERVER['PHP_SELF']);

$db = new c_mysql;

if(isset($g_submit) || isset($p_submit)){
  if(empty($p_yanzheng))
    alert_back('很抱歉2，预约提交失败：验证码不正确，谢谢！');
  if($p_yanzheng != $_SESSION["Checknum"])
    alert_back('很抱歉，预约提交失败：验证码不正确，谢谢！');
  if(empty($p_name))
    alert_back('很抱歉，预约提交失败：请填写您的姓名，谢谢！');
  if(empty($p_age))
    alert_back('很抱歉，预约提交失败：请填写您的年龄，谢谢！');
  if($p_age < 0 || $p_age > 120)
    alert_back('很抱歉，预约提交失败：您输入的年龄不合法，请重新输入，谢谢！');
  if(empty($p_rid))
    alert_back('很抱歉，预约提交失败：请选择需要预约的科室，谢谢！');
  if(empty($p_tel))
    alert_back('很抱歉，预约提交失败：请填写您的联系电话，谢谢！');
  if(empty($p_comedate))
    alert_back('很抱歉，预约提交失败：请选择您的来院日期，谢谢！');
  /**if($p_comedate < date('Y-m-d'))
    alert_back('很抱歉，预约提交失败：请选择正确的来院日期，谢谢！');**/

  $date = array('name' => $p_name,
			  'age' => intval($p_age),
			  'gender' => $p_sex,
			  'rid' => $p_rid,
			  'tel' => $p_tel,
			  'date' => $p_comedate,
			  'note' => $p_note,
			  'addtime' => time());

  $result = $db->insert_date('record',$date);
  if(!$result)
    alert_back('添加预约失败，请稍后重试！');
  alert_back('添加预约成功，稍后我们将与您取得联系核实！');
}
exit();
?>