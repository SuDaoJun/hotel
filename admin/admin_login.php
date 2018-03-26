<?php
require("../dbconnect.php");
if($_POST['action'] == "test")
{
  function make_safe($variable) 
  { 
    $variable = addslashes(trim($variable)); 
    return $variable; 
  } 

  $user=make_safe($_POST["username"]); 
  $pass=make_safe($_POST["pwd"]); 
 
  $sql="select * from admin where name='$user'";
  $result=mysqli_query($db_link,$sql);
  $row = mysqli_fetch_assoc($result); 
  if($row==false)
  {
    echo "<script language='javascript'>alert('不存在此用户！');history.back();</script>";
    exit;
  }
  else
  { 
    if($row["passwd"]==$pass)
    {
      session_start();
      $_SESSION['aname']=$row["name"];
      // 重定向
      header("location:admin_index.php");
      exit;
    }
    else 
    {
      echo "<script language='javascript'>alert('密码输入错误！');history.back();</script>";
      exit;
    }
   
  }
}
?>

