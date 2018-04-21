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
        <div class="crumb-list"><i class="icon-font">&#xe601;</i><span>欢迎使用宾馆后台管理系统</span></div>
      </div>
      <div class="result-wrap">
        <div class="result-title">
          <h1>系统基本信息</h1>
        </div>
        <div class="result-content">
          <ul class="sys-info-list">
            <?php require("../dbconnect.php"); ?>
            <li>
              <label class="res-lab">物理路径</label><span class="res-info"><?php echo $_SERVER["DOCUMENT_ROOT"]; ?></span>
            </li>
            <li>
              <label class="res-lab">PHP版本</label><span class="res-info"><?php echo PHP_VERSION; ?></span>
            </li>
            <li>
              <label class="res-lab">MYSQL版本</label><span class="res-info"><?php echo mysqli_get_server_info($db_link); ?></span>
            </li>
            <li>
              <label class="res-lab">服务器名</label><span class="res-info"><?php echo $_SERVER['SERVER_NAME']; ?></span>
            </li>
            <li>
              <label class="res-lab">服务器IP</label><span class="res-info"><?php echo $_SERVER["HTTP_HOST"]; ?></span>
            </li>
            <li>
              <label class="res-lab">服务器端口</label><span class="res-info"><?php echo $_SERVER["SERVER_PORT"]; ?></span>
            </li>
            <li>
              <label class="res-lab">服务器时间</label><span class="res-info"><?php echo $showtime=date("Y-m-d H:i:s");?></span>
            </li>
            <li>
              <label class="res-lab">服务器操作系统</label><span class="res-info"><?php echo PHP_OS; ?></span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>