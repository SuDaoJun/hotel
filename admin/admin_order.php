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
    <?php
      require("../dbconnect.php");
      $sql="select a.roomid,b.typeid,b.typename,b.price from room a,roomtype b where a.typeid=b.typeid and a.roomid=".$_GET["orid"];
      $arr=mysqli_query($db_link,$sql);
      $rows=mysqli_fetch_row($arr);
    ?>
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">大堂入住</span></div>
      </div>
      <div class="result-wrap">
        <form id="myform" name="myform" method="post" action="insert.php">
          <table width="100%" height="173" border="0" align="center" cellpadding="2" cellspacing="1" class="result-tab">
            <tr>
              <td width="%15" align="right" class="td_bg">房间编号：</td>
              <td width="%85" class="td_bg"> <input name="roomid" type="text" class='jz' readonly id="roomid" value="<?php echo $_GET["orid"] ?>" size="15" maxlength="20" /></td>
            </tr>
            <tr>
              <td align="right" class="td_bg">类型编号：</td>
              <td class="td_bg"> <input class='jz' name="typeid" type="text" id="typeid" readonly value="<?php echo $rows[1] ?>" size="15" maxlength="20" /></td>
            </tr>
            <tr>
              <td align="right" class="td_bg">类型名称：</td>
              <td class="td_bg"> <input class='jz' name="typename" type="text" id="typename" readonly value="<?php echo $rows[2] ?>" size="15" maxlength="20" /></td>
            </tr>
            <tr>
              <td align="right" class="td_bg">房间价格：</td>
              <td class="td_bg"> <input class='jz' name="price" type="text" id="price" readonly value="<?php echo $rows[3].'元/天' ?>" size="15" maxlength="20" /></td>
            </tr>
            <tr>
              <td width="%15" align="right" class="td_bg">客户姓名：</td>
              <td width="%85" class="td_bg"> <input name="name" type="text" required placeholder="请输入客户姓名" id="cname" size="20" maxlength="30" /></td>
            </tr>
            
            <tr>
              <td align="right" class="td_bg">证件号码：</td>
              <td class="td_bg"><input placeholder="请输入身份证号码" required name="card" type="text" id="cardid" size="30" maxlength="50" /></td>
            </tr>
            
            <tr>
              <td align="right" class="td_bg">入住时间：</td>
              <td class="td_bg"><input name="checkin" type="text" id="entertime"  value=<?php echo date("Y-m-d"); ?> size="30" maxlength="50" /></td>
            </tr>
            <tr>
              <td align="right" class="td_bg">离开时间：</td>
              <td class="td_bg"><input name="checkout" type="text" id="leavetime" required placeholder="选择离开日期" size="30" maxlength="50" /></td>
            </tr>
            <tr>
              <td align="right" class="td_bg">联系电话：</td>
              <td class="td_bg"><input name="phone" type="text" id="phone" required placeholder="请输入联系电话" size="30" maxlength="50" /></td>
            </tr>
            <tr>
              <td align="right" class="td_bg">订单备注：</td>
              <td   class="td_bg bz"><textarea id="message-field" placeholder="备注信息..." name="content"></textarea></td>
            </tr>
            <tr>
              <td align="right" class="td_bg"><input type="reset" name="submit2" id="button2" value="重置" /></td>
              <td class="td_bg">
                <input type="hidden" name="action" value="inserto">
                <input type="submit" name="submit" id="button" value="确认入住" /></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>