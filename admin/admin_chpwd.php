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
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">密码修改</span></div>
      </div>
      
      <div class="result-wrap">
        <form action="update.php" id="renpassword" method="post">
          <div class="result-content">
          <ul class="order">
            <li>
              <label for="name">用户名&emsp;</label>
              <input type="text"  id='name' class='jz' readonly value='<?php echo $_SESSION["aname"]; ?>'>      
            </li>
            <li>
              <label for="password">原密码&emsp;</label>
              <input name="password" placeholder="请输入原始密码" type="password" required id="password" size="20">
            </li>
            <li>
              <label for="password2">新密码&emsp;</label>
              <input  name="password2" placeholder="请输入新密码" type="password" required id="password2" size="20">
            </li>
            <li>
              <label for="password3">确认密码&emsp;</label>
              <input  name="password3" placeholder="请确认密码" type="password" required id="password3" size="20">
            </li>
            <li>
              <input type="hidden" name='action' value='psw'>
              <input class="td_bg tj"  type="submit" name="submit" id='submit' value="确定更改">
            </li>
          </ul>
          </div>
        </form>
      </div>
    </div>
    <!--/main-->
  </div>

</body>
</html>