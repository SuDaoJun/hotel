<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>宾馆后台管理</title>
  <link rel="stylesheet" type="text/css" href="css/common.css"/>
  <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
  <div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
      <div class="topbar-logo-wrap clearfix">
        <ul class="navbar-list clearfix">
          <li><a class="on" href="admin_index.php"><i class="icon-font">&#xe622;</i> 网站后台</a></li>
          <li><a href="../index.php" target="_blank"><i class="icon-font">&#xe681;</i> 网站首页</a></li>
        </ul>
      </div>
      <div class="top-info-wrap">
        <ul class="top-info-list clearfix">
          <li><i class="icon-font">&#xe607;</i> 登录用户：
            <?php 
            session_start(); 
            if($_SESSION["aname"]){
              echo $_SESSION["aname"]; 
            }else{
              header("location:index.php");
              exit;
            } 
            ?>
            </li>
          <li><a href="admin_logout.php"><i class="icon-font">&#xe638;</i> 退出</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container clearfix">
    <?php
    require("leftArea.html");
    ?>
    <!--/sidebar-->
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">退房清算</span></div>
      </div>
      <div class="search-wrap">
        <div class="search-content">
          <form action="admin_checkout.php" method="post">
            <table class="search-tab">
              <tr>
                <th width="200"></th>
                <th width="120">请输入房间号</th>
                <td><input class="common-text" placeholder="请输入房间号" name="roomid" value="" id="" type="text"></td>
                <td><input  name="sub" value="查询" type="submit"></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
      <div class="result-wrap">
        <div class="result-content">
          <table class="result-tab" width="100%">         
          <tr>
             <th class='tc'>顾客姓名</th>
             <th class='tc'>证件号码</th>
             <th class='tc'>联系电话</th>
             <th class='tc'>备注信息</th>
          </tr>
              <?php
              require("../dbconnect.php");
              $sql = "select * from orders where  oremarks='是' and roomid = '".@$_POST["roomid"]."'";
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
                echo "顾客信息如下，请确认：";
              while($rows=mysqli_fetch_assoc($rs)) 
              { ?>
               <tr>
                <td class='tc'><?php echo $rows["linkman"] ?></td>
                <td class='tc'><?php echo $rows["cardid"] ?></td>
                <td class='tc'><?php echo $rows["phone"] ?></td>
                <td class='tc'><?php echo $rows["messages"] ?></td>
              </tr>
            <?php } ?>
          <?php } ?>
          </table>
          <table class="result-tab" width="100%">         
          <tr>
             <th class='tc'>订单流水号</th>
             <th class='tc'>房间号</th>
             <th class='tc'>入住时间</th>
             <th class='tc'>备注信息</th>
             <th class='tc'>住宿天数</th>
             <th class='tc'>房间类型</th>
             <th class='tc'>房间价格</th>
             <th class='tc'>消费金额</th>
             <th class='tc'>网上预订</th>
             <th class='tc'>交易完成</th>
          </tr>
           <?php
              require("../dbconnect.php");
              $sql = "select a.orderid,a.roomid,a.entertime,a.messages,a.monetary,a.days,b.typename,b.price,a.ostatus,a.oremarks,a.typeid from orders a,roomtype b where a.typeid=b.typeid and a.oremarks='是' and a.roomid = '".@$_POST["roomid"]."'";
              $rs=mysqli_query($db_link,$sql);
              if($rs){
              $s=mysqli_num_rows($rs);
              }else{
                $s=0;
              }
              if(!$s)
              {
                  echo "无满足条件的记录，请查询！";
              }else{
                echo "入住信息如下，请确认：";
                while($rows=mysqli_fetch_assoc($rs))
              {
                ?>                            
                <tr>
                <td class='tc'><?php echo $rows["orderid"] ?></td>
                <td class='tc'><?php echo $rows["roomid"] ?></td>
                <td class='tc'><?php echo $rows["entertime"] ?></td>
                <td class='tc'><?php echo $rows["messages"] ?></td>
                <td class='tc'><?php echo $rows["days"] ?></td>
                <td class='tc'><?php echo $rows["typename"] ?></td>
                <td class='tc'><?php echo $rows["price"] ?></td>
               <td class='tc'><?php echo $rows["monetary"] ?></td>
                <td class='tc'><?php echo $rows["ostatus"] ?></td>
                <td class='tc'><?php echo $rows["oremarks"] ?></td>
                              
                </tr>

          </table>
          <a href='update.php?crid=<?php echo $rows["roomid"] ?>&typeid=<?php echo $rows["typeid"] ?>&orderid=<?php echo $rows["orderid"] ?>'  class='link-update tf'>确认退房</a>

            <?php } ?>
           <?php } ?>
        </div>
      </div>
    </div>
    <!--/main-->
</div>
</body>
</html>