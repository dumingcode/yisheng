<?php
/**
 * 此文件主要负责将数据库中的渠道信息展示出来
 */
header("Content-Type: text/html; charset=utf-8");
require_once('../manager/YiShengManager.php');
require_once('../smarty/SmartyChat.php');



//初始化怡生数据库操作manager
$yiShengManager = new YiShengManager();
$yiShengManager->initialize();
$retInfo = $yiShengManager->queryChannelInfo();
$smartyChat = new SmartyChat();
$smartyChat->assign('channels',$retInfo);
$smartyChat->caching=false;
$smartyChat->display('channel.tpl');



?>