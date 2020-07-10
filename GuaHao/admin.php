<?php require('config.php');?>
<?php include('lib/functions.php');?>
<?php require('lib/mysql.class.php');?>
<?php
@extract($_GET,EXTR_PREFIX_ALL,"g");
if(isset($_POST['submit']) || isset($g_submit)){
  @check_post_request();
  @extract($_POST,EXTR_PREFIX_ALL,"p");
}

session_cache_limiter('private,must-revalidate');
if(!isset($_SESSION)){
  session_start();
}

$config['sys']['path'] = str_replace('admin.php','',$_SERVER['PHP_SELF']);
$db = new c_mysql;
$g_m = (isset($g_m) && in_array_key($g_m,$config['model'])) ? $g_m : 'login';
$g_o = isset($g_o) ? $g_o : '';

if($g_m != 'login')
  if(!isset($_SESSION['uid'])){
    header('Location:?m=login');
	exit();
  }
  
if(isset($_SESSION['uid']) && $g_m != 'login'){
  $user = $db->select_one('user',array('id' => $_SESSION['uid']));
  if(!$user)
    alert_goto('?m=login','没有这个用户的记录，请重新登录！');
}

if($g_m == 'home'){
  $g_m = 'record';
  $g_o = 'list';
}


$model_file = 'model/'.$g_m.'.php';
if(file_exists($model_file))
  include($model_file);

$operate_file = 'model/'.$g_m."_".$g_o.".php";
if(file_exists($operate_file))
  include($operate_file);

create_html();
?>