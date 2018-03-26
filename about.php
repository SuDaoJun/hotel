<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta content="宾馆管理" name="keywords"/>
<meta content="宾馆展示" name="description"/>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="css/styles.css" rel="stylesheet" type="text/css"/>
<link href="css/index.css" rel="stylesheet" type="text/css"/>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$("#main-menu #nav_35").addClass("active");
});
</script>


<title>关于我们</title>
<style>
    .internal-page-title{
        background-image: url(images/banner.jpg);
    }
    .page-content{
        text-align: center;
    }
    html,body{margin:0;padding:0;}
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
    #dituContent{
    width:887px;
    height:400px;
    border:#ccc solid 1px;
    margin: 40px 0 0 250px;
    }
    @media screen and (max-width: 900px) {
   #dituContent{
       width: 100%;
       height: 300px;
        margin-left: 0;
        margin-bottom: 50px;
    }
}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
</head>

<body class="homepage trans-header sticky white-datepicker">

<div id="page-body-wrap">
<?php
require("head.html");
?>
<div class="internal-page-title about-page">
<h1>关于我们</h1>
<ol class="breadcrumb">
	<li><i class="fa fa-map-marker"></i> &nbsp;<span>当前位置： <a href="index.php">网站首页</a> &gt <a href="about.php">关于我们</a></span></li>
</ol>
</div>

<div class="page-container" id="innerpage-wrap">
<div class="container">
<div class="row">

<div class="main col-md-12 inner-left" role="main">


<div class="about-page-wrap">
<div class="com-cnt page-content">
<strong><span style="color:#C5A46D;font-size:18px;">越努力越幸运</span></strong><br />
<br />
找到属于自己的位置，走自己的道路，人生，越努力越幸运！<br />
					
</div>

</div>


</div>


</div>
</div>
<div id="dituContent"></div>
</div>
<div class="for-bottom-padding"></div>

<?php
require("footer.html");
?>

</div>
<script type="text/javascript" src="js/template.js"></script>
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