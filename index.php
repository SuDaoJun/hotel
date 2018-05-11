<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta content="宾馆管理" name="keywords"/>
<meta content="宾馆展示" name="description"/>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="colorbox.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<title>宾馆管理</title>
</head>
<body>
<div class="page-body-wrap">
<?php
require("head.html");
?>
<div class="main-slider">
<ul>
    <li class="on"><img alt="banner1" src="images/b1.jpg"/></li>
    <li><img alt="banner2" src="images/b2.jpg"/></li>
    <li><img alt="banner3" src="images/b3.jpg"/></li>
    <li><img alt="banner4" src="images/b4.jpg"/></li>
</ul>
<div class="page">
    <ul>
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
</div>

<div class="luxury-rooms">
<div class="heading-box">
<h2>
    <a href="javascript:">房间&nbsp;<span>推荐</span></a>
</h2>
<div class="subtitle">
    找到属于自己的位置，走自己的道路，人生，越努力越幸运！ 
</div>
</div>

<div class="room-container container clearfix">
    <?php
      require("dbconnect.php");
      $sql="select a.pic,a.remarks,b.typename,b.price from room a,roomtype b where a.typeid=b.typeid order by roomid asc limit 8";
      $arr=mysqli_query($db_link,$sql);
      while($rows=mysqli_fetch_assoc($arr)){
    ?>
    <div class="room-box">
        <div class="img-container">
            <img class='imgs' alt="" src='images/<?php echo $rows["pic"] ?>'/>
        </div>
        <div class="details">
            <div class="title">
                <a href="javascript:;">
                    <?php echo $rows["typename"] ?>
                </a>
            </div>
            <div class="desc">
                房间标配：<?php echo $rows["remarks"] ?>...
            </div>
            <div class="price">
                <span>
                    ￥<?php echo $rows["price"] ?>
                </span>
                - 每晚
            </div>
        </div>
    </div>
    <?php } ?>   
</div>
</div>
<div class="gallery">
<div class="heading-box">
<h2>
    <a href="javascript:;">
        宾馆相册
        <span>
            欣赏
        </span>
    </a>
</h2>
</div>
<div class="gallery-container container">
<div class="gallery-container">
    <ul class="image-main-box clearfix">
    <?php
      require("dbconnect.php");
      $sql="select * from news limit 8";
      $arr=mysqli_query($db_link,$sql);
      while($rows=mysqli_fetch_assoc($arr)){
    ?>
        <li class="igal-item">
            <div class="figure">
                <img width='269px' height='192px' alt='<?php echo $rows["title"] ?>' src='images/<?php echo $rows["spic"] ?>'/>
                <a class="group4" title='<?php echo $rows["title"] ?>' href='images/<?php echo $rows["bpic"] ?>'>
                    
                </a>
                <div class="figcaption">
                    <h4>
                        <span>
                            <?php echo $rows["describes"] ?>
                        </span>
                    </h4>
                </div>
            </div>
            <h3 class="gallery-h3-title">
                <a href="javascript:;" title='<?php echo $rows["title"] ?>'>
                    <?php echo $rows["title"] ?>
                </a>
            </h3>
        </li>
        <?php } ?> 
    </ul>
</div>
</div>
</div>
<div class="titles">
    人生
    <span>
        越努力 越幸运
    </span>
    找到属于自己的位置，走自己的道路。
</div>
<?php
require("footer.html");
?>

</div>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.colorbox-min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">
$(function() {
//弹出框插件初始化
$(".group1").colorbox({rel:'group1'});
$(".group2").colorbox({rel:'group2', transition:"fade"});
$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
$(".group4").colorbox({rel:'group4', slideshow:true});
$(".ajax").colorbox();
$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
$(".inline").colorbox({inline:true, width:"50%"});
$(".callbacks").colorbox({
    onOpen:function(){ alert('onOpen: colorbox is about to open'); },
    onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
    onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
    onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
    onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
});
$('.non-retina').colorbox({rel:'group5', transition:'none'})
$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
$("#click").click(function(){ 
    $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
    return false;
});
$(".main-menu .nav_0").addClass("active");
});
</script>
</body>
</html>
