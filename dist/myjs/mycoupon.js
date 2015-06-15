

 $(document).on('click', '.radio', function () {
	 couponId = $(this).attr("id");
	  
 });

 $(document).on('click', '#couponConsume', function () {
	 
	 var postdata='couponId='+couponId+'&username='+username+'&code='+code+'&storeWxId='+storeWxId;
	 
     $.ajax({
         type:'post',
         url:'../bin/consumeCoupon.php',
         data:postdata,
         dataType: 'post',
         cache: false,
         beforeSend: function(XMLHttpRequest){
             //$("#ajax-loader").show();
         },
         complete: function(XMLHttpRequest, textStatus){
             //$("#ajax-loader").hide();
        	 alert('complete');  
        	 window.location.href='www.jakecode.pub/bin/couponInfo.php?info=1'; 
         },
         error: function() {
             //$("#results").append('<div class="result">'+'本站服务器繁忙，请稍后再试。'+'</div>');
         },
         success: function(json) {
	         alert('suc');  
        	 window.location.href='www.jakecode.pub/bin/couponInfo.php?info=1'; 
         }
     }); 
  });
