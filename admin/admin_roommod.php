<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>宾馆后台管理</title>
  <link rel="stylesheet" type="text/css" href="css/common.css"/>
  <link rel="stylesheet" type="text/css" href="css/main.css"/>
  <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
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
      $sql="select a.roomid,b.typeid,b.typename,a.status,a.remarks from room a,roomtype b where a.typeid=b.typeid and a.roomid=".$_GET["mid"];
      $arr=mysqli_query($db_link,$sql);
      $rows=mysqli_fetch_row($arr);
    ?>
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">房间管理</span></div>
      </div>
      <div class="result-wrap">
        <form id="myform" name="myform" method="post" action="update.php?mrid=<?php echo $rows[0] ?>">
          <table width="100%" height="173" border="0" align="center" cellpadding="2" cellspacing="1" class="result-tab">
            <tr>
              <td width="%15" align="right" class="td_bg">房间编号：</td>
              <td width="%85" class="td_bg"> <input name="roomid" type="text" id="roomid" value="<?php echo $rows[0] ?>" size="30" maxlength="50" /></td>
            </tr>
            <tr>
              <td align="right" class="td_bg">房间类型：</td>
              <td class="td_bg">
                <select name="typeid">
                 <option value="typename" >
                  <?php echo $rows[2]  ?>
                  </option>
                </select>
              </td>
            </tr>
            
            <tr>
              <td align="right" class="td_bg">房间状态：</td>
              <td class="td_bg">
                <select name="status">
                  <option value="<?php echo $rows[3] ?>" >
                  <?php echo $rows[3] == '是'?'已入住':'未入住'  ?>
                  </option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="right" class="td_bg">房间描述：</td>
              <td class="td_bg"><textarea id="remarks" placeholder="房间描述..." value='<?php echo $rows[4] ?>' name="remarks"><?php echo $rows[4] ?></textarea></td>
            </tr>
            <tr>
              <td align="right" class="td_bg"><input type="reset" name="submit2" id="button2" value="重置" /></td>
              <td class="td_bg">
                <input type="hidden" name="action" value="roomchg">
                <input type="submit" name="submit" id="button" value="提交" />
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>