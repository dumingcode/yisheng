<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>怡生后台管理页面</title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../dist/css/signin.css" rel="stylesheet">

   

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script language="javascript" type="text/javascript" src="../dist/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../dist/js/bootstrap.min.js"></script>    
<script language="javascript" type="text/javascript" src="../dist/myjs/yisheng.js"></script>    

<script type="text/javascript">
$(document).ready(function(){
	showChannelInit();
});
</script>
  
  </head>

  <body>
     
    <div class="container">
    <center><h2 class="lead">怡生--渠道列表</h2></center>
      
      <table class="table  table-condensed table-bordered display">
        <thead>
         <tr>
             <td><label class="control-label">渠道名称</label></td>
             <td><label class="control-label">卡券名称</label></td>
             <td><label class="control-label">卡券ID</label></td>
             <td><label class="control-label">链接</label></td>
             <td><label class="control-label">操作</label></td>
         </tr>
        </thead>
        <tbody>
      		{foreach name=outer item=channel from=$channels}  
				<tr>
				   <td>{$channel.channel_name}</td>
				   <td>{$channel.coupon_id}</td>
				  <td>{$channel.coupon_name}</td>
				  <td></td>
				  <td>
				     <a class="delChannel" href="#" rel="{$channel.channel_id}">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
				     <a href="#">编辑</a></td>
				</tr>   
                      
            {/foreach}
        </tbody>
       </table>
       
       <div id="tip"></div>
    </div> <!-- /container -->

   <div class="content container_12" >
       <div id="footer">
          <center> 
            <a href="admin.html"><strong>添加渠道页面</strong></a><label></label>        
          </center>
      </div>
     
 </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
  
</html>
