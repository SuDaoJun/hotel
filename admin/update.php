<?php
  require("../dbconnect.php");
  //订单入住确认
  if(@$_GET["olrid"])
  {
    //更新room表中status字段
    $sql = "update room set status='是' where roomid='".$_GET["olrid"]."'";
    mysqli_query($db_link,$sql) or die ("更新room表中status字段失败");
    
    //更新orders表中oremarks字段
    $sql2 = "update orders set oremarks='是' where roomid='".$_GET["olrid"]."'";
    mysqli_query($db_link,$sql2) or die ("更新orders表中oremarks字段失败");
  
    echo "<script language=javascript>alert('订单入住成功');window.location='admin_addo.php'</script>"; 
  }
  //退房释放资源
  if(@$_GET["crid"])
  {
    //将订单信息移到record表,表设置的是自增，移入的时候和record的主键重复冲突，导致失败,所以订单流水设置为时间戳
    $sql1 = "insert into record(orderid,roomid,cardid,entertime,days,typeid,linkman,phone,ostatus,oremarks,monetary,messages) select * from orders where orderid='".$_GET["orderid"]."'";
    mysqli_query($db_link,$sql1) or die ("将订单信息移到record表失败");
    
    //删除orders中相应的记录
    $sql2 = "delete from orders where orderid='".$_GET["orderid"]."'";
    mysqli_query($db_link,$sql2) or die ("删除orders中相应的记录失败");
    
    //更新roomtype表中leftunm字段
    $sql3 = "update roomtype set leftnum=leftnum+1 where typeid='".$_GET["typeid"]."'";

    mysqli_query($db_link,$sql3) or die ("更新roomtype表中leftunm字段失败");

    //更新room表中status字段
    $sql4 = "update room set status='否' where roomid='".$_GET["crid"]."'";

    mysqli_query($db_link,$sql4) or die ("更新room表中status字段失败");
  
    echo "<script language=javascript>alert('退房清算成功');window.location='admin_checkout.php'</script>"; 
  }
  //订单修改
  if(@$_POST["action"]=="dmod"){
    $sql = "update orders set orderid='".$_POST["orderid"]."',roomid='".$_POST["roomid"]."',cardid='".$_POST["cardid"]."',entertime='".$_POST["entertime"]."',days='".$_POST["days"]."',linkman='".$_POST["linkman"]."',messages='".$_POST["content"]."',monetary='".$_POST["monetary"]."',phone='".$_POST["phone"]."' where orderid = '".$_POST["orderid"]."'";
    $arry=mysqli_query($db_link,$sql);
    if($arry){
     echo "<script> alert('订单信息修改成功');location='admin_queryo.php';</script>";
    }else{
      echo "<script>alert('订单信息修改失败');history.go(-1);</script>";
    }
  }
  //房型管理修改
  if(@$_POST["action"]=="modify")
  {
    $sqlstr = "update roomtype set typename='".$_POST["typename"]."',area='".$_POST["area"]."',hasNet='".$_POST["hasNet"]."',hasTV='".$_POST["hasTV"]."',price='".$_POST["price"]."',totalnum='".$_POST["totalnum"]."',leftnum='".$_POST["leftnum"]."' where typeid = '".$_GET["mtid"]."'";

    $arry=mysqli_query($db_link,$sqlstr);
    if ($arry)
    {

      echo "<script> alert('房间类型信息修改成功');location='admin_rtypemgr.php';</script>";
    }
    else
    {
      echo "<script>alert('房间类型信息修改失败');history.go(-1);</script>";
    }
  }
  

  //房间管理修改
  if(@$_POST["action"]=="roomchg")
  {
    if(!($_FILES["file"]["name"])){
      $pic = $_POST["init"];
    }else{
      $date=date('Ymdhis');//得到当前时间
      $fileName=$_FILES['file']['name'];//得到上传文件的名字
      $name=explode('.',$fileName);//将文件名以'.'分割得到后缀名,得到一个数组
      $newPath=$date.'.'.$name[1];
      move_uploaded_file($_FILES["file"]["tmp_name"], iconv("UTF-8","gb2312","../images/" . $newPath));
      $pic = $newPath;

    }
    $sqlstr = "update room set roomid='".$_POST["roomid"]."',remarks='".$_POST["remarks"]."',pic='".$pic."' where roomid = '".$_GET["mrid"]."'"; 

    $arry=mysqli_query($db_link,$sqlstr);
    if ($arry)
    {
      echo "<script> alert('房间信息修改成功');location='admin_roommgr.php';</script>";
    }
    else
    {
      echo "<script>alert('房间信息修改失败');history.go(-1);</script>";
    }
  }
  //相册管理修改
  if(@$_POST["action"]=="photochg")
  {
    $fileName = $_FILES['file']['name'];
    $fileNames = $_FILES['files']['name'];
    if(!($fileName && $fileNames)){
      $pic = $_POST["init"];
      $pics = $_POST["inits"];
    }else{
      $date=date('Ymdhis');
      $name=explode('.',$fileName);
      $names=explode('.',$fileNames);
      $newPath=$date.'.'.$name[1];
      $newPaths=$date.'2'.'.'.$names[1];
      move_uploaded_file($_FILES["file"]["tmp_name"], iconv("UTF-8","gb2312","../images/" . $newPath));
      move_uploaded_file($_FILES["files"]["tmp_name"], iconv("UTF-8","gb2312","../images/" . $newPaths));
      $pic = $newPath;
      $pics = $newPaths;
    }
    $sqlstr = "update news set id='".$_POST["id"]."',title='".$_POST["title"]."',spic='".$pic."',bpic='".$pics."',describes='".$_POST["describes"]."' where id = '".$_GET["pid"]."'"; 

    $arry=mysqli_query($db_link,$sqlstr);
    if ($arry)
    {
      echo "<script> alert('相册信息修改成功');location='admin_photomgr.php';</script>";
    }
    else
    {
      echo "<script>alert('相册信息修改失败');history.go(-1);</script>";
    }
  }

  //密码修改
  if(@$_POST["action"]=="psw")
  {
    session_start();
    $oper_name=$_SESSION["aname"];
    $sql="select * from admin where name='$oper_name'";
    $rs=mysqli_query($db_link,$sql);
    $rows=mysqli_fetch_assoc($rs);
    if($_POST["password2"] == $_POST["password3"]){
      if($rows["passwd"]==$_POST["password"])
      {
        $password2=$_POST["password2"];
        $sql="update admin set passwd='$password2' where name='$oper_name'";
        mysqli_query($db_link,$sql);
        echo "<script language='javascript'>alert('密码修改成功,请重新进行登陆！');window.location='index.php'</script>";
        exit();
      }else{
        echo "<script language='javascript'>alert('原始密码不正确,请重新输入');window.location='admin_chpwd.php'</script>";
      }
    }else{
        echo "<script language='javascript'>alert('密码不一致，请重新输入');window.location='admin_chpwd.php'</script>";
    }
    
    
   }

  
?>
