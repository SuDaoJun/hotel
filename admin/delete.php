<?php
  require("../dbconnect.php");
  // 取消网上订单,先清除外键再清除主键
  if(@$_GET["cardid"]){
    // $sql="delete from customer where cardid=".$_GET["cardid"];
    $sql="delete from orders where cardid='".$_GET["cardid"]."'";
    $arry=mysqli_query($db_link,$sql);
    if($arry)
    {
      $sql2="delete from customer where cardid='".$_GET["cardid"]."'";
      $arry2=mysqli_query($db_link,$sql2);
      if($arry2){
        $sql3 = "update roomtype set leftnum=leftnum+1 where typeid='".$_GET["typeid"]."'";
        mysqli_query($db_link,$sql3) or die ("更新roomtype表中leftnum字段失败");
        echo "<script> alert('取消订单成功！');location='admin_addo.php';</script>";
      }else{
      echo "<script> alert('取消网上订单失败1！');location='admin_addo.php';</script>";
      }
    }
    else{
      echo "<script> alert('取消网上订单失败2！');location='admin_addo.php';</script>";
    }
  }
  // 删除房间种类
  if(@$_GET["rid"])
  {
    $sql="delete from roomtype where typeid='".$_GET["rid"]."'";
    $arry=mysqli_query($db_link,$sql);
    if($arry)
    {
      echo "<script> alert('删除房间种类成功');location='admin_rtypemgr.php';</script>";
    }
    else{
      echo "<script> alert('删除房间种类失败,请先把该房间种类的房间先全部删除');location='admin_rtypemgr.php';</script>";
    }
  }
 // 删除房间 
  if(@$_GET["mid"])
  {
    if($_GET["status"] == '否'){
      $sql="delete from room where roomid='".$_GET["mid"]."'";
      $arry=mysqli_query($db_link,$sql);
      if($arry)
      {
          //更新roomtype表中totalnum字段
        $sql2 = "update roomtype set totalnum=totalnum-1 where typeid='".$_GET["typeid"]."'";
        mysqli_query($db_link,$sql2) or die ("更新roomtype表中totalnum字段失败");
        //更新roomtype表中leftnum字段
        $sql3 = "update roomtype set leftnum=leftnum-1 where typeid='".$_GET["typeid"]."'";
        mysqli_query($db_link,$sql3) or die ("更新roomtype表中leftnum字段失败");
        echo "<script> alert('删除房间成功');location='admin_roommgr.php';</script>";
      }
      else{
        echo "<script> alert('删除房间失败');location='admin_roommgr.php';</script>";
      }
    }else{
      echo "<script> alert('房间入住状态为是，请先退房清算！');location='admin_roommgr.php';</script>";
    }
    
  }
  // 删除留言 
  if(@$_GET["msid"])
  {
    $sql="delete from message where ms_id='".$_GET["msid"]."'";

    $arry=mysqli_query($db_link,$sql);
    if($arry)
    {
      echo "<script> alert('删除留言成功');location='admin_message.php';</script>";
    }
    else
      echo "删除留言失败";
  }
  // 删除相册 
  if(@$_GET["pid"])
  {
    $sql="delete from news where id='".$_GET["pid"]."'";

    $arry=mysqli_query($db_link,$sql);
    if($arry)
    {
      echo "<script> alert('删除相册成功');location='admin_photomgr.php';</script>";
    }
    else
      echo "删除相册失败";
  }

?>
