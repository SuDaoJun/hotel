<?php
  require("../dbconnect.php");
  // 删除房间种类
  if(@$_GET["rid"])
  {
    $sql="delete from roomtype where typeid=".$_GET["rid"];

    $arry=mysqli_query($db_link,$sql);
    if($arry)
    {
      echo "<script> alert('删除成功');location='admin_rtypemgr.php';</script>";
    }
    else
      echo "删除失败";
  }
 // 删除房间 
  if(@$_GET["mid"])
  {
    $sql="delete from room where roomid='".$_GET["mid"]."'";

    $arry=mysqli_query($db_link,$sql);
    if($arry)
    {
      echo "<script> alert('删除成功');location='admin_roommgr.php';</script>";
    }
    else
      echo "删除失败";
  }
  // 删除留言 
  if(@$_GET["msid"])
  {
    $sql="delete from message where ms_id='".$_GET["msid"]."'";

    $arry=mysqli_query($db_link,$sql);
    if($arry)
    {
      echo "<script> alert('删除成功');location='admin_message.php';</script>";
    }
    else
      echo "删除失败";
  }

?>
