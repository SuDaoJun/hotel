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
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">新增相册</span></div>
      </div>
      <div class="result-wrap">
        <form enctype="multipart/form-data" id="myform" name="myform" method="post" action="insert.php" >
        <ul class="order">
          <li>
            <label for="title">相册标题&emsp;</label>
            <input required placeholder="相册标题" name="title" type="text" id="title" size="30" maxlength="50" />
          </li>
          <li>
            <label for="">相册小图&emsp;</label>
            <label for="file" class='fjtp'>上传图片</label>
            <input name="file" type="file"  id="file" accept="image/*"  /><span class="xxx"></span>图片预览&emsp;<img  height="auto" width="60px" id='img'>
          </li>
          <li>
            <label for="">相册大图&emsp;</label>
            <label for="files" class='fjtp'>上传图片</label>
            <input  name="files" type="file"  id="files" accept="image/*"  /><span class="xxxx"></span>图片预览&emsp;<img  height="auto" width="60px" id='imgs'>
          </li>
           <script>
           $(function(){
             $("#button").click(function() {
               if(!$("#file").val() && !$("#files").val()){
                 alert("请选择相册图片");                 
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
             <label for="describe">相册描述&emsp;</label>
             <textarea required id="describe" placeholder="相册描述..." name="describe"></textarea>
          </li>
          <li>
            <input type="reset" class='reset' name="submit2" id="button2" value="重置" />
            <input type="hidden" name="action" value="insertx">
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