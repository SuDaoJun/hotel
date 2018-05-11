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
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">新增房间</span></div>
      </div>
      <div class="result-wrap">
        <form enctype="multipart/form-data" id="myform" name="myform" method="post" action="insert.php" >
        <ul class='order'>
          <li>
            <label for="roomid">房间编号&emsp;</label>
            <input name="roomid" placeholder="房间编号" type="text" required id="roomid" size="10" maxlength="50" />
          </li>
          <li>
            <label for="selroom">房间类型&emsp;</label>
            <select id='selroom' name="typeid">
              <option  value=0 selected>请选择房间类型</option>
            <?php
              require("../dbconnect.php");
              $sql="select typeid,typename from roomtype";
              $arr=mysqli_query($db_link,$sql);
              if(!$arr)
              {
                echo "<option  value=0>无房间类型</option>";
                exit;
              }
              while($rows=mysqli_fetch_assoc($arr))
              {
                echo "<option  value=".$rows["typeid"].">".$rows["typename"]."</option>";
              }
            ?>
            </select>
          </li>
          <li>
            <label for="status">入住状态&emsp;</label>
            <select name="status" id='status'>
              <option value="否" selected>未入住</option>
            </select>
          </li>
          <li>
            <label for="">房间图片&emsp;</label>
            <label for="file" class='fjtp'>上传图片</label>
            <input name="file" type="file"   id="file" accept="image/*"  /><span class="xxx"></span>图片预览&emsp;<img  height="auto" width="120px" id='imgs'>
          </li>
          <script>
            $(function(){
              $("#button").click(function() {
                if($("#selroom").val() == 0){
                  alert("请选择房间类型");
                  return false;
                }
                if(!$("#file").val()){
                  alert("请选择房间图片");                 
                  return false;
                }              
            })
            })            
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
            <textarea id="remarks" placeholder="房间描述..." name="remarks"></textarea>
          </li>
          <li>
            <input type="reset" class='reset' name="submit2" id="button2" value="重置" />
            <input type="hidden" name="action" value="inserth">
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