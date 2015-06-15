$(function(){

/*验证方法*/
	//验证手机号
	var checkTelFlag = false;
	function checkTel(obj){
		var $thisObj = $(obj);
		var tel = $.trim($thisObj.val());
		if(tel == ""){
			$thisObj.parents(".iptItem").find(".msg").text("手机号不能为空");
			checkTelFlag = false;
		}else if(tel.search(/^1[0-9]{10}$/) == -1){
			$thisObj.parents(".iptItem").find(".msg").text("手机号输入有误，请重新输入");
			checkTelFlag = false;
		}else{
			$thisObj.parents(".iptItem").find(".msg").text("");
			checkTelFlag = true;
		}
	}
	
	//验证不能为空
	var checkNullFlag = false;
	function checkNull(obj,msg){
		var $thisObj = $(obj);
		var val = $.trim($thisObj.val());
		if(val == ""){
			$thisObj.parents(".iptItem").find(".msg").text(msg);
			checkNullFlag = false;
		}else{
			$thisObj.parents(".iptItem").find(".msg").text("");
			checkNullFlag = true;
		}
	}

/*验证方法end*/

	//点击获取验证码倒计时
	var sendTime = 120;
	function sendDelayTime(){
		sendTime--;
		if(sendTime == 0){
			sendTime = 121;
			$(".sendVerifyCode").removeClass("sendUnclick");
			$(".sendVerifyCode").text("获取验证码");
			return null;
		}
		$(".sendVerifyCode").addClass("sendUnclick");
		$(".sendVerifyCode").text("已发送（" + sendTime + "秒）");
		setTimeout(sendDelayTime,1000);
	}
	
/*验证手机页面*/
	
	//点击获取验证码
	$(".verifyTel .sendVerifyCode").click(function(){
		var $this = $(this);
		var tel = $.trim($(".verifyTel .tel").val());
		checkTel(".verifyTel .tel");
		if(checkTelFlag && !$this.hasClass("sendUnclick")){
			$.ajax({
				 url: "/home/user/getmobilecode",
				 dataType: "json",
				 type: 'POST',
				 data: "phone="+$("#phone").val()+"&openid="+$("#openid").val(), 
				 success: function(data){
					if(data.status == 1){
						sendDelayTime();
					}else{
						$this.parents(".iptItem").find(".msg").text(data.msg);
					}				    	
				},
				error: function(){
					$this.parents(".iptItem").find(".msg").text("服务器错误");
				}
			});
		}
	});


	
	//输入验证码，点击确认，提交
	$(".verifyTel .confirmBtn").click(function(){
		var $this = $(this);
		var code = $.trim($(".verifyTel .vCodeIpt").val());
		checkNull(".verifyTel .vCodeIpt","验证码不能为空");
		if(checkNullFlag == false){
			return false;
		}
	});
	
	
/*验证手机页面end */


/*手机充值页面*/
	
	$(".recharge .rechargeBtn").click(function(){
		var $this = $(this);
		var tel = $.trim($(".recharge .tel").val());
		checkTel(".recharge .tel");
		if(checkTelFlag){
		
		//将以下3行代码删除，换为下面注释的ajax
		$(".recharge .recharge1").hide();
		$(".recharge .successBlock .scsTel").text(tel);
		$(".recharge .successBlock").show();
		/*
			$.ajax({
				 url: "",
				 dataType: "json",
				 type: 'POST',
				 data: {
					 tel:tel
				 },
				 success: function(data){
					if(data.code == 1){
						$(".recharge .recharge1").hide();
						$(".recharge .successBlock .scsTel").text(tel);
						$(".recharge .successBlock").show();
					}else{
						$(".recharge .recharge1").hide();
						$(".recharge .errorBlock").show();
					}				    	
				},
				error: function(){
					$(".recharge .recharge1").hide();
					$(".recharge .errorBlock").show();
				}
			 });
			*/
		}
		
	});
	
	//充值失败 再试一次
	$(".recharge .againBtn").click(function(){
		$(".recharge .recharge1").show();
		$(".recharge .errorBlock").hide();
	});

/*手机充值页面end*/
	
	
	
});