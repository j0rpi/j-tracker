<!--

 J-Tracker
 file: index.php
 purpose: main page

-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- <form action="" id="login" method="get"> -->
<?php
include('include/config.php');
include('classes/login.php');

$login = new Login();
?>

<?php
echo "<title>" . site_name . " - Login</title>"
?>

<?php

if( defined("installed") )
{
echo "
<head>
<link rel='stylesheet' type='text/css' href='skin/default/style.css'>
</head>
<body>
<div class='topbar'>
<form action='search.php' id='search' method='get'>
<a href='index.php' class='a' style='float: left; border-bottom: 0px solid lol;'><img src='skin/default/img/logo.png' width='64' height='64' id='' alt='' class='topbar-logo'></a><br />
<a href='index.php' title='Search Torrents'>Search Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href='browse.php' title='Browse Torrents'>Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href='#' title='Recent Torrent'>Recent Torrents</a>
<br><br><input type='search' class='search' required='' name='query' value=''> <input value='Search' type='submit' class='submitbutton'><br>
<input type='hidden' name='page' value='0'>
<input type='hidden' name='orderby' value='99'>
</form>
</div>
<center>
<br>";

if ($login->isUserLoggedIn() == true)
{
echo "
<div class='uploadbox'>
<br /><br />
  <font style='font-family: Helvetica'>Torrent File<br>
  <input type='file' value='Browse...' accept='.torrent'><br /><br />
  Category<br>
  <select required=''>
  <optgroup label='Applications'>
    <option value='1'>Applications/Windows</option>
    <option value='2'>Applications/OSX</option>
	<option value='3'>Applications/Linux</option>
	<option value='4'>Applications/Other</option>
  </optgroup>
  <optgroup label='Games'>
    <option value='5'>Games/PC</option>
    <option value='6'>Games/PSX</option>
	<option value='7'>Games/XBOX</option>
	<option value='8'>Games/Other</option>
  </optgroup>
  <optgroup label='Movies'>
    <option value='9'>Movies/DVD-R</option>
    <option value='10'>Movies/HD</option>
	<option value='11'>Movies/VCD</option>
	<option value='12'>Movies/Other</option>
  </optgroup>
</select><br />
<br />
Description<br />
<textarea style='width: 600px; height: 350px' required='' placeholder='Insert .NFO info, or your own description..'>
</textarea>
<br>
<br>
  <input type='submit' width='600' value='Upload Torrent'
  ></font><br>
  <br />
</div>
</form>";
}
else
{
	echo "You need to login to upload torrents. Click <a href='login.php'>HERE</a> to login.<br />";
}
echo "
<br>
<nav>";
if ($login->isUserLoggedIn() == true)
{
echo "Logged in as <b>" . $_SESSION['user_name'] . "</b> <b><a href='index.php?logout'>[LOGOUT]</a></b> |";
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