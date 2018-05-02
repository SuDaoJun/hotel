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
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">入住统计</span></div>
      </div>
      <div class="result-wrap">
        <div class="result-content">
        <table border="0" width="100%">
          <tr height="40px">
            <th class="tc count">房间统计</th>
            <th class="tc count">营业统计</th>
          </tr>
          <tr>
            <td class="tc">
              <table class="result-tab" width="100%">
                <tr>
                  <th class="td_bg">房型总数（种）</th>
                  <th class="td_bg">房间总数（间）</th>
                  <th class="td_bg">房间剩余（间）</th>
                </tr>
                <?php 
                  require("../dbconnect.php");
                  $sql="select count(typeid),sum(totalnum),sum(leftnum) from roomtype";
                  $val=mysqli_query($db_link,$sql);                 
                  while($arr=mysqli_fetch_row($val))
                  { ?>
                    <tr>
                    <td><?php echo $arr[0] ?></td>
                    <td><?php echo $arr[1] ?></td>
                    <td><?php echo $arr[2] ?></td>                   
                    </tr>
                 <?php } ?>               
              </table>
            </td>
            <td class="tc">
              <table class="result-tab" width="100%">
                <tr>
                  <th class="td_bg">订单总数（个）</th>
                  <th class="td_bg">总营业额（元）</th>
                </tr>
                <?php 
                  require("../dbconnect.php");
                  $sql="select count(orderid),sum(monetary) from record";
                  $val=mysqli_query($db_link,$sql);
                  
                  while($arr=mysqli_fetch_row($val))
                  { ?>
                    <tr>
                    <td><?php echo $arr[0] ?></td>
                    <td><?php echo $arr[1] ?></td>                   
                    </tr>
                 <?php } ?>   
              </table>   
            </td>
          </tr>
        </table>
        </div>
      </div>
      <div class="search-wrap">历史订单记录</div>
      <div class="result-wrap">
        <div class="result-content">
          <table class="result-tab" width="100%">
            <tr>
              <th class="tc">订单流水</th>
              <th class="tc">房间号</th>
              <th class="tc">证件号</th>
              <th class="tc">入住时间</th>
              <th class="tc">住宿天数</th>
              <th class="tc">房间类型</th>
              <th class="tc">顾客姓名</th>
              <th class="tc">联系电话</th>
              <th class="tc">备注信息</th>
              <th class="tc">网上预定</th>
              <th class="tc">完成交易</th>
              <th class="tc">消费金额</th>
              <th class="tc">操&emsp;&emsp;作</th>
            </tr>
            <?php
              require("../dbconnect.php");
              $pagesize = 10;
              $sql = "select a.orderid,a.roomid,a.cardid,a.entertime,a.days,b.typeid,b.typename,a.linkman,a.phone,a.messages,a.monetary,a.ostatus,a.oremarks,b.price from record a,roomtype b where a.typeid=b.typeid ";
              $rs=mysqli_query($db_link,$sql);
              if(!$rs)
              {
                  echo "无历史订单记录";
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
              $sql="select a.orderid,a.roomid,a.cardid,a.entertime,a.days,b.typeid,b.typename,a.linkman,a.phone,a.messages,a.monetary,a.ostatus,a.oremarks,b.price from record a,roomtype b where a.typeid=b.typeid order by orderid asc limit $startno,$pagesize";
              $rs=mysqli_query($db_link,$sql);
              if(!$rs)
              {
                  echo "无历史订单记录";
                  exit;
              }
              while($rows=mysqli_fetch_assoc($rs))
              {
                ?>                            
                <tr>
                <td class='tc'><?php echo $rows["orderid"] ?></td>
                <td class='tc'><?php echo $rows["roomid"] ?></td>
                <td class='tc'><?php echo $rows["cardid"] ?></td>
                <td class='tc'><?php echo $rows["entertime"] ?></td>
                <td class='tc'><?php echo $rows["days"] ?></td>
                <td class='tc'><?php echo $rows["typename"] ?></td>
                <td class='tc'><?php echo $rows["linkman"] ?></td>
                <td class='tc'><?php echo $rows["phone"] ?></td>
                <td class='tc'><?php echo $rows["messages"] ?></td>
                <td class='tc'><?php echo $rows["ostatus"] ?></td>
                <td class='tc'><?php echo $rows["oremarks"] ?></td>
                <td class='tc'><?php echo $rows["monetary"] ?></td>
                <td class='tc'>
                <a href='delete.php?orderid=<?php echo $rows["orderid"] ?>'  class='link-update'>删除</a>
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
  </div>
</body>
</html>