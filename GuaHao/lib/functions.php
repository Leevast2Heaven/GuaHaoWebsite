<?php
function  check($uid,$range){
          global $db;
		  $user = $db->select_one('user',array('id' => $uid));
		  if($user)
		    if($user['range'] >= $range)
			  return true;
		  return false;
}

function  header_back()
{
	      header("Location:".$_SERVER['HTTP_REFERER']);
	      exit();
}

function  header_goto($url)
{
	      header("Location:".$url);
	      exit();
}


function  alert_back($msg = "")
{
          $html = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		           <script type=\"text/javascript\" charset=\"utf-8\">
                      alert('".$msg."');
		              window.history.back(-1);
                   </script>";
		  echo $html;
		  exit();
}

function  alert_goto($url,$msg)
{
          $html = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		           <script type=\"text/javascript\" charset=\"utf-8\">
                      alert('".$msg."');
		              top.location = \"".$url."\";
                   </script>";
		  echo $html;
		  exit();
}

function  check_post_request()
{
          if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($_SERVER['HTTP_REFERER']) || preg_replace("/https?:\/\/([^\:\/]+).*/i","\\l", $_SERVER['HTTP_REFERER']) !== preg_replace("/([^\:]+).*/","\\l",$_SERVER['HTTP_HOST'])))
		    die("来路不正确。");
}

function  get_num($table,$keys = "")
{
		  global $db,$config;
		  $table = $config['db']['pre'].$table;
		  $sql = "SELECT COUNT(*) AS count_num FROM ".$table;
		  if(!empty($keys))
		  {
			$array = array();
			foreach($keys as $key => $value)
			  $array[] = $key." = '".$value."'";
			$where = implode(" and ",$array);
			$sql .= " WHERE ".$where;
		  }
		  $result = $db->select($sql);
		  if(!$result)
			return 0;
		  return $result[0]['count_num'];
}

function  get_sum($table,$field,$keys = "",$method = 'a')
{
		  global $db,$config;
		  $table = $config['db']['pre'].$table;
		  $sql = "SELECT sum(`".$field."`) AS count_num FROM ".$table;
		  if(!empty($keys)){
		    if($method == 'a'){
			  $array = array();
			  foreach($keys as $key => $value)
			    $array[] = $key." = '".$value."'";
			  $where = implode(" and ",$array);
			  $sql .= " WHERE ".$where;
		    }
			else{
			  $sql .= " WHERE ".implode(' and ',$keys);
			}
		  }
		  $result = $db->select($sql);
		  if(!$result)
			return 0;
		  return $result[0]['count_num'];
}


		
function  create_pagelinks($pageurl,$totalrecords = 0,$current = 1,$pagesize = 10)
{
          $totalpages = ceil($totalrecords / $pagesize);
		  if($totalpages <= 1)
		    return Null;
		  $prev = $current - 1;
		  $next = $current + 1;
		  $prevpage = "";
		  $nextpage = "";
		  if($current > 1)
		    $prevpage = "<a href=\"".$pageurl."&pagenum=".$prev."\" title=\"上一页\"><<</a>";
		  if($current < $totalpages)
		    $nextpage = "<a href=\"".$pageurl."&pagenum=".$next."\" title=\"下一页\">>></a>";
		  $pagelist = "";
		  for($i = 1;$i <= $totalpages;$i++)
		  {
		    $pagelist .= "<a href=\"".$pageurl."&pagenum=".$i."\"";
			if($i == $current)
			  $pagelist .= " class='current'";
			$pagelist .= " title=\"第".$i."页\">".$i."</a> ";
		  }
		  return "<div class='pagelinks'>".$prevpage.$pagelist.$nextpage."</div>";
}


