<!--

 J-Tracker
 file: index.php
 purpose: main page

-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once('include/config.php');
require_once("classes/Login.php");
?>


<head>
<link rel='stylesheet' type='text/css' href='skin/default/style.css'>
</head>
<body>
<div class='topbar'>
<form action='search.php' id='search' method='get'>
<a href='index.php' class='a' style='float: left; border-bottom: 0px solid lol;'><img src='skin/default/img/logo.png' width='64' height='64' id='' alt='' class='topbar-logo'></a><br />
<a href='index.php' title='Search Torrents'>Search Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href='browse.php?p=0' title='Browse Torrents'>Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href='#' title='Recent Torrent'>Recent Torrents</a>
<br><br><input type='search' class='search' required='' name='query' value=''> <input value='Search' type='submit' class='submitbutton'><br>
<input type='hidden' name='page' value='0'>
<input type='hidden' name='orderby' value='99'>
</form>
</div>
<center>
<br>
<?php
$login = new Login();

if ($login->isUserLoggedIn() == true) 
{

	echo "You are logged in as: <b>" . $_SESSION['user_name'] . "</b><br /><br/><a href='index.php'>Return To Main Site.</a><br /><br />";
}
else
{
include("views/not_logged_in.php");
}
?>

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
<span class='footertext'>Site Powered by <a href='http://www.github.com/j0rpi/j-tracker'>J-Tracker v0.3</a><br></span>
<br>
<br>
<br>
<br>
<a href='http://www.kopimi.com/kopimi/' class='torrentlinks'><img src='skin/default/img/kopimi.gif'/></a>
</center>
</body>