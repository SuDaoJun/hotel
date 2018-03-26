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
          <li><a class="on" href="admin_index.php">网站后台</a></li>
          <li><a href="../index.php" target="_blank">网站首页</a></li>
        </ul>
      </div>
      <div class="top-info-wrap">
        <ul class="top-info-list clearfix">
          <li>登录用户：<?php session_start(); echo $_SESSION["aname"]; ?></li>
          <li><a href="admin_logout.php"><i class="icon-font">&#xe9b6;</i>退出</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container clearfix">
    <div class="sidebar-wrap">
      <div class="sidebar-title">
        <h1>管理菜单</h1>
      </div>
      <div class="sidebar-content">
        <ul class="sidebar-list">
          <li>
            <a href="#">入住管理</a>
            <ul class="sub-menu">
              <li><a href="admin_addn.php"><i class="icon-font">&#xe960;</i>大堂入住</a></li>
              <li><a href="admin_addo.php"><i class="icon-font">&#xe960;</i>订单入住</a></li>
              <li><a href="admin_queryo.php"><i class="icon-font">&#xe986;</i>入住查询</a></li>
              <li><a href="admin_counto.php"><i class="icon-font">&#xe99a;</i>入住统计</a></li>
            </ul>
          </li>
          <li>
            <a href="#">退房管理</a>
            <ul class="sub-menu">
              <li><a href="admin_checkout.php"><i class="icon-font">&#xe994;</i>退房清算</a></li>
            </ul>
          </li>
          <li>
            <a href="#">房间管理</a>
            <ul class="sub-menu">
              <li><a href="admin_addh.php"><i class="icon-font">&#xe995;</i>新增房间</a></li>
              <li><a href="admin_roommgr.php"><i class="icon-font">&#xe994;</i>房间管理</a></li>
            </ul>
          </li>
          <li>
            <a href="#">房类管理</a>
            <ul class="sub-menu">
              <li><a href="admin_addt.php"><i class="icon-font">&#xe995;</i>新增房类</a></li>
              <li><a href="admin_rtypemgr.php"><i class="icon-font">&#xe994;</i>房类管理</a></li>
            </ul>
          </li>
          <li>
            <a href="#">系统管理</a>
            <ul class="sub-menu">
              <li><a href="admin_chpwd.php"><i class="icon-font">&#xe991;</i>密码修改</a></li>
              <li><a href="admin_logout.php"><i class="icon-font">&#xe9b6;</i>退出系统</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">入住统计</span></div>
      </div>
      <div class="result-wrap">
        <div class="result-content">
        <table border="0" width="100%">
          <tr height="40px">
            <th class="tc">房间统计</th>
            <th class="tc">营业统计</th>
          </tr>
          <tr>
            <td class="tc">
              <table class="result-tab" width="100%">
                <tr>
                  <td class="td_bg">房型总数（种）</td>
                  <td class="td_bg">房间总数（间）</td>
                  <td class="td_bg">房间剩余（间）</td>
                </tr>
                <?php 
                  require("../dbconnect.php");
                  $sql="select count(typeid),sum(totalnum),sum(leftnum) from roomtype";
                  $val=mysqli_query($db_link,$sql);                 
                  while($arr=mysqli_fetch_row($val))
                  { ?>
                    <tr>
                    <td><?php echo $arr[0] ?></td>
                    <td><?php echo $arr[1] ?></td>
                    <td><?php echo $arr[2] ?></td>                   
                    </tr>
                 <?php } ?>               
              </table>
            </td>
            <td class="tc">
              <table class="result-tab" width="100%">
                <tr>
                  <td class="td_bg">订单总数（个）</td>
                  <td class="td_bg">总营业额（元）</td>
                </tr>
                <?php 
                  require("../dbconnect.php");
                  $sql="select count(orderid),sum(monetary) from record";
                  $val=mysqli_query($db_link,$sql);
                  
                  while($arr=mysqli_fetch_row($val))
                  { ?>
                    <tr>
                    <td><?php echo $arr[0] ?></td>
                    <td><?php echo $arr[1] ?></td>                   
                    </tr>
                 <?php } ?>   
              </table>   
            </td>
          </tr>
        </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>