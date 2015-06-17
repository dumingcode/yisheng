<?php
/**
 * 此文件主要负责将渠道各个字段值插入数据库
 */
header("Content-Type: text/html; charset=utf-8");
require_once('../manager/YiShengManager.php');
require_once('../smarty/SmartyChat.php');

//渠道名称
if(isset($_POST['channelId'])){
	$channelId=$_POST['channelId'];
}else {
	$channelId="";
}



//初始化怡生数据库操作manager
$yiShengManager = new YiShengManager();
$yiShengManager->initialize();

$channelData = array(
   "channelId"=>$channelId
);
$retInfo = $yiShengManager->delChannelInfo($channelData);

echo $retInfo;

//$smartyChat = new SmartyChat();
//if($retInfo)
//  $smartyChat->assign("info",'添加成功');
//else 
//  $smartyChat->assign("info",'添加失败');
//  $smartyChat->display("admin.html");
  exit;



?>