<?php require_once('model/record_quick.php');?>
<?php
$config['operate'] = array('list' => '预约记录');
$config['menu'] = array('查看记录' => '?m=record&o=list');
if(!empty($g_riid)){
  $key[] = 'riid = '.$g_riid;
  $url['riid'] = $g_riid;
}

if(!empty($g_item) && $g_item != 'all'){
  $key[] = '`item` = \''.$g_item.'\'';
  $url['item'] = $g_item;
}

if(!empty($g_itemid) && $g_itemid != 'all'){
  $key[] = 'itemid = '.$g_itemid;
  $url['itemid'] = $g_itemid;
}


$sql = "SELECT * FROM `".$config['db']['pre']."record` ";
if(!empty($key)){
  $key = implode(' AND ',$key);
  $sql .= "WHERE ".$key;
}
$sql .= " ORDER BY `date` DESC LIMIT ".$limit;
$records = $db->select($sql);

$list = '<tr><td colspan="8">一条记录也没有。</td></tr>';

if(empty($url))
  $url = '?m=record&o=list';
else{
  $urls = array();
  foreach($url as $v => $k)
    $urls[] = $v.'='.$k;
  $url = '?m=record&o=list&'.implode('&',$urls);
}
  $sql = "SELECT COUNT(*) AS count_num FROM `".$config['db']['pre']."record` ";
  if(!empty($key)){
    $sql .= "WHERE ".$key;
  }
  $num = $db->select($sql);
  $num = $num ? $num[0]['count_num'] : 0;
if(!empty($records)){
  $list = '';
  foreach($records as $record){
	$room = $db->select_one('room',array('id' => $record['rid']));
    $list .= '<tr>';
    $list .= '<td>'.$record['date'].'</td>';
    $list .= '<td>'.date('Y-m-d H:i',$record['addtime']).'</td>';
    $list .= '<td>'.$room['name'].'</td>';
    $list .= $record['name'] ? '<td>'.$record['name'].'</td>' : '<td>&nbsp; </td>';
    $list .= '<td>'.$config['gender'][$record['gender']].'</td>';
    $list .= '<td>'.$record['age'].'</td>';
    $list .= $record['note'] ? '<td>'.$record['note'].'</td>' : '<td>&nbsp; </td>';
    $list .= '<td><a href="javascript:recordDelete('.$record['id'].')">删除</a></td>';
    $list .= '</tr>';
  }
  $pagelinks = create_pagelinks($url,$num,$g_pagenum,$pagesize);
  $list .= "<tr><td colspan=\"8\">".$pagelinks."</td></tr>";
}
$rooms = $db->select_date('room');
$quickmenu_room = @create_menu_a($url,'rid',$rooms,$g_rid,3,$att = "&did=all",'id','name');


$quickmenu_date = @create_menu_a($url,'quickdate',$quick_menu['date'],$g_quickdate,2);

$replace['record.list'] = $list;
$replace['record.num'] = $num;
$replace['html.pages'] = $html_pages;
$replace['quickmenu.room'] = $quickmenu_room;
$replace['quickmenu.date'] = $quickmenu_date;
@$replace['quickmenu.starttime'] = $g_starttime;
@$replace['quickmenu.endtime'] = $g_endtime;
?>
