<?php
if(!check($user['id'],9))
  alert_goto('?m=home','抱歉，你没有权限执行此操作！');
$list = '';
$users = $db->select_date('user');
if(!empty($users)){
  foreach($users as $user){
	
    $list .= '  <div class="item">
	<h2>'.$user['username'].' </h2> <h3></h3> [<a href="?m=set&o=useredit&uid='.$user['id'].'">编辑</a>]
    <div class="info">
	  <p>用户姓名：'.$user['truename'].'</p>
	  <p>上次登录：'.date('Y-m-d H:i',$user['lasttime']).'</p>
	</div>
  </div>';
  }
}

$replace['list'] = $list;
?>