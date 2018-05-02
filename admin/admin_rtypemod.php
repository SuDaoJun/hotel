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
      $sql="select * from roomtype where typeid='".$_GET["rid"]."'";
      $arr=mysqli_query($db_link,$sql);
      $rows=mysqli_fetch_row($arr);
    ?>
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_rtypemgr.php">房类管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">房类修改</span></div>
      </div>
      <div class="result-wrap">
        <form id="myform" name="myform" method="post" action="update.php?mtid=<?php echo $rows[0] ?>">
        <ul class="order">
          <li>
            <label for="typename">类型名称&emsp;</label>
            <input name="typename" type="text" id="typename" value="<?php echo $rows[1] ?>" size="15" maxlength="50" />
          </li>
          <li>
            <label for="area">房间面积&emsp;</label>
            <input name="area" type="text" id="area" value="<?php echo $rows[2] ?>" size="5" maxlength="50" /> 平方米
          </li>
          <li>
            <label for="totalnum">房间数量&emsp;</label>
            <input name="totalnum" type="text" id="totalnum" value="<?php echo $rows[6] ?>" size="5" maxlength="10" /> 间
          </li>
          <li>
            <label for="leftnum">剩余数量：</label>
            <input name="leftnum" type="text" id="leftnum" value="<?php echo $rows[7] ?>" size="5" maxlength="10" /> 间
          </li>
          <li>
            <label for="hasNet">网&emsp;&emsp;络&emsp;</label>
            <select name="hasNet" id='hasNet'>
              <option value="<?php echo $rows[3] ?>" selected><?php echo $rows[3] ?></option>
              <option value="有">有</option>
              <option value="无">无</option>
            </select>
          </li>
          <li>
            <label for="hasTv">电&emsp;&emsp;视&emsp;</label>
            <select name="hasTV" id="hasTv">
              <option value="<?php echo $rows[4] ?>" selected><?php echo $rows[4] ?></option>
              <option value="有">有</option>
              <option value="无">无</option>
            </select>
          </li>
          <li>
            <label for="price">价&emsp;&emsp;格&emsp;</label>
            <input name="price" type="text" id="price" value="<?php echo $rows[5] ?>" size="10" maxlength="15" /> 元
          </li>
          <li>
            <input type="reset" class="reset" name="submit2" id="button2" value="重置" />
            <input type="hidden" name="action" value="modify">
            <input type="submit" name="submit" id="button" value="提交" />
          </li>
        </ul>
        </form>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>