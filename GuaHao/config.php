<?php
/*********************
  系统名称：医院网上挂号系统
  作者：Leevast
  版本号：2.0
**********************/

date_default_timezone_set('PRC');     //北京时间

global $config,$db,$user,$g_m,$g_o,$operates,$tpl,$replace;

$config['db'] = array('hostname' => 'localhost',   //数据库主机
					  'datebase' => 'guahao',   //数据库名称
					  'username' => 'root',        //数据库用户名
					  'password' => '919131153l',      //数据库密码
					  'charset' => 'utf8',         //数据库字符集
					  'pre' => 'gh_');             //数据库表前缀

$config['sys'] = array('name' => '医院网上挂号系统',
					   'version' => '2.0');

//以下为系统配置，请勿修改
$config['model'] = array('home' => '系统首页',
						 'login' => '管理员登陆',
				         'user' => '用户信息',
				         'room' => '科室管理',
				         'doctor' => '医生',
				         'patient' => '患者',
				         'record' => '预约记录',
				         'about' => '关于',
						 'code' => '获取代码',
				         'set' => '系统设置');

$config['operate'] = array();

$config['gender'] = array('女','男');


?>