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
            <a href="#">留言管理</a>
            <ul class="sub-menu">
              <li><a href="admin_message.php"><i class="icon-font">&#xe986;</i>留言查看</a></li>
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
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">密码修改</span></div>
      </div>
      <?php
        require("../dbconnect.php");
        $oper_name=$_SESSION["aname"];
        $sql="select * from admin where name='$oper_name'";
        $rs=mysqli_query($db_link,$sql);
        $rows=mysqli_fetch_assoc($rs);
        if(@$_POST["Submit"])
        {
          if($rows["passwd"]==$_POST["password"])
          {
            $password2=$_POST["password2"];
            $sql="update admin set passwd='$password2' where name='$oper_name'";
            mysqli_query($db_link,$sql);
            echo "<script language='javascript'>alert('修改成功,请重新进行登陆！');window.location='index.php'</script>";
            exit();
          }
          else
          {
            echo "<script language='javascript'>alert('原始密码不正确,请重新输入');window.location='admin_chpwd.php'</script>";
          }
        }
      ?>
      <div class="result-wrap">
        <form name="renpassword" id="renpassword" method="post">
          <div class="result-content">
            <table class="result-tab" width="100%">
              <tr> 
                <td width="20%" align="right" class="td_bg">用户名：</td>
                <td width="80%" class="td_bg"><?php echo $rows["name"] ?></td>
              </tr>
              <tr> 
                <td align="right" class="td_bg">原密码：</td>
                <td class="td_bg"><input name="password" type="password" required id="password" size="20"></td>
              </tr>
              <tr> 
                <td align="right" class="td_bg">新密码：</td>
                <td class="td_bg"><input  name="password2" type="password" required id="password2" size="20"></td>
              </tr>
              <tr> 
                <td align="right" class="td_bg"></td>
                <td class="td_bg"><input class="td_bg tj" type="submit" name="Submit" value="确定更改"></td>
              </tr>
            </table>
          </div>
        </form>
      </div>
    </div>
    <!--/main-->
  </div>

</body>
</html>