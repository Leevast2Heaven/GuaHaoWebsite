<?php
$g_o = 'login';
$config['operate'] = array('login' => '登录系统');
if(isset($p_submit)){
  if(empty($p_yanzheng))
    alert_back('登录失败：验证码不正确！');
  if($p_yanzheng != $_SESSION["Checknum"])
    alert_back('登录失败：验证码不正确！');
  if(empty($p_username) || empty($p_password)){
    alert_back('登录失败，用户名或密码为空！');
  }
  $user = $db->select_one('user',array('username' => $p_username));
  if(!$user)
    alert_back('登录失败，没有这个用户！');
  if($user['password'] != md5($p_password))
    alert_back('登录失败，密码不对！');
  if(!isset($_SESSION))
    session_start();
  $_SESSION['uid'] = $user['id'];
  $db->update_date('user',array('id' => $user['id']),array('lasttime' => time()),1);
  header('Location:?m=home');
  exit();
}
$tpl = 'login.htm';
?>