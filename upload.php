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
include('classes/Login.php');

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
<a href='browse.php?p=0' title='Browse Torrents'>Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
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
  <form action='upload_torrent.php' method='post' enctype='multipart/form-data'>
      <input type='file' name='torrentfile' value='Browse...' accept='.torrent' size='100'><br /><br />
      <input type='text' name='title' placeholder='Torrent Title..'><br /><br />
  Category<br>
  <select required='' name='cat'>
  <optgroup label='Applications'>
    <option value='Applications/Windows'>Applications/Windows</option>
    <option value='Applications/OSX'>Applications/OSX</option>
	<option value='Applications/Linux'>Applications/Linux</option>
	<option value='Applications/Other'>Applications/Other</option>
  </optgroup>
  <optgroup label='Games'>
    <option value='Games/PC'>Games/PC</option>
    <option value='Games/PSX'>Games/PSX</option>
	<option value='Games/XBOX'>Games/XBOX</option>
	<option value='Games/Other'>Games/Other</option>
  </optgroup>
  <optgroup label='Movies'>
    <option value='Movies/DVD-R'>Movies/DVD-R</option>
    <option value='Movies/HD'>Movies/HD</option>
	<option value='Movies/VCD'>Movies/VCD</option>
	<option value='Movies/Other'>Movies/Other</option>
  </optgroup>
</select><br />
<br />
Description<br />
<textarea name='desc' style='width: 600px; height: 350px' required='' placeholder='Insert .NFO info, or your own description..'>
</textarea>
<br>
<br>
  <input type='submit' width='600' name='upload_torrent' value='Upload Torrent'>
  </form>
</font><br>
  <br />
</div>";
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