<!--

 J-Tracker
 file: index.php
 purpose: main page

-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<form action="" id="login" method="get">
<?php
include('include/config.php');
?>

<?php
echo "<title>" . site_name . "</title>"
?>

<?php

if( defined("installed") )
{
echo "
<head>
<link rel='stylesheet' type='text/css' href='skin/default/style.css'>
</head>
<body>
<center>
<font style='font-size: 18px; font-family: Arial;'><img src='skin/default/" . site_logo . "'/><br><b>". site_name . "</b></font><br>
<br>
<div class='registerbox'>
<br /><br />
  <font style='font-family: Helvetica'>Username<br>
  <input type='text' class='authboxes' name='user' width='100' disabled=''><br /><br />
  Password<br>
  <input type='text' class='authboxes' name='pass' width='100' disabled=''><br /><br />
  Email<br>
  <input type='text' class='authboxes' name='pass' width='100' disabled=''><br /><br />
  <input type='submit' width='600' value='Register' disabled=''></font><br>
  <br />
  <font style='font-size: 10px; color: maroon'>Register Has Been Disabled</font>
</div>
</form>
<br>
<nav>
<a href='login.php'>Login</a> |
<a href='register.php'>Register</a> |
<a href='upload.php'>Upload Torrent</a> |
<a href='my.php'>UCP</a> |
<a href='/blog/'>Blog</a> |
<a href='legal.php'>Legal</a> |
<a href='stats.php'>Site Statistics</a> |
<a href='about.php'>About J-Tracker</a>
</nav>
<br>
<br>
<span class='footertext'>Site Powered by <a href='http://www.github.com/j0rpi/j-tracker'>J-Tracker v0.1</a><br></span>
<br>
<br>
<br>
<br>
<a href='http://www.kopimi.com/kopimi/' class='torrentlinks'><img src='skin/default/img/kopimi.gif'/></a>
</center>
</body>";
}
else
{
	die('J-Tracker has not been installed. Please click <a href="install/index.php">HERE</a> to install.');
}
?>