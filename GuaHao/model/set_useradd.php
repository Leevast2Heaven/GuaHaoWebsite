<?php
if(!check($user['id'],9))
  alert_goto('?m=home','抱歉，你没有权限执行此操作！');
if(isset($p_submit)){
  if(empty($p_username))
    alert_back("添加用户失败：请输入用户姓名！");
  if(strlen($p_username) > 10)
    alert_back("添加用户失败：用户名称过长！");
  if(empty($p_truename))
    alert_back("添加用户失败：请输入用户姓名！");
  if(strlen($p_truename) > 20)
    alert_back("添加用户失败：用户名称过长！");
  if(empty($p_password))
    alert_back("添加用户失败：请输入用户密码！");
  if(strlen($p_password) > 20)
    alert_back("添加用户失败：用户密码过长！");
  if($p_password != $p_rpassword)
    alert_back("添加用户失败：两次输入的密码不一致！");
  if($db->select_one('user',array('username' => $p_username)))
    alert_back("添加用户失败：该用户名称已存在！");
  $date = array('username' => $p_username,
				'truename' => $p_truename,
				'password' => md5($p_password),
				'register_ip' => get_ip(),
				'lasttime' => time(),
				'addtime' => time());
  if($db->insert_date('user',$date))
    alert_goto('?m=set&o=userlist','添加用户成功！');
  alert_back('操作失败，请稍后再试！');
}

$replace['tuser.username.lock'] = '';
$replace['tuser.truename'] = '';
$replace['tuser.username'] = '';
$replace['tuser.id'] = '';
$replace['operate'] = 'add';

?>