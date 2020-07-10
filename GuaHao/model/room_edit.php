<?php
if(!check($user['id'],9))
  alert_goto('?m=home','抱歉，你没有权限执行此操作！');

$room = $db->select_one('room',array('id' => $g_rid));
if(!$room)
  alert_back('没有这个科室的相关记录！');
if(isset($p_submit)){
  if(empty($p_name))
    alert_back("添加科室失败：请输入科室名称！");
  if(strlen($p_name) > 60)
    alert_back("添加科室失败：科室名称过长！");
  $date = array('name' => $p_name,
				'description' => $p_description);
  if($db->update_date('room',array('id' => $g_rid),$date))
    alert_goto('?m=room&o=list','修改科室信息成功！');
  alert_back('操作失败，请稍后再试！');
}
$tpl = 'room_add.htm';
$replace['room.name'] = $room['name'];
$replace['room.description'] = $room['description'];
$replace['room.id'] = $room['id'];
$replace['room.operate'] = 'edit';

?>