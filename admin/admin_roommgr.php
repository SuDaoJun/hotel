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
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">房间管理</span></div>
      </div>
      <div class="search-wrap">
        <div class="search-content">
          <form action="admin_roommgr.php" method="post">
            <table class="search-tab">
              <tr>
                <th width="120">查询条件</th>
                <td>
                  <select name="search-type" id="">
                    <option value="roomid" selected>房间编号</option>
                    <option value="typeid">房间类型</option>
                    <option value="status">房间状态</option>
                  </select>
                </td>
                <th width="70">关键字</th>
                <td><input class="common-text" placeholder="请输入查询条件" name="keywords" value="" id="" type="text"></td>
                <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
      <div class="result-wrap">
        <div class="result-content">
          <table class="result-tab" width="100%">
            <tr>
              <th class="tc">房间编号</th>
              <th class="tc">房间类型</th>
              <th class="tc">房间状态</th>
              <th class="tc">房间描述</th>
              <th class="tc">操&emsp;&emsp;作</th>
            </tr>
            <?php
              require("../dbconnect.php");
              $sql = "select a.roomid,b.typename,a.status,a.remarks from room a,roomtype b where a.typeid=b.typeid and a.".@$_POST["search-type"]." like ('%".@$_POST["keywords"]."%')";
              $rs=mysqli_query($db_link,$sql);
              if(!$rs)
              {
                  echo "无满足条件的记录！";
                  exit;
              }
              
              while($rows=mysqli_fetch_assoc($rs))
              {?>
              <tr>
                <td class='tc'><?php echo $rows["roomid"] ?></td>
                <td class='tc'><?php echo $rows["typename"] ?></td>
                <td class='tc'><?php echo $rows["status"] ?></td>
                <td class='tc'><?php echo $rows["remarks"] ?></td>
                <td class='tc'>
                  <a href='admin_roommod.php?mid=<?php echo $rows["roomid"] ?>'  class='link-update'>修改</a>&nbsp;&nbsp;<a href='delete.php?mid=<?php echo $rows["roomid"] ?>' class='link-del''>删除</a>
                </td>
                
              </tr>


            <?php } ?>
          </table>
          
        </div>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>