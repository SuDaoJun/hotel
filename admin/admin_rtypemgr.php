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
      <div class="search-wrap">房间类型显示</div>
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
              $pagesize = 10;
              $sql = "select * from roomtype";
              $rs=mysqli_query($db_link,$sql);
              if(!$rs)
              {
                  echo "无房间类型信息！";
                  exit;
              }
              $recordcount=mysqli_num_rows($rs);
              $pagecount=($recordcount-1)/$pagesize+1;
              $pagecount=(int)$pagecount;
              $pageno=@$_GET["pageno"];
              if($pageno=="")
              {
                  $pageno=1;
              }
              if($pageno>$pagecount)
              {
                  $pageno=$pagecount;
              }
              $startno=($pageno-1)*$pagesize;
              $sql = "select * from roomtype order by typeid asc limit $startno,$pagesize";
              $rs=mysqli_query($db_link,$sql);
              if(!$rs)
              {
                  echo "无房间类型信息";
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
          <div class="list-page">
              <?php
                if($pageno==1)
                {
                  if($recordcount>$pagesize){
                    echo "首页 | 上一页 | <a href='?pageno=".($pageno+1)."'>下一页</a> | <a href='?pageno=".$pagecount."'>末页</a>";
                  }else{
                    echo "首页 | 上一页 | 下一页 | 末页";
                  }
                  
                }
                else if($pageno==$pagecount)
                {
                  echo "<a href='?pageno=1'>首页</a> | <a href='?pageno=".($pageno-1)."'>上一页</a> | 下一页 | 末页";
                }
                else
                {
                  echo "<a href='?pageno=1'>首页</a> | <a href='?pageno=".($pageno-1)."'>上一页</a> | <a href='?pageno=".($pageno+1)."'>下一页</a> | <a href='?pageno=".$pagecount."'>末页</a>";
                }
                
                echo "&nbsp;&nbsp;页次：".$pageno."/".$pagecount."页&nbsp;共有".$recordcount."条信息";
              ?>
          </div>
        </div>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>