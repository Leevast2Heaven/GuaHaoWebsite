<?php
$list = '';
$rooms = $db->select_date('room','','','','id','ASC');
if(!empty($rooms)){
  foreach($rooms as $room){
	$record_num = get_num('record',array('rid' => $room['id']));
    $list .= '  <div class="item">
	<h2>'.$room['name'].'</h2> <h3>'.$room['description'].' </h3> [<a href="?m=room&o=edit&rid='.$room['id'].'">编辑</a>]
    <div class="info">
	  <p><u>▷</u> 预约记录：'.$record_num.'个 [<a href="?m=record&o=list&rid='.$room['id'].'">查看预约记录</a>]</p>
	</div>
  </div>';
  }
}

$replace['list'] = $list;
?>