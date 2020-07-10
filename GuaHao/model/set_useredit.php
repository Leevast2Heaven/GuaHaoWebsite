<?php
if(!check($user['id'],9))
  alert_goto('?m=home','抱歉，你没有权限执行此操作！');
if(empty($g_uid))
  alert_back('参数缺失，UID');
$tuser = $db->select_one('user',array('id' => $g_uid));
if(!$tuser)
  alert_back('没有这个用户！');
if(isset($p_submit)){
  if(empty($p_truename))
    alert_back("添加用户失败：请输入用户姓名！");
  if(strlen($p_truename) > 20)
    alert_back("添加用户失败：用户名称过长！");
  $date = array('truename' => $p_truename);
  if(!empty($p_password)){
    if(strlen($p_password) > 20)
      alert_back("添加用户失败：用户密码过长！");
    if($p_password != $p_rpassword)
      alert_back("添加用户失败：两次输入的密码不一致！");
	$date['password'] = md5($p_password);
  }
  if($db->update_date('user',array('id' => $g_uid),$date))
    alert_goto('?m=set&o=userlist','编辑用户成功！');
  alert_back('操作失败，请稍后再试！');
}

$replace['tuser.username.lock'] = 'disabled="true"';
$replace['tuser.truename'] = $tuser['truename'];
$replace['tuser.username'] = $tuser['username'];
$replace['tuser.id'] = $tuser['id'];
$replace['operate'] = 'edit';
$tpl = 'set_useradd.htm';

?>