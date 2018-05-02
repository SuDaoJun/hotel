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
      $sql="select a.roomid,b.typeid,b.typename,a.status,a.remarks,a.pic from room a,roomtype b where a.typeid=b.typeid and a.roomid='".$_GET["mid"]."'";
      $arr=mysqli_query($db_link,$sql);
      $rows=mysqli_fetch_row($arr);
    ?>
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_roommgr.php">房间管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">房间修改</span></div>
      </div>
      <div class="result-wrap">
        <form id="myform" name="myform" method="post" action="update.php?mrid=<?php echo $rows[0] ?>" enctype="multipart/form-data">
        <ul class='order'>
          <li>
            <label for="roomid">房间编号&emsp;</label>
            <input name="roomid" type="text" id="roomid" value="<?php echo $rows[0] ?>" size="4" maxlength="10" />
          </li>
          <li>
            <label for="typeid">房间类型&emsp;</label>
            <select name="typeid" id='typeid'>
             <option value="typename" >
              <?php echo $rows[2]  ?>
              </option>
            </select>
          </li>
          <li>
            <label for="status">房间状态&emsp;</label>
            <select name="status" id='status'>
              <option value="<?php echo $rows[3] ?>" >
              <?php echo $rows[3] == '是'?'已入住':'未入住'  ?>
              </option>
            </select>
          </li>
          <li>
            <label for="">房间图片&emsp;</label>
            <label for="file" class='fjtp'>上传图片</label>
            <input name="file" accept="image/*" type="file" id="file"  /><input type="hidden" name='init' value='<?php echo $rows[5] ?>' ><span class="xxx"></span>图片预览&emsp;<img src='../images/<?php echo $rows[5] ?>' height="auto" width="120px" id='imgs'>
          </li>
          <script>
            $("#file").change(function(){
              var reader = new FileReader();
              reader.onload = function(e){
                $("#imgs").attr('src', e.target.result);
                var str=$("#file").val();
                var arrs=str.split('\\');
                var names=arrs[arrs.length-1];
                $(".xxx").html(names);
              }
              reader.readAsDataURL($("#file")[0].files[0]);
            });
          </script>
          <li>
            <label for="remarks">房间描述&emsp;</label>
            <textarea id="remarks" placeholder="房间描述..." value='<?php echo $rows[4] ?>' name="remarks"><?php echo $rows[4] ?></textarea>
          </li>
          <li>
            <input type="reset" class="reset" name="submit2" id="button2" value="重置" />
            <input type="hidden" name="action" value="roomchg">
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