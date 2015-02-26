<!--

 J-Tracker
 file: index.php
 purpose: main page

-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once("include/config.php");
require_once("classes/Registration.php");
require_once("classes/Login.php");

$registration = new Registration();
$login = new Login();
?>

<?php
echo "<title>" . site_name . " - Register</title>"

?>



<head>
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
<link rel='stylesheet' type='text/css' href='skin/default/style.css'>
</head>
<body>
<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>
<center>
<br>
<?php
if ($login->isUserLoggedIn() == true)
{
  echo "You are already logged in as <b>" . $_SESSION['user_name'] . "<br /></b>You can logout by clicking <a href='index.php?logout'>HERE</a> or <a href='index.php'>RETURN TO MAIN PAGE</a><br /><br />";
}
else
{
	include("views/register.php");
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