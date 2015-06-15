$("#ajax_phone_code").bind('click',function(){
	var phone = $("#phone").val();
	var ajax_phone_code = $("#ajax_phone_code");
	if(phone ==''){
		$(this).next(".error").html("手机号不能为空");
		$("#phone").focus();
		return false;
	}

	$.ajax({ 
		type:"POST", 
		url:"/home/user/getmobilecode", 
		data:"phone="+$("#phone").val()+"&user_id="+$("#user_id").val(), 
		success:function(result){
			var results = eval('('+result+')');
			if(results.status == '1'){
			  	var wait=60;
			  	var timeID=setInterval(function(){
				  	if(wait==-1){
					   clearInterval(timeID);
					   ajax_phone_code.removeClass('get_verty_btn_dis');
					   ajax_phone_code.val("获取验证码");
					   ajax_phone_code.removeAttr("disabled");
					}else{
					   ajax_phone_code.val(wait+"秒后重新发送");wait--;
					   ajax_phone_code.attr("disabled",true);
					   ajax_phone_code.addClass('get_verty_btn_dis');
					}
				},1000);
			}else{
				ajax_phone_code.next(".error").html(results.msg);
			}
		}
	});
});