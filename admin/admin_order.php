﻿<!doctype html>
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
      $sql="select a.roomid,b.typeid,b.typename,b.price from room a,roomtype b where a.typeid=b.typeid and a.roomid='".$_GET["orid"]."'";
      $arr=mysqli_query($db_link,$sql);
      $rows=mysqli_fetch_row($arr);
    ?>
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">大堂入住</span></div>
      </div>
      <div class="result-wrap">
        <form id="myform" name="myform" method="post" action="insert.php">
        <ul class='order'>
          <li>
            <label for="roomid">房间编号&emsp;</label>
            <input name="roomid" type="text" class='jz' readonly id="roomid" value="<?php echo $_GET["orid"] ?>" size="15" maxlength="20" />
          </li>
          <li>
            <label for="typeid">类型编号&emsp;</label>
            <input class='jz' name="typeid" type="text" id="typeid" readonly value="<?php echo $rows[1] ?>" size="15" maxlength="20" />
          </li>
          <li>
            <label for="typename">类型名称&emsp;</label>
            <input class='jz' name="typename" type="text" id="typename" readonly value="<?php echo $rows[2] ?>" size="15" maxlength="20" />
          </li>
          <li>
            <label for="price">房间价格&emsp;</label>
            <input class='jz' name="price" type="text" id="price" readonly value="<?php echo $rows[3].'元/天' ?>" size="15" maxlength="20" />
          </li>
          <li>
            <label for="cname">顾客姓名&emsp;</label>
            <input name="name" type="text" required placeholder="请输入客户姓名" id="cname" size="15" maxlength="30" />
          </li>
          <li>
            <label for="cardid">证件号码&emsp;</label>
            <input placeholder="请输入身份证号码" required name="card" type="text" id="cardid" size="30" maxlength="50" />
          </li>
          <li>
            <label for="entertime">入住时间&emsp;</label>
            <input name="checkin" type="text" id="entertime"  value=<?php echo date("Y-m-d"); ?> size="30" maxlength="50" />
          </li>
          <li>
            <label for="leavetime">离开时间&emsp;</label>
            <input name="checkout" type="text" id="leavetime" required placeholder="选择离开日期" size="30" maxlength="50" />
          </li>
          <li>
            <label for="phone">联系电话&emsp;</label>
            <input name="phone" type="text" id="phone" required placeholder="请输入联系电话" size="30" maxlength="50" />
          </li>
          <li>
            <label for="message-field">订单备注&emsp;</label>
            <textarea id="message-field" placeholder="备注信息..." name="content"></textarea>
          </li>
          <li>
            <input type="reset" class='reset' name="submit2" id="button2" value="重置" />
            <input type="hidden" name="action" value="inserto">
            <input type="submit" name="submit" id="button" value="确认入住" />
          </li>

        </ul>
        </form>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>