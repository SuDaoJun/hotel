<?php
  require("dbconnect.php");
  //下订单
  if($_POST["action"]=="insert")
  {
    //在orders表中插入一条记录
     $money = $_POST["days"] * $_POST["price"];
     $sql = "insert into orders (orderid,roomid,cardid,entertime,days,typeid,linkman,phone,ostatus,oremarks,monetary,messages) values('".date('his')."','".$_POST["roomid"]."','".$_POST["card"]."','".$_POST["checkin"]."','".$_POST["days"]."','".$_POST["typeid"]."','".$_POST["name"]."','".$_POST["phone"]."','是','否','".$money."','".$_POST["content"]."')";
    mysqli_query($db_link,$sql) or die ("在orders表中插入记录失败");

    //更新roomtype表中leftunm字段
    $sql2 = "update roomtype set leftnum=leftnum-1 where typeid='".$_POST["typeid"]."'";
    mysqli_query($db_link,$sql2) or die ("更新roomtype表中leftunm字段失败");
  
    echo "<script language=javascript>alert('在线预订成功');window.location='order_query.php'</script>";
  }
  //留言
  if($_POST["action"]=="message"){
       //在message表中插入一条记录
    $sql1 = "insert into message(title,name,mailbox,phone,content) values('".$_POST["title"]."','".$_POST["name"]."','".$_POST["mailbox"]."','".$_POST["phone"]."','".$_POST["content"]."')";
    mysqli_query($db_link,$sql1) or die ("在message表中插入记录失败");
    echo "<script language=javascript>alert('留言提交成功');window.location='about.php'</script>";
  }
?>

