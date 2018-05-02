<?php
  require("../dbconnect.php");
  //大堂入住
  if($_POST["action"]=="inserto")
  {  
    //在order表中插入一条记录
    $money = $_POST["days"] * $_POST["price"];
    $sql2 = "insert into orders (orderid,roomid,cardid,entertime,days,typeid,linkman,phone,ostatus,oremarks,monetary,messages) values('".date('his')."','".$_POST["roomid"]."','".$_POST["card"]."','".$_POST["checkin"]."','".$_POST["days"]."','".$_POST["typeid"]."','".$_POST["name"]."','".$_POST["phone"]."','否','是','".$money."','".$_POST["content"]."')";
    mysqli_query($db_link,$sql2) or die ("在orders表中插入记录失败");


    //更新roomtype表中leftunm字段
    $sql3 = "update roomtype set leftnum=leftnum-1 where typeid='".$_POST["typeid"]."'";
    mysqli_query($db_link,$sql3) or die ("更新roomtype表中leftunm字段失败");

    //更新room表中status字段
    $sql4 = "update room set status='是' where roomid='".$_POST["roomid"]."'";
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
      echo "<script language=javascript>alert('新增房型成功！');window.location='admin_addt.php'</script>";
    }
    else
    {
      echo "<script>alert('新增房型失败');history.go(-1);</script>";
    }
  }
  
  //新增房间
  if($_POST["action"]=="inserth")
  {
      $date=date('Ymdhis');//得到当前时间
      $fileName=$_FILES['file']['name'];//得到上传文件的名字
      $name=explode('.',$fileName);//将文件名以'.'分割得到后缀名,得到一个数组
      $newPath=$date.'.'.$name[1];
      if (file_exists("../images/" . $newPath))
      {
          echo "<script>alert('图片名已经存在');history.go(-1);</script>";        
      }
      else
      {
          move_uploaded_file($_FILES["file"]["tmp_name"], iconv("UTF-8","gb2312","../images/" . $newPath));
          $sql = "insert into room (roomid,typeid,status,pic,remarks) values('".$_POST["roomid"]."','".$_POST["typeid"]."','".$_POST["status"]."','".$newPath."','".@$_POST["remarks"]."')";
          $arr=mysqli_query($db_link,$sql);
          if ($arr)
          {
            //更新roomtype表中totalnum字段
          $sql2 = "update roomtype set totalnum=totalnum+1 where typeid='".$_POST["typeid"]."'";
          mysqli_query($db_link,$sql2) or die ("更新roomtype表中totalnum字段失败");
          //更新roomtype表中leftnum字段
          $sql3 = "update roomtype set leftnum=leftnum+1 where typeid='".$_POST["typeid"]."'";
          mysqli_query($db_link,$sql3) or die ("更新roomtype表中leftnum字段失败");

          echo "<script language=javascript>alert('新增房间成功！');window.location='admin_addh.php'</script>";
          }
          else
          {
            echo "<script>alert('新增房间失败');history.go(-1);</script>";
          }
      }
  }
  //新增相册
  if($_POST["action"]=="insertx")
  {
      $date=date('Ymdhis');//得到当前时间
      $fileName=$_FILES['file']['name'];//得到上传文件的名字
      $fileNames=$_FILES['files']['name'];
      $name=explode('.',$fileName);
      $names=explode('.',$fileNames);
      //将文件名以'.'分割得到后缀名,得到一个数组
      $newPath=$date.'.'.$name[1];
      $newPaths=$date.'2'.'.'.$names[1];
      if (file_exists("../images/" . $newPath)||file_exists("../images/" . $newPaths))
      {
          echo "<script>alert('图片名已经存在');history.go(-1);</script>";        
      }
      else
      {
          move_uploaded_file($_FILES["file"]["tmp_name"], iconv("UTF-8","gb2312","../images/" . $newPath));
          move_uploaded_file($_FILES["files"]["tmp_name"], iconv("UTF-8","gb2312","../images/" . $newPaths));
          $sql = "insert into news (title,spic,bpic,describes) values('".$_POST["title"]."','".$newPath."','".$newPaths."','".$_POST["describe"]."')";
          $arr=mysqli_query($db_link,$sql);
          if ($arr)
          {
          echo "<script language=javascript>alert('新增相册成功！');window.location='admin_addx.php'</script>";
          }
          else
          {
            echo "<script>alert('新增相册失败');history.go(-1);</script>";
          }
      }
   }
   //新增用户
   if($_POST["action"]=="insetr")
   { 
     $sql = "insert into admin (name,passwd) values('".$_POST["name"]."','".$_POST["password"]."')";
     $arr=mysqli_query($db_link,$sql);
     if ($arr)
     {
       echo "<script language=javascript>alert('新增用户成功！');window.location='admin_addr.php'</script>";
     }
     else
     {
       echo "<script>alert('新增用户失败');history.go(-1);</script>";
     }
   }

  
  
?>
