<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta content="宾馆管理" name="keywords"/>
<meta content="宾馆展示" name="description"/>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>

<title>关于我们</title>
<style>
    
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
</head>

<body>

<div class="page-body-wrap">
<?php
require("head.html");
?>
<div class="internal-page-title about-page">
<h1>关于我们</h1>
<ol class="breadcrumb">
	<li><i class="fa fa-map-marker"></i> &nbsp;<span>当前位置： <a href="index.php">网站首页</a> &gt <a href="about.php">关于我们</a></span></li>
</ol>
</div>

<div class="page-container innerpage-wrap">
<div class="container">
<div class="row">
<div class="main inner-left" role="main">
<div class="about-page-wrap">
<div class="com-cnt page-content">
<strong><span style="color:#C5A46D;font-size:18px;">越努力越幸运</span></strong><br />
<br />
找到属于自己的位置，走自己的道路，人生，越努力越幸运！<br />
					
</div>
<hr>
<div class="contact-wrap">
<h3 class="msg-title location">给我们留言</h3>
<form class="add-msg-form" method="post" action="insert.php" name="msgform" id="contact-form">
<div class="row">
    <div class="cf-column"><input required name="title" id="subject" type="text" placeholder="主题" validate="minlength:2, maxlength:50, required:true"></div>
    <div class="cf-column"><input required name="name" id="username" type="text" placeholder="名字" validate="minlength:2, maxlength:50, required:true"></div>
    <div class="cf-column"><input required name="mailbox" id="mail" type="text" placeholder="邮箱" validate="maxlength:40, required:true, email:true"></div>
    <div class="cf-column"><input required name="phone" id="telephone" type="text" placeholder="手机" validate="minlength:6,maxlength:40, required:true"></div>
    <div class="cf-columns cf-tarea"><textarea required name="content" id="comment" placeholder="留言内容" validate="minlength:2, maxlength:200, required:true"></textarea></div>
    <div class="cf-columns submit-column clearfix">
    <input type="hidden" name="action" value="message">
    <button type="submit" onclick="return validate()" id="submit-btn" class="submit-button">立即提交</button></div>
</div>
</form>
<script>
  // 表单提交事件判断
  function validate(){
    var name = $("input[name='name']");
    var namecheck = /^[\u4e00-\u9fa5]{2,4}$/;
    var mailbox = $("input[name='mailbox']");
    var mailboxcheck =/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/;
    var phone = $("input[name='phone']");
    var phonecheck =  /^(((1[3456789][0-9]{1})|(15[0-9]{1}))+\d{8})$/;
    if(!namecheck.test(name.val())){
       alert('姓名填写有误');
       name.val('');
       name.focus();
       return false;
    }
    if(!mailboxcheck.test(mailbox.val())){
       alert('邮箱填写有误');
       mailbox.val('');
       mailbox.focus();
       return false;
    }
    if(!phonecheck.test(phone.val())){
       alert('手机号填写有误');
       phone.val('');
       phone.focus();
       return false;
    }
    return true;
  }
</script>
</div>
</div>


</div>


</div>
</div>
<hr>
<h3 class='location'>位置信息</h3>
<div id="dituContent"></div>
</div>
<div class="for-bottom-padding"></div>

<?php
require("footer.html");
?>

</div>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$(".nav_3").addClass("active");
});
</script>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(112.683249,26.88757);//定义一个中心点坐标
        map.centerAndZoom(point,17);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
    var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
    map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
    var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
    map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
    var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
    map.addControl(ctrl_sca);
    }
    
    //标注点数组
    var markerArr = [{title:"衡阳师范学院",content:"计算机科学系",point:"112.681497|26.884444",isOpen:1,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
         ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
            var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
            var iw = createInfoWindow(i);
            var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
            marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });
            
            (function(){
                var index = i;
                var _iw = createInfoWindow(i);
                var _marker = marker;
                _marker.addEventListener("click",function(){
                    this.openInfoWindow(_iw);
                });
                _iw.addEventListener("open",function(){
                    _marker.getLabel().hide();
                })
                _iw.addEventListener("close",function(){
                    _marker.getLabel().show();
                })
                label.addEventListener("click",function(){
                    _marker.openInfoWindow(_iw);
                })
                if(!!json.isOpen){
                    label.hide();
                    _marker.openInfoWindow(_iw);
                }
            })()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("favicon.ico", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }
    
    initMap();//创建和初始化地图
</script>
</body>
</html>