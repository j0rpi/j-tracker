<!--

 J-Tracker
 file: index.php
 purpose: main page

-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<form action="search.php" id="search" method="get">
<?php
include('include/config.php');
include('classes/Login.php');

$login = new Login();

if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>



<?php

if( defined("installed") )
{
echo "
<head>
<title>" . site_name . "</title>
<link rel='stylesheet' type='text/css' href='skin/default/style.css'>
</head>
<body>
<center>
<font style='font-size: 18px; font-family: Arial;'><img src='skin/default/" . site_logo . "'/><br><b>". site_name . "</b></font><br>
<nav>
<a href='browse.php?p=0'>Browse Torrents</a> |
<a href='#'>Recent Torrents</a> |
<a href='#'>Torrents Hall of Fame</a> 
</nav>
<br>
  <input type='text' required='' class='search' name='query' width='900'><br>
  <p class='cats'>
            <label title='All' accesskey='a'><input id='all' type='checkbox' checked='true'>All</label>
            <label title='Audio' accesskey='q'><input name='audio' id='audio' type='checkbox'>Audio</label>
            <label title='Video' accesskey='w'><input name='video' id='video' type='checkbox'>Video</label>
            <label title='Applications' accesskey='e'><input name='apps' id='apps' type='checkbox'>Applications</label>
            <label title='Games' accesskey='r'><input name='games' id='games' type='checkbox'>Games</label>
            <label title='Porn' accesskey='t'><input name='porn' id='porn' type='checkbox'>Porn</label>
            <label title='Other' accesskey='y'><input name='other' id='other' type='checkbox'>Other</label>
  </p>
  <input type='submit' width='600' value='Search For Torrents'><br>
</form>
<br>
<nav>";

if ($login->isUserLoggedIn() == true)
{
$unread = mysql_query("SELECT * FROM pms WHERE unread='yes' AND reciever='" . $_SESSION['user_name'] . "'") or die(mysql_error());
echo "<br />Logged in as <b>" . $_SESSION['user_name'] . "</b> <a href='index.php?logout'>Logout</a><a href='inbox.php'> | Inbox(<font style='color: maroon'><b>" . mysql_num_rows($unread) . "</b></font>) |";
}
else
{
echo "<a href='login.php'>Login</a> |
      <a href='register.php'> Register</a> |";
      
}

echo "
<a href='upload.php'>Upload Torrent</a> |
<a href='my.php'>UCP</a> |
<a href='/blog/'>Blog</a> |
<a href='legal.php'>Legal</a> |
<a href='stats.php'>Site Statistics</a> |
<a href='about.php'>About J-Tracker</a>
</nav>
<br>
<br>
<span class='footertext'>Site Powered by <a href='http://www.github.com/j0rpi/j-tracker'>J-Tracker v0.3</a><br></span>
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