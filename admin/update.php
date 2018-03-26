<?php
  require("../dbconnect.php");
  //订单入住更新状态
  if(@$_GET["olrid"])
  {
    //更新room表中status字段
    $sql = "update room set status='是' where roomid=".$_GET["olrid"];
    mysqli_query($db_link,$sql) or die ("更新room表中status字段失败");
    
    //更新orders表中oremarks字段
    $sql2 = "update orders set oremarks='是' where roomid=".$_GET["olrid"];
    mysqli_query($db_link,$sql2) or die ("更新orders表中oremarks字段失败");
  
    echo "<script language=javascript>alert('订单入住成功');window.location='admin_addo.php'</script>"; 
  }
  //退房释放资源
  if(@$_GET["crid"])
  {
    //将订单信息移到record表
    $sql1 = "insert into record(orderid,roomid,cardid,cname,entertime,leavetime,typeid,linkman,phone,ostatus,oremarks) select * from (select a.orderid,a.roomid,a.cardid,b.cname,a.entertime,a.leavetime,a.typeid,a.linkman,a.phone,a.ostatus,a.oremarks from orders a,customer b where a.cardid=b.cardid and a.orderid=".$_GET["orderid"].") tmp";
    mysqli_query($db_link,$sql1) or die ("将订单信息移到record表失败");
    
    //更新record表中monetary字段
    $sql2 = "update record set monetary=".$_GET["money"]." where roomid = ".$_GET["crid"]." and orderid=".$_GET["orderid"];

    mysqli_query($db_link,$sql2) or die ("更新record表中monetary字段失败");
    
    //删除orders中相应的记录
    $sql4 = "delete from orders where roomid = ".$_GET["crid"]." and orderid=".$_GET["orderid"];
    mysqli_query($db_link,$sql4) or die ("删除orders中相应的记录失败");
    
    //删除customer表中的客户记录
    $sql3 = "delete from customer where cardid in (select cardid from record where roomid = ".$_GET["crid"]." and orderid=".$_GET["orderid"].")";

    mysqli_query($db_link,$sql3) or die ("删除customer表中的客户记录失败");
    
    //更新roomtype表中leftunm字段
    $sql5 = "update roomtype set leftnum=leftnum+1 where typeid=".$_GET["typeid"];

    mysqli_query($db_link,$sql5) or die ("更新roomtype表中leftunm字段失败");

    //更新room表中status字段
    $sql6 = "update room set status='否' where roomid=".$_GET["crid"];

    mysqli_query($db_link,$sql6) or die ("更新room表中status字段失败");
  
    echo "<script language=javascript>alert('退房清算成功');window.location='admin_checkout.php'</script>"; 
  }
  //房型管理修改
  if(@$_POST["action"]=="modify")
  {
    $sqlstr = "update roomtype set typename='".$_POST["typename"]."',area='".$_POST["area"]."',hasNet='".$_POST["hasNet"]."',hasTV='".$_POST["hasTV"]."',price=".$_POST["price"].",totalnum=".$_POST["totalnum"].",leftnum=".$_POST["leftnum"]." where typeid = ".$_GET["mtid"];

    $arry=mysqli_query($db_link,$sqlstr);
    if ($arry)
    {
      echo "<script> alert('修改成功');location='admin_rtypemgr.php';</script>";
    }
    else
    {
      echo "<script>alert('修改失败');history.go(-1);</script>";
    }
  }
  

  //房间管理修改
  if(@$_POST["action"]=="roomchg")
  {
    
    $sqlstr = "update room set roomid='".$_POST["roomid"]."',remarks='".$_POST["remarks"]."' where roomid = '".$_GET["mrid"]."'"; 
    $arry=mysqli_query($db_link,$sqlstr);
    if ($arry)
    {
      echo "<script> alert('修改成功');location='admin_roommgr.php';</script>";
    }
    else
    {
      echo "<script>alert('修改失败');history.go(-1);</script>";
    }
  }

  
  
  
?>
