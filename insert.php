<?php
  require("dbconnect.php");
  
  //下订单
  if($_POST["action"]=="insert")
  {
    //在customer表中插入一条记录
    $sql1 = "insert into customer (cardid,phone,cname,message) values('".$_POST["card"]."','".$_POST["phone"]."','".$_POST["name"]."','".@$_POST["content"]."')";
    mysqli_query($db_link,$sql1) or die ("在customer表中插入记录失败");
    
    //在orders表中插入一条记录
     $sql2 = "insert into orders (roomid,cardid,entertime,leavetime,typeid,linkman,phone,ostatus,oremarks) values('".$_POST["roomid"]."','".$_POST["card"]."','".$_POST["checkin"]."','".$_POST["checkout"]."','".$_POST["typeid"]."','".$_POST["name"]."','".$_POST["phone"]."','是','否')";

    mysqli_query($db_link,$sql2) or die ("在orders表中插入记录失败");

    //更新roomtype表中leftunm字段
    $sql3 = "update roomtype set leftnum=leftnum-1 where typeid=".$_POST["typeid"];
    mysqli_query($db_link,$sql3) or die ("更新roomtype表中leftunm字段失败");
  
    echo "<script language=javascript>alert('在线预订成功');window.location='order_query.php'</script>";
  }
?>

