<?php
  $db_link=mysqli_connect("localhost",  //MYSQL��������ַ
                          "root",       //MYSQL��¼�û���
                          "sdj",           //MYSQL��¼���루�˴��ɸ���ʵ������޸ģ�
                          "hb5272230");   //��Ҫ�������ݿ���
  
  if(!$db_link)
  {
    die("���ݿ����Ӵ���: " . mysqli_connect_error());
  }
  
  //�������ݿ����
  mysqli_query($db_link,"SET NAMES 'utf8'"); 
  //mysqli��php5�ṩ���º����⣬i��ʾ�Ľ���improve������ִ���ٶ�Ҫ��mysql_query���졣
 
?>

