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
    <?php
      require("../dbconnect.php");
      $sql="select a.orderid,a.roomid,a.cardid,a.entertime,a.days,b.typename,a.linkman,a.phone,a.ostatus,a.oremarks,a.messages,b.typeid,a.monetary from orders a,roomtype b where a.typeid=b.typeid and a.orderid='".$_GET["orderid"]."'";
      $arr=mysqli_query($db_link,$sql);
      $rows=mysqli_fetch_row($arr);
    ?>
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_queryo.php">入住查询</a><span class="crumb-step">&gt;</span><span class="crumb-name">订单修改</span></div>
      </div>
      <div class="result-wrap">
        <form id="myform" name="myform" method="post" action="update.php">
        <ul class='order'>
          <li>
            <label for="orderid">订单流水&emsp;</label>
            <input name="orderid" type="text" required   id="orderid" value="<?php echo $rows[0] ?>" size="15" maxlength="20" />
          </li>
          <li>
            <label for="roomid">房间编号&emsp;</label>
            <input  name="roomid" required type="text" id="roomid"  value="<?php echo $rows[1] ?>" size="15" maxlength="20" />
          </li>
          <li>
            <label for="linkman">顾客姓名&emsp;</label>
            <input  name="linkman" required type="text" id="linkman"  value="<?php echo $rows[6] ?>" size="15" maxlength="20" />
          </li>
          <li>
            <label for="days">住宿天数&emsp;</label>
            <input name="days" type="text" id="leavetime" required value='<?php echo $rows[4] ?>'  size="15" maxlength="2" />
          </li>
          <li>
            <label for="phone">联系电话&emsp;</label>
            <input name="phone" type="text" required value='<?php echo $rows[7] ?>'  id="phone" size="15" maxlength="30" />
          </li>
          <li>
            <label for="monetary">消费金额&emsp;</label>
            <input name="monetary" type="text" required value='<?php echo $rows[12] ?>'  id="monetary" size="15" maxlength="30" />
          </li>
          <li>
            <label for="cardid">证件号码&emsp;</label>
            <input  name="cardid" required type="text" id="cardid"  value="<?php echo $rows[2] ?>" size="30" maxlength="30" />
          </li>
          <li>
            <label for="entertime">入住时间&emsp;</label>
            <input name="entertime" type="text" id="entertime"  value=<?php echo $rows[3] ?> size="30" maxlength="50" />
          </li>
          <li>
            <label for="messages">备注信息&emsp;</label>
            <textarea id="messages" required  maxlength="50"  name="content"><?php echo $rows[10] ?></textarea>
          </li>
          <li>
            <input type="reset" class='reset' name="submit2" id="button2" value="重置" />
            <input type="hidden" name="typeid" value="<?php echo $rows[11] ?>">
            <input type="hidden" name="action" value="dmod">
            <input type="submit" name="submit" id="button" value="确定" />
          </li>

        </ul>
        </form>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>
