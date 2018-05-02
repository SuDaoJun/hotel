<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta content="宾馆管理" name="keywords"/>
<meta content="宾馆展示" name="description"/>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="css/styles.css" rel="stylesheet" type="text/css"/>
<link href="css/index.css" rel="stylesheet" type="text/css"/>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$("#main-menu #nav_44").addClass("active");
});
</script>
<title>订单查询</title>
</head>
<style>
	#booking-page-content .booking-container .heading-box{
		margin-bottom: 0;
	}
	#booking-tab-contents input[type="text"]{
		width: 58%;
		height: 38px;
		 
	}
	#booking-tab-contents select{
	width: 58% !important;
	}
	.chosen-container{
		width: 58% !important;
	}
	#booking-tab-contents span{
		font-size: 20px;
	    color: #C5A46D;
	    line-height: 38px;
	    text-align: center;
    	display: inline-block;
    	margin-right: 8px;
	}
	.ss{
		margin-left: 30px;
		height: 38px;
		color: #fff;
		background-color: #C5A46D;
		border-color: #C5A46D !important;
	}

	.ss:hover{
		background-color: skyblue;
		border-color: skyblue;
	}
	#top-footer{
		margin-top: 100px;
	}
	#booking-tab-contents{
		margin-bottom: 0;
		padding-bottom: 0;
	}
</style>
<body class="homepage trans-header sticky white-datepicker">
<div id="page-body-wrap">
<?php
require("head.html");
?>
<div class="internal-page-title about-page">
<h1>订单查询</h1>
<ol class="breadcrumb">
<li><i class="fa fa-map-marker"></i> &nbsp;<span>当前位置： <a href="index.php">网站首页</a> &gt <a href="order_query.php">订单查询</a></span></li>
</ol>
</div>

<div id="booking-page-content">
<div class="booking-container container">

<div class="heading-box">
<h2>订单 <span>查询</span></h2>
</div>
<form method="post" action="order_query.php" name="bookform" id="book-form">
<div id="booking-tab-contents" class="tab-content">
	<div class="row">
		<div class="date-container booking-dates col-xs-12 col-sm-6 col-md-4 col-lg-6 text-center">
			<span><b>查询条件</b></span>
			<select name="search-type" class="sel" id="">
				<option value="roomid" selected="">房间号</option>
				<option value="linkman">姓名</option>
				<option value="phone">联系电话</option>
			</select>
		</div>
		
		<div class="date-container booking-dates col-xs-12 col-sm-6 col-md-4 col-lg-6">
			<span><b>关键字</b></span>
				<input  value='' placeholder="请输入相应关键字" type="text"  name="keywords"  />
				<input class="btn btn2 ss" name="sub" value="查询" type="submit">
		</div>
				
	</div>

	</div>
	</form>
	<table class="result-tab" width="100%">
			     <tr>
              <th class="tc">订单流水</th>
              <th class="tc">房间号</th>
              <th class="tc">入住时间</th>
              <th class="tc">住宿天数</th>
              <th class="tc">消费金额</th>
              <th class="tc">房间类型</th>
              <th class="tc">顾客姓名</th>
              <th class="tc">联系电话</th>
              <th class="tc">备注信息</th>
              <th class="tc">网上预定</th>
              <th class="tc">完成交易</th>
            </tr>
            <?php
              require("dbconnect.php");
  
              $sql = "select a.orderid,a.roomid,a.entertime,a.days,a.monetary,b.typename,a.linkman,a.phone,a.messages,a.ostatus,a.oremarks from orders a,roomtype b where a.typeid=b.typeid and a.".@$_POST["search-type"]." like ('%".@$_POST["keywords"]."%')";
              $rs=mysqli_query($db_link,$sql);
              if($rs){
              $s=mysqli_num_rows($rs);
              }else{
                $s=0;
              }
              if(!$s)
              {
                  echo "无满足条件的记录，请继续查询！";
              }else{
              	while($rows=mysqli_fetch_assoc($rs))
              {
              	?>             
                <tr>
                <td class='tc'><?php echo $rows["orderid"] ?></td>
                <td class='tc'><?php echo $rows["roomid"] ?></td>
                <td class='tc'><?php echo $rows["entertime"] ?></td>
                <td class='tc'><?php echo $rows["days"] ?></td>
                <td class='tc'><?php echo $rows["monetary"] ?></td>
                <td class='tc'><?php echo $rows["typename"] ?></td>
                <td class='tc'><?php echo $rows["linkman"] ?></td>
                <td class='tc'><?php echo $rows["phone"] ?></td>
                <td class='tc'><?php echo $rows["messages"] ?></td>
                <td class='tc'><?php echo $rows["ostatus"] ?></td>
                <td class='tc'><?php echo $rows["oremarks"] ?></td>
                              
                </tr>
            <?php } ?>
           <?php } ?>
            
  </table>
</div>
</div>


<?php
require("footer.html");
?>

</div>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
<script src="js/helper.js"></script>
<script type="text/javascript" src="js/template.js"></script>

</body>
</html>
