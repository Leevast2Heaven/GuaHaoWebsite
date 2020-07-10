<?php

  $rooms = $db->select_date('room');
  if(!empty($rooms))
    foreach($rooms as $room)
      $room_options[$room['id']] = $room['name'];
  $room_options = create_option($room_options,'',2);
/**
$replace['code'] = htmlspecialchars('<script type="text/javascript" src="'.$config['sys']['path'].'guahao.php"></script>');**/
$replace['code'] = htmlspecialchars(file_get_contents('view/guahao.htm'));
$replace['code'] = nl2br($replace['code']);
$replace['code'] = str_replace('{config.sys.path}',$config['sys']['path'],$replace['code']);
$replace['code'] = str_replace('{room.options}',$room_options,$replace['code']);
?>