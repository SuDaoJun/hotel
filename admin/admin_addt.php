<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>宾馆后台管理</title>
  <link rel="stylesheet" type="text/css" href="css/common.css"/>
  <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
  <div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
      <div class="topbar-logo-wrap clearfix">
        <ul class="navbar-list clearfix">
          <li><a class="on" href="admin_index.php">网站后台</a></li>
          <li><a href="../index.php" target="_blank">网站首页</a></li>
        </ul>
      </div>
      <div class="top-info-wrap">
        <ul class="top-info-list clearfix">
          <li>登录用户：<?php session_start(); echo $_SESSION["aname"]; ?></li>
          <li><a href="admin_logout.php"><i class="icon-font">&#xe9b6;</i>退出</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container clearfix">
    <?php
    require("leftArea.html");
    ?>
    <!--/sidebar-->
    <div class="main-wrap">
      <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="admin_index.php">后台管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">新增房类</span></div>
      </div>
      <div class="result-wrap">
        <form id="myform" name="myform" method="post" action="insert.php">
          <table width="100%" height="173" border="0" align="center" cellpadding="2" cellspacing="1" class="result-tab">
            <tr>
              <td width="%15" align="right" class="td_bg">类型名称：</td>
              <td width="%85" class="td_bg"> <input name="typename" type="text" id="typename" size="30" maxlength="50" /></td>
            </tr>
            <tr>
              <td align="right" class="td_bg">房间面积：</td>
              <td class="td_bg"> <input name="area" type="text" id="area" size="10" maxlength="15" />㎡</td>
            </tr>
            <tr>
              <td align="right" class="td_bg">房间数量：</td>
              <td class="td_bg"><input name="totalnum" type="text" id="totalnum" size="10" maxlength="15" />间</td>
            </tr>
            <tr>
              <td align="right" class="td_bg">网&emsp;&emsp;络：</td>
              <td class="td_bg">
                <select name="hasNet">
                  <option value="有" selected>有网络</option>
                  <option value="无">无网络</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="right" class="td_bg">电&emsp;&emsp;视：</td>
              <td class="td_bg">
                <select name="hasTV">
                  <option value="有" selected>有电视</option>
                  <option value="无">无电视</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="right" class="td_bg">价&emsp;&emsp;格：</td>
              <td class="td_bg"> <input name="price" type="text" id="price" size="10" maxlength="15" />元/天</td>
            </tr>
            
            <tr>
              <td align="right" class="td_bg"><input type="reset" name="submit2" id="button2" value="重置" /></td>
              <td class="td_bg">
                <input type="hidden" name="action" value="insertt">
                <input type="submit" name="submit" id="button" value="提交" /></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <!--/main-->
  </div>
</body>
</html>