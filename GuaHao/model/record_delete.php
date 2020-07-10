<?php
if(empty($g_rid))
  alert_back('删除失败：非法操作！');
$record = $db->select_one('record',array('id' => $g_rid));
if(!$record)
  alert_back('删除失败：没有这条记录！');
  
$db->delete_date('record',array('id' => $record['id']),1);
if($record['fee'] > 0){
  $recordindex = $db->select_one('recordindex',array('id' => $record['riid']));
  if($recordindex){
     $fee_all = fee(get_sum('record','fee',array('riid' => $record['riid'])));
	 $db->update_date('recordindex',array('id' => $recordindex['id']),array('fee' => $fee_all),1);  
  }
}
alert_goto('?m=record&o=list&riid='.$record['riid'],'删除就诊记录成功！');
?>