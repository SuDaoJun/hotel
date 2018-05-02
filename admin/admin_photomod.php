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
      $sql="select * from news where id='".$_GET["pid"]."'";
      $arr=mysqli_query($db_link,$sql);
      $rows=mysqli_fetch_row($arr);
    ?>
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_photomgr.php">相册管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">相册修改</span></div>
      </div>
      <div class="result-wrap">
        <form id="myform" name="myform" method="post" action="update.php?pid=<?php echo $rows[0] ?>" enctype="multipart/form-data">
        <ul class="order">
          <li>
            <label for="id">相册序号&emsp;</label>
            <input name="id" type="text"  value="<?php echo $rows[0] ?>" size="4" maxlength="10" />
          </li>
          <li>
            <label for="title">相册标题&emsp;</label>
            <input name="title" id='title' type="text" value="<?php echo $rows[1] ?>" size="30" maxlength="30" />
          </li>
          <li>
            <label for="">相册小图&emsp;</label>
            <label for="file" class='fjtp'>上传图片</label>
            <input name="file" accept="image/*" type="file" id="file"  /><input type="hidden" name='init' value='<?php echo $rows[2] ?>' ><span class="xxx"></span>图片预览&emsp;<img src='../images/<?php echo $rows[2] ?>' height="auto" width="60px" id='img'>
          </li>
          <li>
            <label for="">相册大图&emsp;</label>
            <label for="files" class='fjtp'>上传图片</label>
            <input name="files" accept="image/*" type="file" id="files"  /><input type="hidden" name='inits' value='<?php echo $rows[3] ?>' ><span class="xxxx"></span>图片预览&emsp;<img src='../images/<?php echo $rows[3] ?>' height="auto" width="60px" id='imgs'>
          </li>
          <script>
           $(function(){
            $("#button").click(function() {
              var file = $("#file").val();
              var files = $("#files").val();
              if((file && !files) || (!file && files)){
                alert("请选择相应的相册大小图片");  
                return false;
              }              
            })
          })    
          function preview(file,img,xxx){
            file.change(function(){
              var reader = new FileReader();
              reader.onload = function(e){
                img.attr('src', e.target.result);
                var str=file.val();
                var arrs=str.split('\\');
                var names=arrs[arrs.length-1];
                xxx.html(names);
              }
              reader.readAsDataURL(file[0].files[0]);
            });
           }
          preview($("#file"),$("#img"),$(".xxx"));
          preview($("#files"),$("#imgs"),$(".xxxx"));         
          </script>
          <li>
            <label for="describes">相册描述&emsp;</label>
            <textarea  placeholder="相册描述..." value='<?php echo $rows[4] ?>' id='describes' name="describes"><?php echo $rows[4] ?></textarea>
          </li>
          <li>
            <input type="reset" class="reset" name="submit2" id="button2" value="重置" />
            <input type="hidden" name="action" value="photochg">
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