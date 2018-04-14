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
    <?php
    require("leftArea.html");
    ?>
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