function  get_ip()
{
          $ip = "";
          if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'),'unknow'))
		  {
		    $ip = getenv('HTTP_CLIENT_IP');
		  }
		  elseif(getenv('REMOTE_ADD') && strcasecmp(getenv('REMOTE_ADD'),'unknow'))
		  {
		    $ip = getenv('REMOTE_ADD');
		  }
		  elseif(isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'],'unknow'))
		  {
		    $ip = $_SERVER['REMOTE_ADDR'];
		  }
		  return $ip;
}


function  truncate_array($array,$key,$size)
{
          if(!$size)
		    return $array;
		  for($i = 0;$i < count($array);$i++){
			$array[$i][$key] = str_replace(" ","",$array[$i][$key]);
		    $array[$i][$key] = words_cut(strip_tags($array[$i][$key]),$size);
			$array[$i][$key] .= "...";
		  }
		  return $array;
}

function array_sort($object = "",$sort_key = "",$type = "desc")
{
           if(empty($object))
		     return Null;
		   if(empty($sort_key))
		     return $object;
           $num = count($object);
		   for($i = 0;$i < $num - 1;$i++)
		     for($j = $i + 1;$j < $num;$j++)
			   if($object[$i][$sort_key] < $object[$j][$sort_key]){
			     $tmp = $object[$i];
				 $object[$i] = $object[$j];
				 $object[$j] = $tmp;
			   }
		   if($type != "desc")
		     $object = array_reverse($object);
		   return $object;
}

function  strs_replace($subject,$replaces)
{
	      foreach($replaces as $k => $v)
		    $subject = str_replace($k,$v,$subject);
		  return $subject;
}

function  trip_filename($filename)
{
	      return strs_replace(array("/","\\","?","*","<",">","\"","|"),"",$filename);
}

function  in_array_key($string,$array){
          foreach($array as $k => $v)
		    if($k == $string)
			  return true;
		  
		  return false;
}


function  create_html(){
          global $config,$user,$g_m,$g_o,$tpl,$replace;
		  $html_menu = $html_main = '';
		  if(!empty($config['menu']))
		    foreach($config['menu'] as $name => $link)
		      $html_menu .= "<li><u>＊</u> <a href='".$link."' title='".$name."'>".$name."</a></li>";
		  
		  if($g_m != 'login'){
            $html = file_get_contents('view/out.htm');
			$tpl = empty($tpl) ? 'view/'.$g_m.'_'.$g_o.'.htm' : 'view/'.$tpl;
			if(file_exists($tpl))
			  $html_main = file_get_contents($tpl);
		    $html = str_replace('{main}',$html_main,$html);
		  }
		  else{
		    $html = file_get_contents('view/'.$tpl);
		  }
		  $html_position = '<a href="?m='.$g_m.'">'.$config['model'][$g_m].'</a>';
		  if($g_o)
		    @$html_position .= ' / '.$config['operate'][$g_o];
		  $replace1 = @array('html.menu' => $html_menu,
						     'html.position' => $html_position,
						     'html.main' => $html_main,
							 'config.sys.name' => $config['sys']['name'],
							 'config.sys.version' => $config['sys']['version'],
						     'user.username' => $user['username'],
						     'user.truename' => $user['truename'],
						     'config.model.name' => $config['model'][$g_m],
						     'config.operate.name' => $config['operate'][$g_o],);
		  
		  $replace = empty($replace) ? $replace1 : array_merge($replace1,$replace);
		  
		  foreach($replace as $k => $v)
		    $html = str_replace('{'.$k.'}',$v,$html);
		  exit($html);

}

function getmaxdim($vDim)
        {
                if(!is_array($vDim)) return 0;
                else
                {
                        $max1 = 0;
                        foreach($vDim as $item1)
                        {
                            $t1 = getmaxdim($item1);
                            if( $t1 > $max1) $max1 = $t1;
                        }
                        return $max1 + 1;
                }
        }


function  create_option($options,$default = "",$dim = "",$test = ""){
	      $select = "";
		  if($dim == "")
		    $dim = getmaxdim($options);
		  if($dim == 1){
            foreach($options as $option){
		      $select .= "<option value=\"".$option."\"";
			  if($option == $default)
			    $select .= " selected='selected'";
			  $select .= ">".$option."</option>";
		    }
          }
		  else{
            foreach($options as $k => $v){
		      $select .= "<option value=\"".$k."\"";
			  if($k == $default){
			    $select .= " selected=\"selected\"";}
			  $select .= ">".$v."</option>";
		    }
		  }
		  return $select;
}

function  create_menu_a($pageurl,$name,$options,$default = "",$dim = 1,$att = "",$value1 = "",$value2 = '',$total = 1){

		  $all = 0;
		  $menu = '';
		  if($dim ===1){
            foreach($options as $option){
		      $menu .= "<a href=\"".$pageurl."&".$name."=".$option.$att."\"";
			  if($option == $default){
			    $menu .= " class='choose'";
			    $all = 1;
			  }
			  $menu .= ">".$option."</a>";
		    }
          }
		  elseif($dim == 2){
            foreach($options as $k => $v){
		      $menu .= "<a href=\"".$pageurl."&".$name."=".$k.$att."\"";
			  if($k === $default){
			    $menu .= " class='choose'";
			    $all = 1;
			  }
			  $menu .= ">".$v."</a>";
		    }
		  }
		  elseif($dim == 3){
            foreach($options as $option){
		      $menu .= "<a href=\"".$pageurl."&".$name."=".$option[$value1].$att."\"";
			  if($option[$value1] == $default){
			    $menu .= " class='choose'";
			    $all = 1;
			  }
			  $menu .= ">";
			  if($value2)
		        $menu .= $option[$value2];
			  else
		        $menu .= $option[$value1];
			  $menu .= "</a>";
		    }
		  }
		  
	      if($total)
		    $menu = $all ? "<a href=\"".$pageurl."&".$name."=all".$att."\" class=\"all\">全部</a>".$menu : "<a href=\"".$pageurl."&".$name."=all".$att."\" class=\"choose all\">全部</a>".$menu;
		  return $menu;
}

function  create_choose_a($model,$options,$dim = 1,$default = '',$name = '',$value1 = '',$value2 = ''){
          $menu = '';
		  if($dim === 1){
            foreach($options as $option){
		      $menu .= "<a href=\"javascript:choose('".$model."','".$option."')\"";
			  if($option == $default){
			    $menu .= " class=\"choose\"";
			  }
			  $menu .= ">".$option."</a>";
		    }
          }
		  elseif($dim == 2){
            foreach($options as $k => $v){
		      $menu .= "<a href=\"javascript:choose('".$model."','".$k."')\"";
			  if($k === $default){
			    $menu .= " class='choose'";
			  }
			  $menu .= ">".$v."</a>";
		    }
		  }
		  elseif($dim == 3){
            foreach($options as $option){
			  if($value2)
		        $menu .= "<a href=\"javascript:choose('".$model."','".$option[$value1]."','".$option[$value2]."')\"";
			  else
		        $menu .= "<a href=\"javascript:choose('".$model."','".$option[$value1]."')\"";
			  if($option[$value1] == $default){
			    $menu .= " class='choose'";
			  }
			  $menu .= " id=\"".$model.$option[$value1]."\">".$option[$name]."</a>";
		    }
		  }
		  
		  return $menu;
}

?>