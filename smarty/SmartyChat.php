<?php

require_once('../libs/Smarty.class.php');
class SmartyChat extends Smarty{
	function __construct(){
		parent::__construct();
		$this->setTemplateDir('../smarty/templates/');
        $this->setCompileDir('../smarty/templates_c/');
        $this->setConfigDir('../smarty/configs/');
        $this->setCacheDir('../smarty/cache/');
		$smarty->cache_lifetime=60*60*12; //单位秒
        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
//        $this->assign('app_name', 'Guest Book');
        
	}


	
	
}

?>