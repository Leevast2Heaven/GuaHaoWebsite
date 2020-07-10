<?php
if(empty($g_rid))
  alert_back("编辑就诊信息失败：pid参数错误！");
$record = $db->select_one('record',array('id' => $g_rid));
if(!$record)
  alert_back("编辑就诊信息失败：没有这个记录的相关记录！");
if(isset($p_submit)){
  if(empty($p_num) && $p_fee > 0)
    alert_back("编辑就诊信息失败：数量和总额不符！");
  $date = array('num' => $p_num,
				'fee' => fee($p_fee));
  if($db->update_date('record',array('id' => $g_rid),$date)){
    $fee_all = get_sum('record','fee',array('riid' => $record['riid']));
	$db->update_date('recordindex',array('id' => $record['riid']),array('fee' => $fee_all),1);
    alert_goto('?m=record&o=list&riid='.$record['riid'],'编辑记录资料成功！');
  }
  alert_back('操作失败，请稍后再试！');
}
$unit = '';
	if($record['item'] == 'ext')
	  $itemname = $config['ext'][$record['itemid']]['name'];
	else{
	  $item = $db->select_one($record['item'],array('id' => $record['itemid']));
	  $itemname = $item['name'];
	  if($record['item'] == 'drug')
	    $unit = $item['unit'];
	}
	
$patient = $db->select_one('patient',array('id' => $record['pid']));

$replace['patient.name'] = $patient['name'];
$replace['record.id'] = $record['id'];
$replace['record.date'] = $record['date'];
$replace['record.num'] = $record['num'];
$replace['record.fee'] = $record['fee'];
$replace['record.unit'] = $unit;
$replace['record.name'] = $itemname;
?>