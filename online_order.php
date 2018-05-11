<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta content="宾馆管理" name="keywords"/>
<meta content="宾馆展示" name="description"/>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<script src="js/jquery.min.js" type="text/javascript"></script>
<title>在线预订</title>
</head>
<body>
<div class="page-body-wrap">
<?php
require("head.html");
?>
<div class="internal-page-title about-page">
<h1>宾馆预订</h1>
<ol class="breadcrumb">
<li><i class="fa fa-map-marker"></i> &nbsp;<span>当前位置： <a href="index.php">网站首页</a> &gt <a href="online_order.php">宾馆预订</a></span></li>
</ol>
</div>

<div class="booking-page-content">
<div class="booking-container container">

<div class="heading-box">
<h2>房间 <span>预订</span></h2>
</div>
<form method="post" action="insert.php" name="bookform" id="book-form">
<div class="booking-tab-contents clearfix" class="tab-content">
<?php
      require("dbconnect.php");
      $sql="select a.roomid,b.typeid,b.typename,b.price from room a,roomtype b where a.typeid=b.typeid and a.roomid='".$_GET["orid"]."'";
      $arr=mysqli_query($db_link,$sql);
      $rows=mysqli_fetch_row($arr);
 ?>
  <div class="rows">
		<div class="date-container booking-dates">
			<h4><b>房间编号</b></h4>
			<!-- 设置了disabled属性无法提交表单 -->
				<input readonly  type="text" value='<?php echo $_GET["orid"] ?>' id="roomid" name="roomid" class="room" />
		</div>
		
		<div class="date-container booking-dates">
			<h4><b>类型编号</b></h4>
				<input  readonly value='<?php echo $rows[1] ?>' type="text" id="typeid" name="typeid" class="room" />
		</div>
		<div class="date-container booking-dates">
			<h4><b>类型名称</b></h4>
				<input readonly type="text" value='<?php echo $rows[2] ?>' name="roomtype" class="room" />
		</div>
		
		<div class="date-container booking-dates">
			<h4><b>房间价格</b></h4>
				<input readonly id="price" type="text" value='<?php echo $rows[3] ?>元/天' name="price" class="room" />
		</div>
	</div>
	
	<div class="rows">
		<div class="date-container booking-dates">
			<h4><b>顾客姓名</b></h4>
				<input type="text" placeholder="请输入客户姓名" name="name" class="rooms" />
		</div>
		
		<div class="date-container booking-dates">
			<h4><b>身份证号码</b></h4>
				<input type="text" placeholder="请输入身份证号码" name="card" class="rooms" />
		</div>
		<div class="date-container booking-dates">
			<h4><b>联系电话</b></h4>
				<input type="text" placeholder="请输入联系电话" name="phone"  class="rooms" />
		</div>
		
		<div class="date-container booking-dates">
			<h4><b>备注信息</b></h4>
				<textarea id="message-field" placeholder="备注信息..." name="content"></textarea>
		</div>
	</div>
	
	<div class="rows rows2">
		<div class="date-container booking-dates">
			<h4><b>入住日期（Y-M-D）</b></h4>
			<div class="booking-fields data checkin-field">
				<input placeholder="选择入住日期Y-M-D格式" class="booking-date-fields-container check-in col-checkin" type="text" name="checkin" />
			</div>
		</div>
		
		<div class="date-container booking-dates">
			<h4><b>住宿天数</b></h4>
				<input type="text" placeholder="输入纯数字即可" name="days" maxlength='2'  class="days" />
		</div>
		<div class="date-container sys booking-dates">
			<img src="images/fk.png" width="120px" height="auto" alt=""><p>扫&emsp;一&emsp;扫</p>
		</div>
	</div>
	<div class="pane" id="booking-confirmation">
		<div class="field-container btn-field">
		  <input type="hidden" name="action" value="insert">
		<input type="button" class="btns" value="立即预订" id="booking-btn"> 
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
// 表单提交事件判断
$("#booking-btn").click(function() {
	var checkin = $("input[name='checkin']");
	var name = $("input[name='name']");
	var namecheck = /^[\u4e00-\u9fa5]{2,4}$/;
	var card = $("input[name='card']");
	var cardcheck =/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
	var phone = $("input[name='phone']");
	var phonecheck =  /^(((1[3456789][0-9]{1})|(15[0-9]{1}))+\d{8})$/;
	var days = $("input[name='days']");
	var dayscheck = /^[1-9]\d{0,1}$/;
	if(!(name.val() && card.val() && phone.val() && checkin.val())){
		alert("请完善预定相关信息");
		return false;
	}	
	if(!namecheck.test(name.val())){
	   alert('姓名填写有误');
	   name.val('');
	   name.focus();
	   return false;
	}
	if(!cardcheck.test(card.val())){
	   alert('身份证号填写有误');
	   card.val('');
	   card.focus();
	   return false;
	}
	if(!phonecheck.test(phone.val())){
	   alert('手机号填写有误');
	   phone.val('');
	   phone.focus();
	   return false;
	}
	if(!dayscheck.test(days.val())){
	   alert('住宿天数填写有误');
	   days.val('');
	   days.focus();
	   return false;
	}
	$("#book-form").submit();
});
function getNowFormatDate() {
        var date = new Date();
        var seperator1 = "-";
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = year + seperator1 + month + seperator1 + strDate;
        return currentdate;
    }
    var current = getNowFormatDate();
    $(".check-in").val(current);
</script>

</div>

</div>

<?php
require("footer.html");
?>

</div>
<script type="text/javascript">
$(function() {
$(".main-menu .nav_1").addClass("active");
});
</script>

<script type="text/javascript" src="js/main.js"></script>

</body>
</html>
