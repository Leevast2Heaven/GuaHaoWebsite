<?php
if(!check($user['id'],9))
  alert_goto('?m=home','抱歉，你没有权限执行此操作！');
if(isset($p_submit)){
  if(empty($p_name))
    alert_back("添加科室失败：请输入科室名称！");
  if(strlen($p_name) > 60)
    alert_back("添加科室失败：科室名称过长！");
  $date = array('name' => $p_name,
				'description' => $p_description,
				'addtime' => time());
  if($db->insert_date('room',$date))
    alert_goto('?m=room&o=list','添加科室成功！');
  alert_back('操作失败，请稍后再试！');
}

$replace['room.name'] = '';
$replace['room.description'] = '';
$replace['room.id'] = '';
$replace['room.operate'] = 'add';

?>