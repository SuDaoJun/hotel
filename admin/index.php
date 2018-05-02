<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>宾馆后台管理</title>
  <link href="css/admin_login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
</head>
<body>
<div class="login-box">
  <h1>宾馆管理系统后台登录</h1>
  <form method="post" action="admin_login.php" id="form">
    <div class="name">
      <label for="user">账&emsp;号：</label>
      <input type="text" placeholder="请输入账号" name="username" id="user" autocomplete="off" />
    </div>
    <div class="password">
      <label for="pwd">密&emsp;码：</label>
      <input type="password" placeholder="请输入密码" name="pwd"  id="pwd" autocomplete="off" />
    </div>
    <div class="code">
      <label for="codes">验证码：</label>
      <input type="text" placeholder="请输入验证码" name="" maxlength="4" id="codes" />
      <input type = "button" id="code"/>        
    </div><br>
    <div class="login">
    <input type="hidden" name="action" value="test">
      <button id='login' type="button">登录</button>
    </div>
  </form>
</div>


<div class="screenbg">
  <ul>
    <li><a href="javascript:;"><img src="img/0.jpg"></a></li>
    <li><a href="javascript:;"><img src="img/1.jpg"></a></li>
    <li><a href="javascript:;"><img src="img/2.jpg"></a></li>
  </ul>
</div>
<script type="text/javascript">
$(function(){
  // 图片轮播
  $(".screenbg ul li").each(function(){
    $(this).css("opacity","0");
  });
  $(".screenbg ul li:first").css("opacity","1");
  var index = 0;
  var t;
  var li = $(".screenbg ul li");  
  var number = li.size();
  function change(index){
    li.css("visibility","visible");
    li.eq(index).siblings().animate({opacity:0},3000);
    li.eq(index).animate({opacity:1},3000);
  }
  function show(){
    index = index + 1;
    if(index<=number-1){
      change(index);
    }else{
      index = 0;
      change(index);
    }
  }
  t = setInterval(show,6000);
  //验证码
    var code;
    function createCode(){
        code = '';
        var codeLength = 4;
        var random = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R', 'S','T','U','V','W','X','Y','Z');

        for(var i = 0; i < codeLength; i++){
     
             var index = Math.floor(Math.random()*36);

             code += random[index]; 
        }
        $("#code").val(code);
        $("#code").css({
          color: randomColor()
        });
    }
    createCode();
    $("#code").click(function() {
      createCode();
    });

    //随机颜色
    function randomColor(){
    var r=parseInt(Math.random()*256);
    var g=parseInt(Math.random()*256);
    var b=parseInt(Math.random()*256);
    var rgb="rgb("+r+","+g+","+b+")";
    return rgb;
    }

    function validate(){
        var oValue = $("#codes");
        if(oValue.val() ==0){
            alert('请输入验证码');
            createCode();

            oValue.focus();
        }else if(oValue.val() != code){
            alert('验证码不正确，请重新输入');
            oValue.val('');
            createCode();
        }else{
          $("#form").submit();
        }

    }
    $("#login").click(function() {
      var user = $("#user");
      var pwd = $("#pwd");
      if(user.val() == '' || pwd.val() == ''){
        alert("请输入账号或密码");
        user.val('');
        pwd.val('');
        user.focus();
      }else{
        validate();
      }
    
    });
});
</script>
</body>
</html>