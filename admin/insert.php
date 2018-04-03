<?php
  require("../dbconnect.php");
  //大堂入住
  if($_POST["action"]=="inserto")
  {
    //在customer表中插入一条记录
   $sql1 = "insert into customer (cardid,phone,cname,message) values('".$_POST["card"]."','".$_POST["phone"]."','".$_POST["name"]."','".@$_POST["content"]."')";
    mysqli_query($db_link,$sql1) or die ("在customer表中插入记录失败");
    
    //在order表中插入一条记录
    $sql2 = "insert into orders (roomid,cardid,entertime,leavetime,typeid,linkman,phone,ostatus,oremarks) values('".$_POST["roomid"]."','".$_POST["card"]."','".$_POST["checkin"]."','".$_POST["checkout"]."','".$_POST["typeid"]."','".$_POST["name"]."','".$_POST["phone"]."','否','是')";

    mysqli_query($db_link,$sql2) or die ("在orders表中插入记录失败");


    //更新roomtype表中leftunm字段
    $sql3 = "update roomtype set leftnum=leftnum-1 where typeid=".$_POST["typeid"];
    //echo $sql3;
    mysqli_query($db_link,$sql3) or die ("更新roomtype表中leftunm字段失败");

    //更新room表中status字段
    $sql4 = "update room set status='是' where roomid=".$_POST["roomid"];
    mysqli_query($db_link,$sql4) or die ("更新room表中status字段失败");
  
    echo "<script language=javascript>alert('大堂入住成功');window.location='admin_addn.php'</script>";
  } 
  //新增房型
  if($_POST["action"]=="insertt")
  { 
    $sql = "insert into roomtype (typename,area,hasNet,hasTV,price,totalnum,leftnum) values('".$_POST["typename"]."','".$_POST["area"]."','".$_POST["hasNet"]."','".$_POST["hasTV"]."','".$_POST["price"]."','".$_POST["totalnum"]."','".$_POST["totalnum"]."')";
    $arr=mysqli_query($db_link,$sql);
    if ($arr)
    {
      echo "<script language=javascript>alert('添加成功！');window.location='admin_addt.php'</script>";
    }
    else
    {
      echo "<script>alert('添加失败');history.go(-1);</script>";
    }
  }
  
  //新增房间
  if($_POST["action"]=="inserth")
  {
        // 允许上传的图片后缀
      $allowedExts = array("gif", "jpeg", "jpg", "png");
      $temp = explode(".", $_FILES["file"]["name"]);
      $extension = end($temp);     // 获取文件后缀名
      if ((($_FILES["file"]["type"] == "image/gif")
      || ($_FILES["file"]["type"] == "image/jpeg")
      || ($_FILES["file"]["type"] == "image/jpg")
      || ($_FILES["file"]["type"] == "image/pjpeg")
      || ($_FILES["file"]["type"] == "image/x-png")
      || ($_FILES["file"]["type"] == "image/png"))
      && ($_FILES["file"]["size"] < 2048000)
      && in_array($extension, $allowedExts))
      {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
            echo "<script>history.go(-1);</script>";
        }
        else
        {
            if (file_exists("../images/" . $_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"], "../images/" . $_FILES["file"]["name"]);
                echo "文件存储在: " . "../images/" . $_FILES["file"]["name"];
            }
        }
      }
    else
    {
      echo "<script>alert('非法的文件格式');history.go(-1);</script>";
    }

    
    $sql = "insert into room (roomid,typeid,status,pic,remarks) values('".$_POST["roomid"]."','".$_POST["typeid"]."','".$_POST["status"]."','".$_FILES["file"]["name"]."','".@$_POST["remarks"]."')";
    $arr=mysqli_query($db_link,$sql);
    if ($arr)
    {
      //更新roomtype表中totalnum字段
    $sql2 = "update roomtype set totalnum=totalnum+1 where typeid=".$_POST["typeid"];
    mysqli_query($db_link,$sql2) or die ("更新roomtype表中totalnum字段失败");
    //更新roomtype表中leftnum字段
    $sql3 = "update roomtype set leftnum=leftnum+1 where typeid=".$_POST["typeid"];
    mysqli_query($db_link,$sql3) or die ("更新roomtype表中leftnum字段失败");

    echo "<script language=javascript>alert('添加成功！');window.location='admin_addh.php'</script>";
    }
    else
    {
      echo "<script>alert('添加失败');history.go(-1);</script>";
    }
  }
  
  
?>
