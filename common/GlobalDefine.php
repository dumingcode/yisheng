<?php 
//require_once dirname(__FILE__).'/ErrorCode.php';
define('ROOT_PATH', dirname(__FILE__) . '/../');
define('DEFAULT_CHARSET', 'utf-8');
define('COMPONENT_VERSION', '1.0');
define('COMPONENT_NAME', 'wxmp');

//appid 和 secure id
define('APPID', 'wxca473ab02ae17cdb');
define('APPSECRET', '56aed9cdd48b180f2f9e511b09de3ec3');

//微信公众号名称 根据不同的公众号执行不同的逻辑
//这就解决了一套逻辑部署不同公众号的任务
define('USERNAME_FINDFACE', 'gh_fd4633de8852');
define('USERNAME_TEST', 'gh_324efd37b979');
define('USERNAME_TANFANG', "gh_6828e47090da");
define('USERNAME_MYZL', "gh_XXX");

//关闭NOTICE错误日志
error_reporting(E_ALL ^ E_NOTICE);



define('WX_API_URL', "https://api.weixin.qq.com/cgi-bin/");
define('WX_API_MENU_URL' , 'https://api.weixin.qq.com/cgi-bin/menu/create');
define('WX_API_TICKET_URL' ,"https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=");
define('WX_API_APPID', "");
define('WX_API_APPSECRET', "");
define('NONCESTR','Wm3WZYTPz0wzccnW');

define("WEIXIN_TOKEN", "duming584521");
define("HINT_NOT_IMPLEMEMT", "未实现");

