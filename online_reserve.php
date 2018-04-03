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
$("#main-menu #nav_43").addClass("active");
});
</script>
<title>在线预订</title>
</head>

<body class="homepage trans-header sticky white-datepicker">
<div id="page-body-wrap">
<?php
require("head.html");
?>
<div class="internal-page-title about-page">
<h1>宾馆预订</h1>
<ol class="breadcrumb">
<li><i class="fa fa-map-marker"></i> &nbsp;<span>当前位置： <a href="index.php">网站首页</a> &gt <a href="online_reserve.php">宾馆预订</a></span></li>
</ol>
</div>

<div id="booking-page-content">
<div class="booking-container container">

<div class="heading-box">
<h2>空闲 <span>房间</span></h2>
</div>
  <table class="result-tab" width="100%">
			     <tr>
              <th class="tc">房间编号</th>
              <th class="tc">类型编号</th>
              <th class="tc">类型名称</th>
              <th class="tc">房间面积</th>
              <th class="tc">网络</th>
              <th class="tc">电视</th>
              <th class="tc">价格</th>
              <th class="tc">操&emsp;&emsp;作</th>
            </tr>
            <?php
              require("dbconnect.php");
              $pagesize = 10;
              $sql = "select a.roomid,b.typeid,b.typename,b.area,b.hasNet,b.hasTV,b.price from room a,roomtype b where a.typeid=b.typeid and a.status='否' and b.leftnum>0 and a.roomid not in (select roomid from orders where ostatus='是')";
              $rs=mysqli_query($db_link,$sql);
              if(!$rs)
              {
                  echo "抱歉，房间已满";
                  exit;
              }
              $recordcount=mysqli_num_rows($rs);
              $pagecount=($recordcount-1)/$pagesize+1;
              $pagecount=(int)$pagecount;
              $pageno=@$_GET["pageno"];
              if($pageno=="")
              {
                  $pageno=1;
              }
              if($pageno>$pagecount)
              {
                  $pageno=$pagecount;
              }
              $startno=($pageno-1)*$pagesize;
              $sql="select a.roomid,b.typeid,b.typename,b.area,b.hasNet,b.hasTV,b.price from room a,roomtype b where a.typeid=b.typeid and a.status='否' and b.leftnum>0 and a.roomid not in (select roomid from orders where ostatus='是') order by roomid asc limit $startno,$pagesize";
           
              $rs=mysqli_query($db_link,$sql);
              if(!$rs)
              {
                  echo "抱歉，房间已满";
                  exit;
              }
              while($rows=mysqli_fetch_assoc($rs))
              {  ?>
                <tr>
                <td class='tc'><?php echo $rows["roomid"] ?></td>
                <td class='tc'><?php echo $rows["typeid"] ?></td>
                <td class='tc'><?php echo $rows["typename"] ?></td>
                <td class='tc'><?php echo $rows["area"] ?></td>
                <td class='tc'><?php echo $rows["hasNet"] ?></td>
                <td class='tc'><?php echo $rows["hasTV"] ?></td>
                <td class='tc'><?php echo $rows["price"] ?></td>
                
                <td class='tc'>
                <a href='online_order.php?orid=<?php echo $rows["roomid"] ?>'  class='link-update'>在线预订</a>
                </td>
                </tr>

            <?php } ?>           
  </table>
  <div class="list-page">
      <?php
        if($pageno==1)
        {
          if($recordcount>$pagesize){
            echo "首页 | 上一页 | <a href='?pageno=".($pageno+1)."'>下一页</a> | <a href='?pageno=".$pagecount."'>末页</a>";
          }else{
            echo "首页 | 上一页 | 下一页 | 末页";
          }
          
        }
        else if($pageno==$pagecount)
        {
          echo "<a href='?pageno=1'>首页</a> | <a href='?pageno=".($pageno-1)."'>上一页</a> | 下一页 | 末页";
        }
        else
        {
          echo "<a href='?pageno=1'>首页</a> | <a href='?pageno=".($pageno-1)."'>上一页</a> | <a href='?pageno=".($pageno+1)."'>下一页</a> | <a href='?pageno=".$pagecount."'>末页</a>";
        }
        
        echo "&nbsp;&nbsp;页次：".$pageno."/".$pagecount."页&nbsp;共有".$recordcount."条信息";
      ?>
  </div>
</div>

</div>

<style>
	#top-footer{
		margin-top: 100px;
	}
</style>
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

