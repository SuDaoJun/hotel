<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta content="宾馆管理" name="keywords"/>
<meta content="宾馆展示" name="description"/>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<title>订单查询</title>
</head>
<body >
<div>
<?php
require("head.html");
?>
<div class="internal-page-title about-page">
<h1>订单查询</h1>
<ol class="breadcrumb">
<li><i class="fa fa-map-marker"></i> &nbsp;<span>当前位置： <a href="index.php">网站首页</a> &gt <a href="order_query.php">订单查询</a></span></li>
</ol>
</div>

<div class="booking-page-content">
<div class="booking-container container">

<div class="heading-box">
<h2>订单 <span>查询</span></h2>
</div>
<form method="post" action="order_query.php" name="bookform" id="book-form">
<div class="tab-content">
	<div class="rows3 clearfix">
		<div class="date-container booking-dates">
			<span>查询条件</span>
			<select name="search-type" class="sel" id="">
				<option value="roomid" selected="">房间号</option>
				<option value="linkman">姓名</option>
				<option value="phone">联系电话</option>
			</select>
		</div>
		
		<div class="date-container key">
			<span>关键字</span>
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
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$(".nav_2").addClass("active");
});
</script>

</body>
</html>