//text消息模板
define('HINT_TPL', "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>
");


//微网页的url 
define('WAP_ROOT_URL' , "www.jakecode.pub/bin/");

define('SUBSCRIBE_TPL',"<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
 <MsgType><![CDATA[news]]></MsgType>
<ArticleCount>3</ArticleCount>
<Articles>
<item>
<Title><![CDATA[探房网]]></Title> 
<Description><![CDATA[探房网]]></Description>
<PicUrl><![CDATA[www.tanfang.wang/dist/img/wx_index.jpg]]></PicUrl>
<Url><![CDATA[www.tanfang.wang/wap]]></Url>
</item>
<item>
<Title><![CDATA[在售房源]]></Title> 
<Description><![CDATA[在售房源]]></Description>
<PicUrl><![CDATA[https://mp.weixin.qq.com/cgi-bin/getimgdata?token=2143808976&msgid=&mode=large&source=file&fileId=200599085&ow=-1/]]></PicUrl>
<Url><![CDATA[www.tanfang.wang/wap/wapsell.php]]></Url>
</item>
<item>
<Title><![CDATA[成交房源]]></Title> 
<Description><![CDATA[成交房源]]></Description>
<PicUrl><![CDATA[https://mp.weixin.qq.com/cgi-bin/getimgdata?token=2143808976&msgid=&mode=large&source=file&fileId=200599084&ow=-1/]]></PicUrl>
<Url><![CDATA[www.tanfang.wang/wap/wapsold.php]]></Url>
</item>
</Articles>
</xml>");

//提示用户进行抽奖
define('LOTTERY_TPL',"<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
 <MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[抽奖]]></Title> 
<Description><![CDATA[刮开涂层,将验证码在本窗口输入并发送,即可参与抽奖。点击了解更多活动详情]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>");



//图文模板 提示用户已经领取过优惠券 不能再次领取
define('HAVE_RECEIVED_CODE_TPL',"<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[已领取过]]></Title> 
<Description><![CDATA[不能再次领取]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>");


//图文模板  提示用户已经成功领取过优惠券 显示领取的优惠券
define('RECEIVE_CODE_SUCCESS_TPL',"<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[成功领取]]></Title> 
<Description><![CDATA[成功领取]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>");

//图文模板  提示用户抽奖模块抽中实物奖品
define('LOTTERY_COUPON_TPL',"<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[%s]]></Title> 
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>");



//图文模板  提示用户领取失败 或者红包已领取完毕
define('RECEIVE_CODE_FAILED_TPL',"<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[红包抢光了]]></Title> 
<Description><![CDATA[红包抢光了]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>");

//图文模板  提示用户没抽中奖品
define('LOTTERY_COUPON_FAILED_TPL',"<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[谢谢参与]]></Title> 
<Description><![CDATA[抱歉,没抽到奖品]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>");


//图文模板此激活码有效 提醒用户兑换券
define('CODE_ACTIVATE_TPL',"<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
 <MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[此码有效，点击兑换优惠券]]></Title> 
<Description><![CDATA[此码有效，点击兑换优惠券]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>");

$GLOBALS['DB'] = array(
	'DB' => array(
		'HOST' => 'localhost',
		'DBNAME' => 'yisheng',
		'USER' => 'root',
		'PASSWD' => 'piccsk1234',
		'PORT' => 3306 
	),
	'MR' => array(
		'HOST' => 'localhost',
		'DBNAME' => 'mr',
		'USER' => 'root',
		'PASSWD' => 'root',
		'PORT' => 3306 
	),
	'MYZL' => array(
		'HOST' => 'localhost',
		'DBNAME' => 'myzl',
		'USER' => 'itil',
		'PASSWD' => 'itil',
		'PORT' => 3306
	)
);

//定义商品上粘贴的二维码scene id
//暂时规定兑换券的二维码只有唯一一个
define("CONSUME_COUPONS",'8889');


/**
 * coding for coupons
 */
define("COUPONS", "coupons");
define("USED_COUPONS", "usedcoupons");
define("STORE_NAME" , 'diandiantong');
define("COUPON_MONEY",1);//奖品是现金
define("COUPON_GOOD",2);//奖品是实物
define("COUPON_VIRTUAL",3);//奖品是虚拟券

//定义每个商家的优惠券红包规则
//count表示奖项的个数
//no表示奖项名次  最高是一等奖
//type表示奖品
//sum表示奖项的总数
//couponnum 表示奖项个数
//money表示领取的红包金额 实物奖品此值为0
//limit表示每种奖品同一个用户能够领取的最多个数

$GLOBALS['rule'] = array(
		USERNAME_TEST => array(
            "sum"=>100000,
            "couponnum"=>4,
            "coupon"=>array(
            "0"=>array("couponname"=>"iphone6 plus","money" =>0,"count"=>'3',"no"=>1,"type"=>COUPON_GOOD,"limit"=>1,"validdate"=>'2015-12-31 23:59:59'),
		    "1"=>array("couponname"=>"5元现金","money" =>5,"count"=>'100',"no"=>2,"type"=>COUPON_VIRTUAL,"limit"=>1,"validdate"=>'2015-12-31 23:59:59'),
            "2"=>array("couponname"=>"3元现金","money" =>3,"count"=>'1000',"no"=>3,"type"=>COUPON_VIRTUAL,"limit"=>1,"validdate"=>'2015-12-31 23:59:59'),
            "3"=>array("couponname"=>"1元现金","money" =>1,"count"=>'98897',"no"=>4,"type"=>COUPON_VIRTUAL,"limit"=>10,"validdate"=>'2015-12-31 23:59:59')
            )
		)
		
);

//抽奖模块奖品列表 抽奖模块中奖率低一些
//定义每个商家的优惠券红包规则
//count表示奖项的个数
//no表示奖项id  同一家商户的奖品
//type表示奖品
//sum表示奖项的总数
//couponnum 表示奖项个数
//money表示领取的红包金额 实物奖品此值为0
//limit表示每种奖品同一个用户能够领取的最多个数

$GLOBALS['lottery'] = array(
		USERNAME_TEST => array(
            "sum"=>130000,
            "couponnum"=>4,
            "coupon"=>array(
            "0"=>array("couponname"=>"iphone6 plus","money" =>0,"count"=>'3',"no"=>5,"type"=>COUPON_GOOD,"limit"=>1,"validdate"=>'2015-12-31 23:59:59'),
		    "1"=>array("couponname"=>"5元优惠券","money" =>5,"count"=>'100',"no"=>6,"type"=>COUPON_VIRTUAL,"limit"=>1,"validdate"=>'2015-12-31 23:59:59'),
            "2"=>array("couponname"=>"3元优惠券","money" =>3,"count"=>'80000',"no"=>7,"type"=>COUPON_VIRTUAL,"limit"=>1,"validdate"=>'2015-12-31 23:59:59'),
            "3"=>array("couponname"=>"1元现金","money" =>1,"count"=>'98897',"no"=>8,"type"=>COUPON_MONEY,"limit"=>10,"validdate"=>'2015-12-31 23:59:59')
            )
		)
		
);



//优惠券
define('COUPON_HINT_NOT_ENOUGH', "抱歉!优惠券已经被领完了!");
define('COUPON_HINT_HAVA_RECEIVED', "您已经领取过券不能再次领取!");
define('COUPON_HINT_ERROR_RECEIVED', "优惠券领取失败!");
define('COUPON_HINT_SUCCESS_RECEIVED', "优惠券领取成功!");
define('COUPON_HINT_NOT_RECEIVED', "抱歉!您之前未领取优惠券,无法兑换红包!");

//红包
define('COUPON_HINT_CONSUME_SUCCESS', "恭喜!您已经成功领取红包");
define('COUPON_HINT_CONSUME_FAILED', "抱歉!领取红包失败");
define('COUPON_HINT_CONSUME_SUCCESS_MULTI', "恭喜!您已经成功领取红包,红包已领取个数");
define('COUPON_HINT_HAVE_CONSUMED', "您已经兑换过优惠券!");

//激活码
define('COUPON_HINT_CODE_NOTICE', "您账户上有优惠券可兑换,刮开涂层,输入验证码即可兑换.兑换优惠券的用户不能参与抽奖");
define('COUPON_HINT_CODE_HAVE_CONSUMED', "此码已参与过活动,无法再次参与!");
define('COUPON_HINT_CODE_NOTVALID', "此码为无效码,请仔细核对输入是否输入有误,然后再试一次!");
//define('COUPON_HINT_CODE_VALID', "此码为无效码,请仔细核对输入是否输入有误,然后再试一次!");
define('COUPON_HINT_CODE_FAILED', "抱歉!系统繁忙,激活码兑换失败!");

//激活码是否已经使用
define('CODE_USED',0);
define('CODE_NOT_USED',1);


/**
 * 怡生制暖
 */


//怡生激活码是否已经使用
define('YS_IS_VALID',1);
define('YS_NOT_VALID',0);


?>
