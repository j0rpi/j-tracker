<!--

 J-Tracker
 file: send.php
 purpose: pm send

-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include('include/config.php');
include('classes/Login.php');
include('classes/Registration.php');

$register = new Registration();
$login = new Login();
?>

<?php
echo "<title>" . site_name . "- Send New Message</title>";
?>

<?php

if ($login->isUserLoggedIn() == true)
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
<br>
<br>
<center>
<span style='font-family: Helvetica; font-size: 24px'>Send New Message</b></span><br><br>
<a href='send.php'>Send New Message</a>&nbsp;&nbsp;|&nbsp;
<a href='inbox.php' title='Check your inbox'>Inbox</a>&nbsp;&nbsp;|&nbsp;
<a href='sent.php' title='Check your sent messages'>Sent</a>&nbsp;&nbsp;|&nbsp;
<a href='wipe_inbox.php' title='Wipe Inbox'>Wipe Inbox</a>
</center><br />
<div class='uploadbox' style='height: 450px; width: 550px; margin-left: auto; margin-right: auto'>
<br />
<form method='post' action='send.php'>
<div style='padding: 25px;'>
<b>Reciever</b></font></span><br /><br />
<input type='hidden' name='sender' value='" . $_SESSION['user_name'] . "' />
<input style='width: 500px' class='search' name='reciever' required><br /><br />
<b>Title</b><br /><br />
<input style='width: 500px' class='search' name='title' required><br /><br />
<b>Message</b><br /><br />
<textarea name='message' class='search' style='width: 500px; height: 150px' required>
</textarea>
<br />
<input type='checkbox'>Encrypt message with my PGP key
<br />
<br />
  <input type='submit' width='600' name='sendpm' value='Send Message'>
</font><br>
  <br />
  </div>
  </form>
</div>
";
}
else
{
	echo "You need to login to send messages. Click <a href='login.php'>HERE</a> to login.<br />";
}
?>