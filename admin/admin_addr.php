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
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">人员添加</span></div>
      </div>
      
      <div class="result-wrap">
        <form action="insert.php" id="renpassword" method="post">
          <div class="result-content">
          <ul class="order">
            <li>
              <label for="name">用户名&emsp;</label>
              <input placeholder="请输入用户名" type="text" id='name' name='name' size="20" required>   
            </li>
            <li>
              <label for="password">密&emsp;码&emsp;</label>
              <input name="password" placeholder="请输入密码" type="password" required id="password" size="20">
            </li>
              <input type="hidden" name='action' value='insetr'>
              <input class="td_bg tj"  type="submit" name="submit" id='submit' value="确定">
            </li>
          </ul>
          </div>
        </form>
      </div>
      <div class="search-wrap gl">管理人员</div>
      <div class="result-wrap">
        <div class="result-content">
          <table class="result-tab" width="80%" align="center">
            <tr>
              <th class="tc">管理员号</th>
              <th class="tc">账号</th>
              <th class="tc">密码</th>
              <th class="tc">操&emsp;&emsp;作</th>
            </tr>
            <?php
              require("../dbconnect.php");
              $pagesize = 10;
              $sql = "select * from admin";
              $rs=mysqli_query($db_link,$sql);
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
              $sql="select * from admin order by id asc limit $startno,$pagesize";
              $rs=mysqli_query($db_link,$sql);
              while($rows=mysqli_fetch_assoc($rs))
              {
                ?>                            
                <tr>
                <td class='tc'><?php echo $rows["id"] ?></td>
                <td class='tc'><?php echo $rows["name"] ?></td>
                <td class='tc'><?php echo $rows["passwd"] ?></td>
                <td class='tc'>
                <a href='delete.php?id=<?php echo $rows["id"] ?>'  class='link-update'>删除</a>
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
    <!--/main-->
  </div>

</body>
</html>