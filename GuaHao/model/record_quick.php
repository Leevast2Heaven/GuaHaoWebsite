<?php
$html_pages = '';
$pagesize = 20;
$index_num = $fee_all = $fee_page = 0;
$quick_menu['date'] = array('today' => '今天',
						 'yesterday' => '昨天',
						 'last7day' => '近7天',
						 'thisweek' => '本周',
						 'lastweek' => '上周',
						 'last30day' => '最近30天',
						 'thismonth' => '本月',
						 'lastmonth' => '上月');

$quick_menu['sort'] = array('time' => '按日期','patient' => '按患者');
$key = array();
$url = array();
$sql = '';
$g_pagenum = empty($g_pagenum) ? 1 : intval($g_pagenum);
$g_sort = empty($g_sort) ? 'time' : $g_sort;
$limit = (($g_pagenum - 1) * $pagesize).','.$pagesize;

if(!empty($g_rid) && $g_rid != 'all'){
  $key[] = 'rid = '.$g_rid;
  $url['rid'] = $g_rid;
}




if($g_sort != 'all'){
  $url['sort'] = $g_sort;
  if($g_sort == 'time')
    $sort = 'date DESC';
  elseif($g_sort == 'patient')
    $sort = 'pid ASC,date DESC';
}




  if(!empty($g_quickdate)){
    switch($g_quickdate){
	  case 'all' :         $g_starttime = '';
	                       $g_endtime = '';
						   break;
						   
	  case 'today' :       $g_starttime = date('Y-m-d');
	                       $g_endtime = date('Y-m-d');
						   break;
						   
	  case 'yesterday' :   $g_starttime = date('Y-m-d',time() - 24 * 3600);
	                       $g_endtime = date('Y-m-d',time() - 24 * 3600);
						   break;
						   
	  case 'last7day' :    $g_starttime = date('Y-m-d',time() - 7 * 24 * 3600);
	                       $g_endtime = date('Y-m-d');
						   break;
	  case 'last30day' :   $g_starttime = date('Y-m-d',time() - 30 * 24 * 3600);
	                       $g_endtime = date('Y-m-d');
						   break;
					
	  case 'thisweek' :    $week = intval(date('w'));
	                       if($week == 0)
	                         $g_starttime = date('Y-m-d');
	                       else
						     $g_starttime = date('Y-m-d',time() - $week * 24 * 3600);
	                       $g_endtime = date('Y-m-d');
						   break;
					
	  case 'lastweek' :    $week = intval(date('w'));
						   $g_endtime = date('Y-m-d',time() - ($week + 1) * 24 * 3600);
	                       $g_starttime = date('Y-m-d',time() - ($week + 8) * 24 * 3600);
						   break;
						   
	  case 'thismonth' :   $day = intval(date('j'));
						   $g_starttime = date('Y-m-d',time() - ($day - 1) * 24 * 3600);
	                       $g_endtime = date('Y-m-d');
						   break;
						   
	  case 'lastmonth' :   $day = intval(date('j'));
						   $g_endtime = date('Y-m-d',time() - $day * 24 * 3600);
						   $endtime = @mktime(0,0,0,date('m',$g_endtime),date('d',$g_endtime),date('Y',$g_endtime));
						   $days = date('t',$endtime);
	                       $g_starttime = date('Y-m-d',time() - ($day + $days - 1) * 24 * 3600);
						   break;
					 
	  default  : break;
	  
	}
	$pageitem[] = "quickdate=".$g_quickdate;
  
  }
  if(!empty($_POST['starttime'])){
	$g_starttime = $_POST['starttime'];
	$g_quickdate = '';
  }
  if(!empty($_POST['endtime'])){
	$g_endtime = $_POST['endtime'];
	$g_quickdate = '';
  }

  if(!empty($g_starttime)){
	$starttime = $g_starttime;
	//$starttime2 = explode('-',$starttime);
    //$starttime2 = mktime(0,0,0,$starttime2[1],$starttime2[2],$starttime2[0]);
	$key[] = "`date` >= '".$starttime."'";
	$url['starttime'] = $g_starttime;
  }
  
  if(!empty($g_endtime)){
	$endtime = $g_endtime;
	//$endtime2 = explode('-',$endtime);
    //$endtime2 = mktime(23,59,59,$endtime2[1],$endtime2[2],$endtime2[0]);
	$key[] = "`date` <= '".$endtime."'";
	$url['endtime'] = $g_endtime;
  }












//哈哈 一切为了有体肤吧
?>