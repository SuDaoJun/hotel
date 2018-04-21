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
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">房类管理</span></div>
      </div>
      <div class="search-wrap">
        <div class="search-content">
          <form action="admin_rtypemgr.php" method="post">
            <table class="search-tab">
              <tr>
                <th width="120">查询条件</th>
                <td>
                  <select name="search-type" id="">
                    <option value="typename" selected>类型名称</option>
                    <option value="area">房间面积</option>
                    <option value="price">房间价格</option>
                  </select>
                </td>
                <th width="70">关键字</th>
                <td><input class="common-text" placeholder="请输入查询条件" name="keywords" value="" id="" type="text"></td>
                <td><input  name="sub" value="查询" type="submit"></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
      <div class="result-wrap">
        <div class="result-content">
          <table class="result-tab" width="100%">
            <tr>
              <th class="tc">类型标识</th>
              <th class="tc">类型名称</th>
              <th class="tc">房间面积</th>
              <th class="tc">网络</th>
              <th class="tc">电视</th>
              <th class="tc">价格</th>
              <th class="tc">房间总数</th>
              <th class="tc">剩余数量</th>             
              <th class="tc">操&emsp;&emsp;作</th>
            </tr>
            <?php
              require("../dbconnect.php");
              $sql = "select * from roomtype where ".@$_POST["search-type"]." like ('%".@$_POST["keywords"]."%')";
              $rs=mysqli_query($db_link,$sql);
              if($rs){
              $s=mysqli_num_rows($rs);
              }else{
                $s=0;
              }
              if(!$s)
              {
                  echo "无满足条件的记录，请继续查询！";
                  exit;
              }
              while($rows=mysqli_fetch_assoc($rs))
              {?>
              <tr>
                <td class='tc'><?php echo $rows["typeid"] ?></td>
                <td class='tc'><?php echo $rows["typename"] ?></td>
                <td class='tc'><?php echo $rows["area"] ?></td>
                <td class='tc'><?php echo $rows["hasNet"] ?></td>
                <td class='tc'><?php echo $rows["hasTV"] ?></td>
                <td class='tc'><?php echo $rows["price"] ?></td>
                <td class='tc'><?php echo $rows["totalnum"] ?></td>
                <td class='tc'><?php echo $rows["leftnum"] ?></td>
                <td class='tc'>
                  <a href='admin_rtypemod.php?rid=<?php echo $rows["typeid"] ?>'  class='link-update'>修改</a>&nbsp;&nbsp;<a href='delete.php?rid=<?php echo $rows["typeid"] ?>' class='link-del''>删除</a>
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