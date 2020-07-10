<?php
if(isset($p_submit)){
  $date = array();
  if(empty($p_truename))
    alert_back('真实姓名不能为空！');
  $date['truename'] = $p_truename;
  if(!empty($p_password)){
	if(strlen($p_password) < 6)
      alert_back('为了保障您的账户安全，密码请不要少于6位！');
    if($p_password != $p_r_password)
      alert_back('修改失败，两次输入的密码不一致！');
	$date['password'] = md5($p_password);
  }
  $db->update_date('user',array('id' => $user['id']),$date,1);
    alert_goto('?m=user&o=edit','修改用户信息成功！');
}

?>