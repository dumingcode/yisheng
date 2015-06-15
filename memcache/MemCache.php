<?php

   class MemCaches{
   	public $mem;
   	
   	function __construct(){
   		
   	    $this->mem = new Memcache;
	    $this->mem->connect("127.0.0.1", 11211);
   	
   	}
   	
   	
   	//向memcache中存入变量 delay表示生效时间 单位分钟
   	function set($key , $value , $delay){
   		$this->mem->set($key, $value, MEMCACHE_COMPRESSED, $delay); //时间为12分钟
   		
   	}
   function add($key , $value , $delay){
   		$this->mem->add($key, $value, MEMCACHE_COMPRESSED, $delay); //时间为12分钟
   		
   	}
   	//向memcache中取回key值
   	
   	function get($key){
   		$var = $this->mem->get($key);
   		return $var;
   	}
   	
   	
   }



?>